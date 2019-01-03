<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class GuruCollection extends ResourceCollection
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
                'self'      => route('guru.index'),
                'order'     => route('guru.urut'),
                'cari'      => route('guru.cari'),
                'batasUmur' => strtotime('this year -17 year') * 1000,
            ],
        ];
    }
}
