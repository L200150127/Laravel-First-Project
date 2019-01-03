<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Kelas as KelasResource;
use App\Http\Resources\Mapel as MapelResource;

class Materi extends JsonResource
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
            'id'       => $this->id,
            'nama'     => $this->nama,
            'path'     => $this->path,
            'id_kelas' => $this->id_kelas,
            'id_mapel' => $this->id_mapel,
            'kelas'    => new KelasResource($this->kelas),
            'mapel'    => new MapelResource($this->mapel),
        ];
    }
}
