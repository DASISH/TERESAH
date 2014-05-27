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
     * directory traversal attacks from the "request_path" variable?
     * 
     * @return Response
     */
    private function matchStaticView()
    {
        $app_path = rtrim(app_path(), "/");
        $request_path = rtrim(mb_strtolower(Request::path()), "/");
        $full_static_view_path = "{$app_path}/views/pages/{$request_path}";
        $static_view_filename = "pages/{$request_path}";

        if (is_dir($full_static_view_path)) {
            $static_view_filename .= "/index";
        }

        if (View::exists($static_view_filename)) {
            return View::make($static_view_filename);
        }

        # Otherwise return the 404 response
        return App::abort(404);
    }
}
