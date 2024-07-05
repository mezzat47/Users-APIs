<?php

namespace App\Utils;

use Error;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Validation\ValidationException;

trait ApiResponseTrait
{

    /**
     * Return generic json response with the given data.
     * @param       $data
     * @param int $statusCode
     * @param string $status
     * @param string $message
     *
     * @return JsonResponse
     */
    protected function apiResponse($data = [], $status = null , $message = null, $statusCode = 200,$success=true): JsonResponse
    {
        return response()->json(
            [
                'status' => $status ?? Constants::$API_STATUS_SUCCESS,
                'message' => $message,
                'result' => $data,
                'success'=>$success
            ], $statusCode
        );
    }


    /**
     * Respond with success.
     * @param string $message
     * @return JsonResponse
     */
    protected function respondSuccess($message = null): JsonResponse
    {
        return response()->json(
            [
                'status' => Constants::$API_STATUS_SUCCESS,
                'message' => $message,
                'success'=>true
            ]
        );
    }

    /**
     * Respond with failed.
     * @param null $message
     * @param int $status
     * @return JsonResponse
     */
    protected function respondFailed($message = null,$status=400, $errors=[]): JsonResponse
    {
        return response()->json(
            [
                'status' => Constants::$API_STATUS_FAILED,
                'message' => $message,
                'errors'=>$errors,
                'success'=>false
            ],$status
        );
    }

    protected function respondWithResource(ResourceCollection $resourceCollection, $message = null,$success=true): JsonResponse
    {
        return response()->json(
            [
                'status' => Constants::$API_STATUS_SUCCESS,
                'message' => $message,
                'result' => $resourceCollection->response()->getData(),
                'success'=>$success
            ]
        );
    }
}
