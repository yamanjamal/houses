<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\BaseService;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request,BaseService $baseservice){
        
        $input=$request->validated();
        $input['password']=Hash::make($input['password']);
        // dd($input['img']);


        // +++++++++++++++++++img++++++++++++++++++++
        // if ($input['img']) {
        //     $photo=$request->img;
        //     $newphoto=time().$photo->getClientOriginalName();

        //     $photo->move('uploads/houses/',$newphoto);
        //     $input['img']='uploads/houses/'.$newphoto;
        // }
        // +++++++++++++++++++img++++++++++++++++++++
        
        $user=User::create($input);
        $token['token']=$user->createtoken('fastest,project')->plainTextToken;
        $response=[
            'user'=>$user,
            // 'token'=>$token,
        ];
        return $baseservice->sendResponse($response,'user regsterd successfully');
    }

    public function login(LoginRequest $request,BaseService $baseservice){
       
        $user=User::where('email',$request->email )->first();
        if (!$user) {
            return $baseservice->sendError('thier is no such email');
        }

        if (!Hash::check($request->password ,$user->password)) {
            return $baseservice->sendError('Incorrect password');
        }

        $token['token']=$user->createtoken('fastest,project')->plainTextToken;

        $response=[
            'user'=>$user,
            'token'=>$token,
        ];
        return $baseservice->sendResponse($response,'you logged in congrats');
    }
    
    public function logout(Request $request){
       
        auth()->user()->tokens()->delete();
        return ['message'=>'logged out'];
    }
}
