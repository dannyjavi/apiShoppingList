<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TaskResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'type' => 'tasks',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'uuid_task' => $this->resource->uuid_task,
                'title' => $this->resource->title,
                'slug' => $this->resource->slug,
                'description' => $this->resource->description,
                'status' => $this->resource->status,
                'created_by' => $this->resource->created_by,
                'user_id' => $this->resource->user_id
            ],
            'links' => [
                'self' => route('api.v1.tasks.show', $this->resource)
            ]
        ];
    }
}
