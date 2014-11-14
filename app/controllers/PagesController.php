<?php

use Services\ToolServiceInterface as ToolService;

class PagesController extends BaseController
{
    protected $skipAuthentication = array("index", "show");

    protected $toolService;

    public function __construct(ToolService $toolService)
    {
        parent::__construct();

        $this->toolService = $toolService;
    }

    /**
     * Display the front page.
     *
     * GET /
     * 
     * @return View
     */
    public function index()
    {
        $locale = App::getLocale();

        # TODO: Review the actual data retrieval
        return View::make("pages/{$locale}/index")
            ->with("randomTool", $this->toolService->random())
            ->with("latestTools", $this->toolService->all($with = array(), $perPage = 3))
            ->with("mostPopularTools", $this->toolService->all($with = array(), $perPage = 3))
            ->with("mostUsedTools", $this->toolService->all($with = array(), $perPage = 3));
    }

    /**
     * Display the specified static view.
     *
     * GET /{path}
     * 
     * @return View
     */
    public function show()
    {
        # TODO: Extract the rendering of the API documentation 
        # to it's own route/function?
        #
        # TODO: Extract the static documentation path to configurable constant?
        if (Request::is("about/api")) {
            $apiDocumentationPath = rtrim(base_path(), "/") . "/documentation/api/v1";
            $outputOrder = array("readme.md"); # Ensure that the "readme.md" gets rendered first

            return $this->matchStaticView(
                array("content" => $this->convertMarkdown($apiDocumentationPath, $outputOrder))
            );
        }

        return $this->matchStaticView();
    }

    /* TODO: Clean up and refactor */
    private function convertMarkdown($path, $outputOrder = array())
    {
        $output = array();

        foreach (glob("{$path}/*.md") as $filename) {
            $output[basename($filename)] = Markdown::render(file_get_contents($filename));
        }

        if (is_array($outputOrder) && !empty($outputOrder)) {
            $output = array_merge(array_flip($outputOrder), $output);
        }

        return array_values($output);
    }

    /**
     * Returns the matching static view for the request (if the file
     * exists), otherwise returns the 404 response.
     *
     * TODO: Review the security of matchStaticView() function. Does 
     * the Laravel framework already filter the "Request::path()" or 
     * "View::make()" methods, or do we need to filter out possible 
     * directory traversal attacks from the "requestPath" variable?
     * 
     * @param  array $parameters Optional parameters for the View
     * @return View
     */
    private function matchStaticView($parameters = array())
    {
        $locale = App::getLocale();
        $appPath = rtrim(app_path(), "/");
        $requestPath = rtrim(mb_strtolower(Request::path()), "/");
        $fullStaticViewPath = "{$appPath}/views/pages/{$locale}/{$requestPath}";
        $staticViewFilename = "pages/{$locale}/{$requestPath}";

        if (is_dir($fullStaticViewPath)) {
            $staticViewFilename .= "/index";
        }

        if (View::exists($staticViewFilename)) {
            return View::make($staticViewFilename, $parameters);
        }

        # Otherwise return the 404 response
        return App::abort(404);
    }
}
