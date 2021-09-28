<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BaseService;

class ApiController extends Controller
{
    private $baseservice;

     public function __construct(BaseService $baseservice)
    {
      $this->baseservice=$baseservice;
    }
    /**
     * Display a listing of the resource.
     *@param   $data
     * @return \Illuminate\Http\Response
     */
    public function sentsussesfully($data ,$page=0)
    {
        return $this->baseservice->sendResponse($data,'data sent sussesfully',$page);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sentunsussesfully()
    {
        return $this->baseservice->sendError('data was not sent sussesfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createdsussesfully($data)
    {
       return $this->baseservice->sendResponse($data,'data created sussesfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createunsussesful()
    {
        return $this->baseservice->sendError('was not created');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function updated($data)
    {
        return $this->baseservice->sendResponse($data,'data updated sussesfully');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function deleted($data)
    {
        return $this->baseservice->sendResponse($data,'data deleted sussesfully');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function undeleted($data)
    {
        return $this->baseservice->sendResponse($data,'data was not deleted');
    }
}
