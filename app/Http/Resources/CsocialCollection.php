<?php

namespace App\Http\Resources;

use App\Http\Resources\CsocialResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CsocialCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        try{
            return $this->collection;
        }
        catch(\Exception $e){
            // TODO: Log Error
            // TODO: Generate more proper response
            response()->json( ['result' => 'error'], 500 );
        }
    }
}
