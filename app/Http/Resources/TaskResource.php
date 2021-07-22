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
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'attachment_url' => $this->attachment_url,
            'created_at' => $this->created_at->toDateTimeString(),
            'done_at' => optional($this->done_at)->toDateTimeString(),
        ];
    }
}
