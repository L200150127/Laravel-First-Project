<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SiswaCollection extends ResourceCollection
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
                'self'        => route('siswa.index'),
                'order'       => route('siswa.urut'),
                'orderAlumni' => route('alumni.urut'),
                'cari'        => route('siswa.cari'),
                'batasUmur'   => strtotime('this year -4 year') * 1000,
                'tahunDepan'  => strtotime('next year') * 1000,
            ],
        ];
    }
}
