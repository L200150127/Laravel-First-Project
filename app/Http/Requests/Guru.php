<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Guru extends FormRequest
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
        if (Gate::allows('isAdmin')) {
            return true;
        }
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
            $nip_r = 'required|numeric|digits_between:10,12|unique:guru,nip,' .
                $this->route('guru')->id;
            if ($this->input('nip') == $this->guru->nip) {
                return [
                    'nama'          => 'required|string|max:50',
                    'jenis_kelamin' => 'required|in:L,P',
                    'alamat'        => 'nullable|string|max:255',
                    'jabatan'       => 'required|string|max:50',
                    'tgl_lahir'     => 'required|date' .
                    '|before:"this year -17 year"',
                    'foto'          => 'sometimes|image|max:2048',
                ];
            }
        } else {
            $nip_r = 'required|numeric|digits_between:10,12|unique:guru,nip';
        }

        return [
            'nip'           => $nip_r,
            'nama'          => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:L,P',
            'alamat'        => 'nullable|string|max:255',
            'jabatan'       => 'required|string|max:50',
            'tgl_lahir'     => 'required|date' .
            '|before:"this year -17 year"',
            'foto'          => 'sometimes|image|max:2048',
        ];  
    }
}
