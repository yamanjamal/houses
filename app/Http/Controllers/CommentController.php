<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\BaseService;
use App\Http\Resources\CommntResource;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;


class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(BaseService $baseservice)
    // {
    //     $Comment =Comment::with(['user','house'])->get();
    //     return $baseservice->sendResponse(CommntResource::collection($Comment) ,'all Comments sent sussesfully');
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentStoreRequest $request,BaseService $baseservice)
    {
        // dd(Auth::user()->id);
        $Comment =Comment::with(['user','house'])->create([
            'content'=>$request->content,
            'user_id'=>Auth::user()->id,
            'house_id'=>$request->house_id,
        ]);
        return $baseservice->sendResponse(new CommntResource($Comment),'created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    // public function show($id,BaseService $baseservice)
    // {
    //     $comment= Comment::with(['user','house'])->find($id);
    //      return $comment?$baseservice->sendResponse(new CommntResource($comment),'got comment successfully')
    //     :$baseservice->sendError('comment id not found');
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentUpdateRequest $request,$id ,BaseService $baseservice)
    {
        $comment= Comment::with(['user','house'])->find($id);
        if($comment){
            $comment->update($request->validated());
            return $baseservice->sendResponse(new CommntResource($comment),'updated comment successfully');
        }
        return $baseservice->sendError('comment id not found');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,BaseService $baseservice)
    {
        $comment= Comment::with(['user','house'])->find($id);
        if($comment){
             $comment->delete();
            return $baseservice->sendResponse(new CommntResource($comment),' comment deleted successfully');
        }
        return $baseservice->sendError('comment id not found');
    }
}
