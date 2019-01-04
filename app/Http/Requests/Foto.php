<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Foto extends FormRequest
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
        // Cek Apakah HTTP Method == PUT atau PATCH
        if ($this->method() == 'PATCH' || $this->method() == 'PUT') {
            $foto_rules = 'sometimes|image|mimes:jpeg,jpg,png|max:4096';
        } else {
            $foto_rules = 'required|image|mimes:jpeg,jpg,png|max:4096';
        }
        return [
            'nama'      => 'required|string|max:100',
            'deskripsi' => 'required|string|max:255',
            'foto'      => $foto_rules,
        ];
    }
}