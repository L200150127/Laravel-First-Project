<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
// use App\Http\Resources\Guru as GuruResource;

class Kelas extends JsonResource
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
            'id'         => $this->id,
            'nama'       => $this->nama,
            'wali_kelas' => $this->wali_kelas,
            'guru'         => $this->guru ? [ 
                'id'   => $this->guru->id, 
                'nama' => $this->guru->nama
            ] : null,
        ];
    }
}
