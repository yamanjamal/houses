<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Resources\HouseResource;
use App\Http\Resources\HouseShowResource;
use App\Http\Requests\HouseRequest;
use App\Http\Requests\HouseUpdateRequest;
use App\Models\House;
use App\Models\Imge;

class HousestestController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $houses = House::with('imeges')->where('approved',0)->paginate(10);
        $count = House::where('approved',0)->get();
        $pages = ceil(count($count)/10);
         return $houses?$this->sentsussesfully(HouseResource::collection($houses),$pages):
          $this->sentunsussesfully();
    }

    /**
     * Display the specified resource.
     *
     * @param  House  $house
     * @return \Illuminate\Http\Response
     */
    public function show(House $house)
    {
        return $this->sentsussesfully(new HouseShowResource($house->loadmissing(['imeges','comments'])));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HouseRequest $request)
    {   
        $house=\DB::transaction(function () use ($request) {
            $house=House::with(['imeges','comments'])->create($request->validated());
            // +++++++++++++++++++img++++++++++++++++++++
            if($request->hasfile('src')){
                $file = $request->file('src');
                $filefirstname = substr($file->getClientOriginalName(),0,-5);
                $extension = $file->getClientOriginalExtension();
                $filename = $filefirstname.time().'.'.$extension;
                $file->move('uploads/houses/',$filename);
                $imge = Imge::with('house')->create([
                    'src' =>$filename,
                    'house_id' =>$house->id,
                ]);
            // +++++++++++++++++++img++++++++++++++++++++
                return $house;
            }
        });
        return $house?$this->createdsussesfully(new HouseshowResource($house)):$this->createunsussesful();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(HouseUpdateRequest $request, House $house)
    {
            $house->update($request->validated() + [
                'Balcony'        =>$request->Balcony ?? $house->Balcony,
                'Parking'        =>$request->Parking ?? $house->Parking,
                'Pool'           =>$request->Pool    ??  $house->Pool,
                'Beach'          =>$request->Beach   ??  $house->Beach,
                'Air_condtioning'=>$request->Air_condtioning ?? $house->Air_condtioning,
                'Pet_friendly'   =>$request->Pet_friendly ?? $house->Pet_friendly,
                'Kid_friendly'   =>$request->Kid_friendly ?? $house->Kid_friendly,
            ]);
         return $this->updated(new HouseResource($house));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(House $house)
    {
        $house->delete();
        return $this->deleted(new HouseResource($house));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $title
     * @return \Illuminate\Http\Response
     */
    public function search($title)
    {
        $houses= House::with(['imeges','comments'])->where('title','like','%'.$title.'%')->get();
        if (count($houses)>0) {
            return $this->sentsussesfully(HouseResource::collection($houses));
        }
        return $this->sentunsussesfully();
    }
}
