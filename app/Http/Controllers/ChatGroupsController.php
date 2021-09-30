<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\House;
use App\Models\ChatGroups;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ApiController;
use App\Http\Requests\ChatGroupsRequest;
use App\Http\Requests\ChatGroupsUpdateRequest;

class ChatGroupsController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chats= ChatGroups::select('id','name','src','user_id','created_at')->where('user_id',Auth::id())->orwhere('owner_id',Auth::id())->latest()->get();
       return $chats?$this->sentsussesfully($chats):$this->sentunsussesfully();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChatGroupsRequest $request)
    {
        // https://via.placeholder.com/250x376
        $ChatGroups=ChatGroups::where('owner_id',$request->owner_id)->first();
        if ($ChatGroups) {
            return $this->sentunsussesfully('you have already created a chat with this house owner');
        }
        $owner = User::where('id',$request->owner_id)->first();
        if($request->owner_id == Auth::id()){
            return $this->sentunsussesfully('you cant start chat with your self');
        }
        $ChatGroups =ChatGroups::create([
            'src'=>$owner->img,
            'name'=>$request->name,
            'owner_id'=>$request->owner_id,
            'house_id'=>$request->house_id,
            'user_id'=>Auth::id(),
        ]);
        return $this->createdsussesfully($ChatGroups);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ChatGroups  $chatGroups
     * @return \Illuminate\Http\Response
     */
    public function show(ChatGroups $chatGroups)
    {
        if ($chatGroups->user_id == Auth::id() || $chatGroups->owner_id ==Auth::id()) {
           return $this->sentsussesfully($chatGroups->loadmissing('chats'));
       }
        return $this->sentunsussesfully('you cant show chat you didnt make');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChatGroups  $chatGroups
     * @return \Illuminate\Http\Response
     */
    public function update(ChatGroupsUpdateRequest $request, ChatGroups $chatGroups)
    {
        if ($chatGroups->user_id==Auth::id() || $chatGroups->owner_id ==Auth::id()) {
            $chatGroups->update($request->validated());
            return $this->updated($chatGroups);
        }
        return $this->sentunsussesfully('you cant update chat you didnt make');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChatGroups  $chatGroups
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChatGroups $chatGroups)
    {
        if ($chatGroups->user_id==Auth::id() || $chatGroups->owner_id ==Auth::id()) {
            $chatGroups->delete();
            return $this->deleted($chatGroups);
        }
        return $this->undeleted('you cant delete chat you didnt make');
    }
}
