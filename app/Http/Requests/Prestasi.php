<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Prestasi extends FormRequest
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
            'nama'       => 'required|string|max:100',
            'jenis'      => 'required|string|max:20',
            'tingkat'    => 'required|string|max:20',
            'tahun'      => 'required|numeric|date_format:"Y"',
            'pencapaian' => 'nullable|string|max:100',
        ];
    }
}
