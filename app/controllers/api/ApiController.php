<?php namespace Api;

use BaseController;
use BaseHelper;
use Debugbar;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Request;
use Teresah\Support\Facades\Response;

class ApiController extends BaseController
{
    protected $apiKeyService;
    protected $layout = null;

    public function __construct()
    {
        parent::__construct();

        # Disable the Laravel Debugbar in the development
        # environment.
        if (App::environment() == "development") {
            Debugbar::disable();
        }

        $this->beforeFilter("@verifyContentType", array("except" => 
           $this->skipAuthentication));

        $this->beforeFilter("@verifyUserAgent", array("except" => 
           $this->skipAuthentication));

        $this->beforeFilter("@throttleRequests", array("except" => 
            $this->skipAuthentication));

        $this->beforeFilter("@authenticate", array("except" => 
           $this->skipAuthentication));

        $this->beforeFilter("@authorize", array("except" => 
           $this->skipAuthentication));
    }

    public function authenticate() {
        $this->apiKeyService = App::make("Services\ApiKeyService");

        if ($apiKey = $this->apiKeyService->findByToken(Request::header("X-Auth-Token"))) {
            Auth::loginUsingId($apiKey->user->id);
        } else {
            return Response::jsonWithStatus(401, null, array("message" => Lang::get("controllers.api.unauthorized_request")));
        }
    }

    public function throttleRequests()
    {
        # TODO: Make the API requests per hour limit configurable
        $ipAddress = BaseHelper::getIpAddress();
        $cacheKey = sprintf("api:%s", $ipAddress);
        $requestsCount = 0;
        $requestsPerHourLimit = 600;

        # Remember the API request count in cache for 60 minutes
        Cache::add($cacheKey, $requestsCount, 60);

        # Increase the API request count in cache
        $requestsCount = Cache::increment($cacheKey);
        $requestsRemaining = $requestsPerHourLimit - $requestsCount;

        # Set the informative API rate limit headers
        # (limit & remaining requests available)
        header("X-RateLimit-Limit: {$requestsPerHourLimit}", false);
        header("X-RateLimit-Remaining: {$requestsRemaining}", false);

        # Restrict the API access if the request count exceeds the given limit
        if ($requestsCount > $requestsPerHourLimit) {
            return Response::jsonWithStatus(429, null, array("message" => Lang::get("controllers.api.rate_limit_exceeded", array("ip_address" => $ipAddress))));
        }
    }

    public function verifyContentType()
    {
        if (!Request::isJson()) {
            return Response::jsonWithStatus(415, null, array("message" => Lang::get("controllers.api.invalid_content_type_header")));
        }
    }

    public function verifyUserAgent()
    {
        $matches = false;

        foreach (preg_split("/[\s()]/", Request::server("HTTP_USER_AGENT")) as $token) {
            if (filter_var($token, FILTER_VALIDATE_EMAIL) || filter_var($token, FILTER_VALIDATE_URL)) {
                $matches = true;
            }
        }

        if ($matches === false) {
            return Response::jsonWithStatus(400, null, array("message" => Lang::get("controllers.api.invalid_user_agent_header")));
        }
    }
}
