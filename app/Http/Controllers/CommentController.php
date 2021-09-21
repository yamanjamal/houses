<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Resources\CommntResource;
use App\Http\Requests\CommentStoreRequest;
use App\Http\Requests\CommentUpdateRequest;
use App\Models\Comment;

class CommentController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommentStoreRequest $request)
    {
      $Comment =Comment::with(['user','house'])->create($request->validated());
        return $this->createdsussesfully(new CommntResource($Comment));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(CommentUpdateRequest $request,Comment $comment)
    {
        $comment->update($request->validated());
         return $this->updated(new CommntResource($comment));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return $this->deleted(new CommntResource($comment));
    }
}
