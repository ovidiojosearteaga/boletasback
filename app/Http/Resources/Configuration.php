<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Configuration extends JsonResource
{
  public function toArray($request)
  {
    return [
      'id' => $this->id,
      'max_tickets' => $this->max_tickets,
    ];
  }
}