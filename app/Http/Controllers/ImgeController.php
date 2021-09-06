<?php

namespace App\Http\Controllers;

use App\Models\Imge;
use Illuminate\Http\Request;
use App\Services\BaseService;
use App\Http\Resources\ImgeResource;
use App\Http\Requests\ImgeRequest;
use App\Http\Requests\ImgeUpdateRequest;

class ImgeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BaseService $baseservice)
    {
        $imge =Imge::with('house')->get();
        return $baseservice->sendResponse(ImgeResource::collection($imge) ,'all imges sent sussesfully');    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImgeRequest $request,BaseService $baseservice)
    {
        $imge =Imge::with('house')->create([
            'src'=>$request->src,
            'house_id'=>$request->house_id,
        ]);
        return $baseservice->sendResponse(new ImgeResource($imge),'created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Imge  $imge
     * @return \Illuminate\Http\Response
     */
    public function show($id,BaseService $baseservice)
    {
        $imge =Imge::with('house')->find($id);
         return $imge?$baseservice->sendResponse(new ImgeResource($imge),'got imge successfully')
        :$baseservice->sendError('imge id not found');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Imge  $imge
     * @return \Illuminate\Http\Response
     */
    public function edit(Imge $imge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Imge  $imge
     * @return \Illuminate\Http\Response
     */
    public function update(ImgeUpdateRequest $request,$id ,BaseService $baseservice)
    {
        $imge =Imge::with('house')->find($id);
        if($imge){
            $imge->update($request->validated());
            return $baseservice->sendResponse(new ImgeResource($imge),'got imge successfully');
        }
        return $baseservice->sendError('imge id not found');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Imge  $imge
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,BaseService $baseservice)
    {
        $imge =Imge::with('house')->find($id);
        if($imge){
            $imge->delete();
            return $baseservice->sendResponse(new ImgeResource($imge),' imge deleted successfully');
        }
        return $baseservice->sendError('imge id not found');
    }
}
