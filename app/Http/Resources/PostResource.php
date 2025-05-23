<?php

namespace App\Http\Resources;

use App\Traits\HasDateTimeFormat;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
  use HasDateTimeFormat;
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id'          => $this->id,
      'category_id' => $this->category_id,
      'category_name' => $this->category->name ?? null,
      'created_at'  => $this->dateTimeFormat($this->created_at,'d.m.Y H:i:s'),
      'title'       => $this->title,
      'body'        => $this->body,
      'status'      => $this->status,
    ];
  }
}
