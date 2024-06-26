<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public $status;
    public $message;
    public $resource;

    public function __construct($status, $message, $resource)
    {
        parent::__construct($resource);
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'status' => $this->status,
            'message' => $this->message,
            'data' => $this->resource,
            // 'data' => [
            //     'id' => $this->id,
            //     'title' => $this->title,
            //     'slug' => $this->slug,
            //     'content' => $this->content,
            //     'image' => $this->image,
            //     'created_at' => $this->created_at,
            //     'updated_at' => $this->updated_at,
            // ],
        ];
    }
}
