<?php

namespace App\Http\Resources;

use App\Models\Product;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TaskCollection extends ResourceCollection
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
            'data' => TaskResource::collection($this->collection),
            'links' => [
                'self' => route('api.v1.tasks.index')
            ],
            'meta' => [
                'tasks_count' => $this->collection->count()
            ]
        ];
    }
}
