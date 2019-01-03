<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Kelas as KelasResource;
use App\Http\Resources\Mapel as MapelResource;

class Jadwal extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $jam_mulai = new \DateTime($this->jam_mulai);
        $jam_selesai = new \DateTime($this->jam_selesai);

        return [
            'id'          => $this->id,
            'id_kelas'    => $this->id_kelas,
            'id_mapel'    => $this->id_mapel,
            'hari'        => $this->hari,
            'jam_mulai'   => $jam_mulai->format('H:i'),
            'jam_selesai' => $jam_selesai->format('H:i'),
            'kelas'       => new KelasResource($this->kelas),
            'mapel'       => new MapelResource($this->mapel),
        ];
    }
}
