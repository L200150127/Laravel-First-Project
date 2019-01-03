<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
            'nama'     => 'required|string|max:100',
            'file'     => 'required|file|max:4096',
            'id_kelas' => 'nullable|integer',
            'id_mapel' => 'nullable|integer|max:20',
        ];
    }
}
