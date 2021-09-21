<?php

namespace App\Http\Controllers;

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use App\Http\Resources\ImgeResource;
use App\Http\Requests\ImgeRequest;
use App\Models\Imge;
use App\Models\House;

class ImgeController extends ApiController
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImgeRequest $request,House $house)
    {
        $file=$request->file('src');
        $extension=$file->getClientOriginalExtension();
        $filename=time().'.'.$extension;
        $file->move('uploads/houses/',$filename);

        $imge =Imge::with('house')->create([
            'src'=>$filename,
            'house_id'=>$house->id,
        ]);
        $response=[
            'house_id'=>$house->id ,
            'src'=>$filename ,
            'image_id'=>$imge->id 
        ];
        return $this->createdsussesfully($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Imge  $imge
     * @return \Illuminate\Http\Response
     */
    public function destroy(Imge $img)
    {
        $house= House::withcount('imeges')->where('id',$img->house_id)
        ->first();
        if($house['imeges_count']>1){
            $img->delete();
            return $this->deleted(new ImgeResource($img));
        }
        return $this->undeleted('the house cant have no images');
    }
}
