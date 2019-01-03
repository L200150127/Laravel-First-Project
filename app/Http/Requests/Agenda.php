<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
// use Illuminate\Validation\Rule;
// use Gate;

class Agenda extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Otorisasi penggunaan FormRequest
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nama'        => 'bail|required|string|max:100',
            'jenis'       => 'required|in:kegiatan,rapat,libur,ujian',
            'deskripsi'   => 'nullable|string|max:255',
            'warna'       => 'required|regex:/^#(?:[0-9a-fA-F]{6}){1,2}$/i',
            'tgl_mulai'   => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
        ];
    }
}
