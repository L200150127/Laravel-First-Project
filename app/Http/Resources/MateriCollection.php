<?php

namespace App\Http\Resources;

use App\Kelas;
use App\Mapel;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Kelas as KelasResource;
use App\Http\Resources\Mapel as MapelResource;

class MateriCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }

    public function with($request)
    {
        return [
            'links'    => [
                'self'  => route('materi.index'),
                'order' => route('materi.urut'),
                'cari'  => route('materi.cari'),
            ],
        ];
    }
}
