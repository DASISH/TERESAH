<?php namespace Teresah\Support\Facades;

use Illuminate\Support\Facades\Response as BaseResponse;
use Symfony\Component\HttpFoundation\JsonResponse;

class Response extends BaseResponse
{
    public static function jsonWithStatus($code = 200, $response = array(), $messages = array(), $headers = array())
    {
        $status = array("status" => array("code" => $code));

        if (!empty($messages) && is_array($messages)) {
            if (!empty($messages["message"])) {
                $status["status"]["message"] = $messages["message"];
            }

            if (!empty($messages["errors"])) {
                $status["status"]["errors"] = $messages["errors"];
            }
        }

        if (isset($response) && is_array($response)) {
            $data = array_filter(array_merge($status, $response));
        } else {
            $data = array_filter($status);
        }

        return new JsonResponse($data, $code, $headers);
    }
}
