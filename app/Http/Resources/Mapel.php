<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Guru as GuruResource;

class Mapel extends JsonResource
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
            'id'   => $this->id,
            'nama' => $this->nama,
            'guru' => GuruResource::collection($this->whenLoaded('guru')),
        ];
    }
}
