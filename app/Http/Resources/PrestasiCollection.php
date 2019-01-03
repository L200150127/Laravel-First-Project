<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PrestasiCollection extends ResourceCollection
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

    /**
     * Get additional data that should be returned with the resource array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function with($request)
    {
        return [
            'links'    => [
                'self'       => route('prestasi.index'),
                'order'      => route('prestasi.urut'),
                'cari'       => route('prestasi.cari'),
                'tahunDepan' => strtotime('next year') * 1000,
            ],
        ];
    }
}
