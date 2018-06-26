<?php

namespace App\Http\Resources;

use App\Http\Resources\EmailResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmailCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'emails' => $this->collection,
            'links' => [
                'self' => 'emails',
            ],
        ];
    }
}
