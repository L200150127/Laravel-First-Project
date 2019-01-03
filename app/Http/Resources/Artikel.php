<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Kategori as KategoriResource;

class Artikel extends JsonResource
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
            'id'           => $this->id,
            'judul'        => $this->judul,
            'slug'         => $this->slug,
            'isi'          => $this->isi,
            'gambar_cover' => $this->gambar_cover,
            'status'       => $this->status,
            'id_kategori'  => $this->id_kategori,
            'id_user'      => $this->id_user,
            'kategori'     => new KategoriResource($this->kategori),
            'user'         => $this->user ? [ 
                'id'   => $this->user->id, 
                'nama' => $this->user->name
            ] : null,
        ];
    }
}
