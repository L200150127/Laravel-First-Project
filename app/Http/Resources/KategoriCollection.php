<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class KategoriCollection extends ResourceCollection
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
                'self' => route('kategori.index'),
                'order' => route('kategori.urut'),
                'cari' => route('kategori.cari'),
            ]
        ];
    }
}
