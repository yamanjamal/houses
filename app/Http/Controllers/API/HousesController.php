<?php

namespace App\Http\Controllers\API;

use App\Models\House;
use App\Models\User;
use App\Models\LikesAndDislikes;
use App\Models\Imge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\BaseService;
use App\Http\Resources\House as HouseResource;
use App\Http\Resources\HouseShowResource;
use App\Http\Resources\ImgeResource;
use App\Http\Requests\HouseRequest;
use App\Http\Requests\HouseUpdateRequest;

class HousesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BaseService $baseservice)
    {   
        // dd(count(LikesAndDislikes::where('house_id',1)->where('likeState',1)->get()));
        // ['approver','inprogress','declined']

        $houses =House::with(['imeges','user','comments','LikesAndDislikes'])->where('approved',0)->get();
        return $baseservice->sendResponse(HouseResource::collection($houses),'houses sent sussesfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id ,BaseService $baseservice)
    {
        $house= House::with(['imeges','comments','user'])->find($id);
        return $house?$baseservice->sendResponse(new HouseShowResource($house),'got house successfully')
        :$baseservice->sendError('house id not found');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HouseRequest $request,BaseService $baseservice)
    { 
        $house=House::with(['imeges','comments'])->create([
            // $request->validated()
            'title'          =>$request->title,
            'beds'           =>$request->beds,
            'baths'          =>$request->baths,
            'price'          =>$request->price,
            'place'          =>$request->place,
            'description'    =>$request->description,
            'property_type'  =>$request->property_type,
            'Balcony'        =>$request->Balcony==true ? 'true' : null,
            'Parking'        =>$request->Parking==true ? 'true' : null,
            'Pool'           =>$request->Pool==true ? 'true' : null,
            'Beach'          =>$request->Beach==true ? 'true' : null,
            'Air_condtioning'=>$request->Air_condtioning==true ? 'true' : null,
            'Pet_friendly'   =>$request->Pet_friendly==true ? 'true' : null,
            'Kid_friendly'   =>$request->Kid_friendly==true ? 'true' : null,
            'aprroved'       =>'inprogress',
            'user_id'        =>Auth::user()->id,
        ]);
        // +++++++++++++++++++img++++++++++++++++++++
            // $photo=$request->src;
            // $newphoto=time().$photo->getClientOriginalName();
            // // dd($photo->move('uploads\houses/',$newphoto));
            // $photo->move('uploads\houses/',$newphoto);
            // $imge =Imge::with('house')->create([
            //     'src'=>'\uploads\houses.'.$newphoto,
            //     'house_id'=>$house->id,
            // ]);
            // ++++++++++test+++++++++
        if($request->hasfile('src')){
            $file=$request->file('src');
            $extension=$file->getClientOriginalExtension();
            $filename=time().'.'.$extension;
            $file->move('uploads/houses/',$filename);
            $imge =Imge::with('house')->create([
                'src'=>$filename,
                'user_id'=>Auth::user()->id,
                'house_id'=>$house->id,
            ]);
        }
        // +++++++++++++++++++img++++++++++++++++++++
        return $baseservice->sendResponse(new HouseResource($house),'created successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HouseUpdateRequest $request, $id,BaseService $baseservice)
    {
        // dd($house->Pet_friendly);
        $house= House::with(['imeges','comments','user'])->where('user_id',Auth::user()->id)->find($id);
        if($house){
            $house->update([
                // $request->validated()
                'title'          =>$request->title,
                'beds'           =>$request->beds,
                'baths'          =>$request->baths,
                'price'          =>$request->price,
                'place'          =>$request->place,
                'description'    =>$request->description,
                'property_type'  =>$request->property_type,
                'Balcony'        =>isset($request->Balcony) ? $request->Balcony : $house->Balcony,
                'Parking'        =>isset($request->Parking)? $request->Parking : $house->Parking,
                'Pool'           =>isset($request->Pool)? $request->Pool : $house->Pool,
                'Beach'          =>isset($request->Beach) ? $request->Beach : $house->Beach,
                'Air_condtioning'=>isset($request->Air_condtioning) ? $request->Air_condtioning : $house->Air_condtioning,
                'Pet_friendly'   =>isset($request->Pet_friendly) ? $request->Pet_friendly : $house->Pet_friendly,
                'Kid_friendly'   =>isset($request->Kid_friendly) ? $request->Kid_friendly : $house->Kid_friendly,
            ]);
        // +++++++++++++++++++img++++++++++++++++++++

            // $imge =Imge::with('house')->where('house_id',$house->id)->first();
            // $imge->update([
            //    'src'=>$request->src,
            //    'house_id'=>$house->id,
            // ]);


            // +++++++++++++++++++++++++++++++
            // $imge =Imge::with('house')->where('house_id',$house->id)->get();
            // if($imge){
            //     $photo=$request->src;
            //     $newphoto=time().$photo->getClientOriginalName();
            //     $photo->move('uploads/houses/',$newphoto);
            //     $imge->update([
            //        'src'=>'uploads/houses/'.$newphoto,
            //        'house_id'=>$house->id,
            // }
        // +++++++++++++++++++img++++++++++++++++++++
            return $baseservice->sendResponse(new HouseResource($house),'got house successfully');
        }
        return $baseservice->sendError('you didnt post this house (id not found)');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,BaseService $baseservice)
    {
        $house= House::with(['imeges','comments'])->where('user_id',Auth::user()->id)->find($id);
        // dd($house);
         // && $house->user_id==Auth::user()->id
        if($house){
             $house->delete();
            return $baseservice->sendResponse($house,' house deleted successfully');
        }
        return $baseservice->sendError('house id not found');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $title
     * @return \Illuminate\Http\Response
     */
    public function search($title,BaseService $baseservice)
    {
        $houses= House::with(['imeges','comments','user'])->where('title','like','%'.$title.'%')->get();
        if (count($houses)>0) {
            return $baseservice->sendResponse(HouseResource::collection($houses),'got houses successfully');
        }
        return $baseservice->sendError('house title not found');
    }
}
