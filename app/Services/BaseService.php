<?php

namespace App\Services;


class BaseService 
{
   public function sendResponse($result , $message,$page)
   {
       $response = [
        'success' => true,
        'data' => $result,
        'page' => $page ?? '',
        'message' => $message
       ];
       return response()->json($response , 200);
   }

   public function sendError($error , $errorMessage=[] , $code = 404)
   {
       $response = [
        'success' => false,
        'data' => $error
       ];
       if (!empty($errorMessage)) {
        $response['data'] = $errorMessage;
       }
       return response()->json($response , $code);
   }
}