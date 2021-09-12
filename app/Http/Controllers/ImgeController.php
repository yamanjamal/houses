<?php

namespace App\Http\Controllers;

use App\Models\Imge;
use App\Models\House;
use Illuminate\Http\Request;
use App\Services\BaseService;
use App\Http\Resources\ImgeResource;
use App\Http\Requests\ImgeRequest;
use App\Http\Requests\DeleteImageRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ImgeUpdateRequest;

class ImgeController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImgeRequest $request,BaseService $baseservice)
    {
        $house= House::with(['imeges','comments','user'])->where('id',$request->house_id)->where('user_id',Auth::user()->id)->first();
        if($house){
            $file=$request->file('src');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('uploads/houses/',$filename);

            $imge =Imge::with('house')->create([
                'src'=>$filename,
                'house_id'=>$request->house_id,
                'user_id'=>Auth::user()->id,
            ]);
            return $baseservice->sendResponse(new ImgeResource($imge),'created successfully');
        }
        return $baseservice->sendError('you didnt post this house (id not found)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Imge  $imge
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteImageRequest $request,$id,BaseService $baseservice)
    {
        $imge =Imge::with('house')->where('user_id',Auth::user()->id)->find($id);
        if($imge){
            $house= House::withcount('imeges')->where('id',$request->house_id)
            ->where('user_id',Auth::user()->id)->first();
            if($house['imeges_count']>1){

                $imge->delete();
                return $baseservice->sendResponse(new ImgeResource($imge),' imge deleted successfully');
            }
            return $baseservice->sendError('the house cant have no images');
        }
        return $baseservice->sendError('you didnt post this image (id not found)');
    }
}
