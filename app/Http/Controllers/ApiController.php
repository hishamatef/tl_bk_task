<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Response;

class ApiController extends Controller
{
    const CODE_OK = 200;
    const CODE_CREATED = 201;
    const CODE_DELETED = 204;
    const CODE_NOT_FOUND = 404;
    const CODE_UNAUTHORIZED = 401;
    const CODE_INVALID_REQUEST = 422; // request parameters not valid
    const CODE_INTERNAL_SERVER_ERROR = 500;

    //Global Variable For Pagination
    const MAX_ALLOWED_PAGE_SIZE = 20;
    const DEFAULT_PAGE_SIZE = 10;

    protected function prepareResponse($code, $message = '', $data = '', $errors = '',$status_code='')
    {
        return $this->returnResponse($code,$status_code,$message,$data,$errors);
    }
    protected function ok( $message = '', $data = '', $errors = '',$status_code='')
    {
        return $this->returnResponse(self::CODE_OK,$status_code,$message,$data,$errors);
    }
    protected function invalid( $message = '', $data = '', $errors = '',$status_code='')
    {
        return $this->returnResponse(self::CODE_INVALID_REQUEST,$status_code,$message,$data,$errors);
    }
    private function returnResponse($code,$status_code,$message,$data,$errors)
    {
        return Response::json(['code' => $code,'status_code'=>$status_code, 'message' => $message, 'data' => $data, 'errors' => $errors],$code);
    }

}
