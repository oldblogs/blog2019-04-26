<?php 

namespace App\Http\Resources;

use App\Http\Resources\MediumResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class MediumCollection extends ResourceCollection {
  /**
   * Trasform the resource collection into an array.
   * 
   * @param \Illuminate\Http\Request $request
   * @return array
   */
  public function toArray($request){
    try{
      return parent::toArray($request);
    }
    catch(\Exception $e){
      // TODO: Log Error
      // TODO: Generate more proper response
      response()->json( ['result' => 'error'], 500 );
    }

  }
}