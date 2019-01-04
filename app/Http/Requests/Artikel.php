<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Artikel as ArtikelModel;

class Artikel extends FormRequest
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
        // $user = Auth::user();

        // if (strtolower($user->type) == 'admin') {
        //     return true;
        // }

        // if (Auth::check()) {
        //     $artikel = ArtikelModel::find($this->input('id_user'));
        //     if (!$artikel || $artikel->id_user != Auth::id()) {
        //         return false;
        //     }
        //     return true;
        // }

        // return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'judul'        => 'required|string|max:255',
            'isi'          => 'required|string',
            'gambar_cover' => 'sometimes|image|max:4096',
        ];
    }


    /**
     * Melakukan validasi lebih lanjut setelah proses validasi utama selesai.
     *
     * @return array
     */
    public function withValidator($validator)
    {
        // Mensanitasi Isi artikel menggunakan HTML Purifier
        $validator->after(function ($validator) {
            clean($this->input('isi'));
        });
        return;
    }
}