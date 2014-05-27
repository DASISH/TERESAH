<?php

class PagesController extends BaseController
{
    /**
     * Display the specified static view.
     *
     * @return Response
     */
    public function show()
    {
        return $this->matchStaticView();
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
     * @return Response
     */
    private function matchStaticView()
    {
        $appPath = rtrim(app_path(), "/");
        $requestPath = rtrim(mb_strtolower(Request::path()), "/");
        $fullStaticViewPath = "{$appPath}/views/pages/{$requestPath}";
        $staticViewFilename = "pages/{$requestPath}";

        if (is_dir($fullStaticViewPath)) {
            $staticViewFilename .= "/index";
        }

        if (View::exists($staticViewFilename)) {
            return View::make($staticViewFilename);
        }

        # Otherwise return the 404 response
        return App::abort(404);
    }
}
