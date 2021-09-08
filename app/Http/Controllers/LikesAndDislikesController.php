<?php

namespace App\Http\Controllers;

use App\Models\LikesAndDislikes;
use Illuminate\Http\Request;
use App\Http\Requests\likesstoreReqest;
use App\Http\Requests\likesupdateReqest;
use App\Services\BaseService;
use Illuminate\Support\Facades\Auth;

class LikesAndDislikesController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(likesstoreReqest $request,BaseService $baseservice)
    {
        $like= LikesAndDislikes::with(['user','house'])->where('house_id',$request->house_id)->where('user_id',Auth::user()->id)->get();
        if(count($like)<1){
             $like =LikesAndDislikes::with(['user','house'])->create([
                'likeState'=>$request->likeState,
                'user_id'=>Auth::user()->id,
                'house_id'=>$request->house_id,
            ]);
            return $baseservice->sendResponse($like,'like created successfully');
        }
        return $baseservice->sendError('you have already liked this house');        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LikesAndDislikes  $likesAndDislikes
     * @return \Illuminate\Http\Response
     */
    public function update(likesupdateReqest $request,$id ,BaseService $baseservice)
    {
        $like= LikesAndDislikes::with(['user','house'])->where('house_id',$id)->where('user_id',Auth::user()->id)->first();
        // dd($like);
        if($like){
            $like->update($request->validated());
            return $baseservice->sendResponse($like,'got like successfully');
        }
        return $baseservice->sendError('house id not found');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LikesAndDislikes  $likesAndDislikes
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,BaseService $baseservice)
    {
        $like= LikesAndDislikes::with(['user','house'])->where('house_id',$id)->where('user_id',Auth::user()->id)->first();
        if($like){
             $like->delete();
            return $baseservice->sendResponse($like,' like deleted successfully');
        }
        return $baseservice->sendError('house id not found');
    }
}
