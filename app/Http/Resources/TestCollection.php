<?php

namespace App\Http\Resources;

use App\Http\Resources\TestResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TestCollection extends ResourceCollection
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
            'tests' => $this->collection,
            'links' => [
                'self' => 'tests',
            ],
        ];
    }
}
