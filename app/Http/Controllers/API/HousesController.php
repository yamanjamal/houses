<?php

namespace App\Http\Controllers\API;

use App\Models\House;
use App\Models\Imge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Services\BaseService;
use App\Http\Resources\House as HouseResource;
use App\Http\Resources\HouseShowResource;
use App\Http\Resources\ImgeResource ;
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
        // ['approver','inprogress','declined']
        $houses =House::with(['imeges','user'])->where('approved',0)->get();
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
        $house=House::with(['imeges'])->create([
            // $request->validated()
            'title'          =>$request->title,
            'beds'           =>$request->beds,
            'baths'          =>$request->baths,
            'price'          =>$request->price,
            'place'          =>$request->place,
            'description'    =>$request->description,
            'property_type'  =>$request->property_type,
            'Balcony'        =>$request->Balcony,
            'Parking'        =>$request->Parking,
            'Pool'           =>$request->Pool,
            'Beach'          =>$request->Beach,
            'Air_condtioning'=>$request->Air_condtioning,
            'Pet_friendly'   =>$request->Pet_friendly,
            'Kid_friendly'   =>$request->Kid_friendly,
            'aprroved'          =>'inprogress',
            'user_id'        =>Auth::user()->id
        ]);
        // +++++++++++++++++++img++++++++++++++++++++

            $photo=$request->src;
            $newphoto=time().$photo->getClientOriginalName();
            $photo->move('uploads/houses/',$newphoto);
            $imge =Imge::with('house')->create([
                'src'=>'uploads/houses/'.$newphoto,
                'house_id'=>$house->id,
            ]);
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
        $house= House::with(['imeges','comments','user'])->find($id);
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
                'Balcony'        =>$request->Balcony,
                'Parking'        =>$request->Parking,
                'Pool'           =>$request->Pool,
                'Beach'          =>$request->Beach,
                'Air_condtioning'=>$request->Air_condtioning,
                'Pet_friendly'   =>$request->Pet_friendly,
                'Kid_friendly'   =>$request->Kid_friendly,
            ]);
        // +++++++++++++++++++img++++++++++++++++++++

            $imge =Imge::with('house')->where('house_id',$house->id);
            if($imge){
                $photo=$request->src;
                $newphoto=time().$photo->getClientOriginalName();
                $photo->move('uploads/houses/',$newphoto);
                $imge->update([
                   'src'=>'uploads/houses/'.$newphoto,
                   'house_id'=>$house->id,
                ]);
            }
        // +++++++++++++++++++img++++++++++++++++++++
            return $baseservice->sendResponse(new HouseResource($house),'got house successfully');
        }
        return $baseservice->sendError('house id not found');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,BaseService $baseservice)
    {
        $house= House::with(['imeges','comments','user'])->find($id);
        if($house && $house->user_id==Auth::user()->id){
             $house->delete();
            return $baseservice->sendResponse(new HouseResource($house),' house deleted successfully');
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
