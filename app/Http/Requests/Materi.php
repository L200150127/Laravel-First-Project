<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\StringNull;

class Materi extends FormRequest
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
            $file_rules = 'sometimes|file|max:4096';
            $id_rules = 'nullable|string';
        } else {
            $file_rules = 'required|file|max:4096';
            $id_rules = 'nullable|integer';
        }
        return [
            'nama'     => 'required|string|max:100',
            'file'     => $file_rules,
            'id_kelas' => $id_rules,
            'id_mapel' => $id_rules,
        ];
    }
}
