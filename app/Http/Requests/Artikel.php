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
        // return auth()->check();
        $user = Auth::user();

        if (strtolower($user->type) == 'admin') {
            return true;
        }

        if (Auth::check()) {
            $artikel = ArtikelModel::find($this->input('id_user'));
            if (!$artikel || $artikel->id_user != Auth::id()) {
                return false;
            }
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // Cek Apakah HTTP Method == PUT atau PATCH
        if ($this->method() == 'PATCH' || $this->method() == 'PUT') {
            $slug_r = 'required|alpha_dash|min:5|max:255|unique:artikel,slug,' . $this->route('artikel')->slug;
            if ($this->input('slug') == $this->route('artikel')->slug) {
                return [
                    'judul'        => 'required|string|max:255',
                    'isi'          => 'required|string',
                    'gambar_cover' => 'sometimes|image|max:2048',
                    'id_kategori'  => 'nullable|integer',
                    'id_user'      => 'nullable|integer',
                ];
            }
        } else {
            $slug_r = 'required|alpha_dash|min:5|max:255|unique:artikel,slug';
        }

        return [
            'judul'        => 'required|string|max:255',
            'isi'          => 'required|string',
            'slug'         => $slug_r,
            'gambar_cover' => 'sometimes|image|max:2048',
            'id_kategori'  => 'nullable|integer',
            'id_user'      => 'nullable|integer',
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