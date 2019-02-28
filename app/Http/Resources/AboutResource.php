<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      try{
        return parent::toArray($request);
      }
      catch(\Exception $e){
        // TODO: Log Error
        // TODO: Generate more proper error response
        response()->json(['result' => 'error'], 500);
      }
    }
}
