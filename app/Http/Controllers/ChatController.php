<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\ChatGroups;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ChatRequest;
use App\Http\Requests\ChatUpdateRequest;
use App\Http\Controllers\ApiController;

class ChatController extends ApiController
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChatRequest $request)
    {
        // https://via.placeholder.com/250x376
        $chat=ChatGroups::find($request->chat_groups_id);
        if($chat->owner_id ==Auth::id() || $chat->user_id ==Auth::id()){
            $Chat =Chat::create([
                'user_id'=>Auth::id(),
                'message'=>$request->message,
                'chat_groups_id'=>$request->chat_groups_id,
            ]);
            return $Chat?$this->createdsussesfully($Chat):createunsussesful();
        }
        return $this->sentunsussesfully('you cant send to chat you didnt make');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(ChatUpdateRequest $request, Chat $chat)
    {
        if ($chat->user_id==Auth::id()) {
            $chat->update($request->validated());
            return $this->updated($chat);
        }
        return $this->unupdated('you cant update chat you didnt make');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        if ($chat->user_id==Auth::id()) {
            $chat->delete();
            return $this->deleted($chat);
        }
        return $this->undeleted('you cant delete chat you didnt make');
    }
}
