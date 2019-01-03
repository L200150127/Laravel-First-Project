<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Dana extends FormRequest
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
            'jenis'    => 'required|string|max:20',
            'jumlah'   => 'required|numeric|min:1000|max:999999999.99',
            'sumber'   => 'nullable|string|max:50',
            'semester' => 'required|integer|between:1,2',
            'tanggal'  => 'nullable|date',
        ];
    }
}
