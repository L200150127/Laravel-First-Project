<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Siswa extends JsonResource
{
    /**
     * Transform the resource into an array.
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
                'self'       => route('siswa.index'),
                'batasUmur'  => strtotime('this year -4 year') * 1000,
                'tahunDepan' => strtotime('next year') * 1000,
            ],
        ];
    }
}
