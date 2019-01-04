<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Siswa extends FormRequest
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
            $nis_r = 'required|numeric|digits:18|unique:siswa,nis,' . 
            $this->route('siswa')->id;
            if ($this->input('nis') == $this->route('siswa')->nis) {
                return [
                    'nisn'          => 'nullable|numeric|digits:10',
                    'nama'          => 'required|string|max:50',
                    'alamat'        => 'required|string|max:255',
                    'jenis_kelamin' => 'required|in:L,P',
                    'tgl_lahir'     => 'required|date' .
                    '|before:"this year -4 year"|after:"1 January 2000"',
                    'foto'          => 'sometimes|image|max:4096',
                    'status'        => 'nullable|between:0,2',
                    'tahun_masuk'   => 'nullable|numeric|date_format:"Y"' . 
                    '|after:tgl_lahir|before:"next year"',
                    'tahun_lulus'   => 'nullable|numeric|date_format:"Y"' . 
                    '|after:tgl_lahir|before:"next year"',
                ];
            }
        } else {
            $nis_r = 'required|numeric|digits:18|unique:siswa,nis';
        }

        // dd($this->input('nis'));
        return [
            'nis'           => $nis_r,
            'nisn'          => 'nullable|numeric|digits:10',
            'nama'          => 'required|string|max:50',
            'alamat'        => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:L,P',
            'tgl_lahir'     => 'required|date' .
            '|before:"this year -4 year"|after:"1 January 2000"',
            'foto'          => 'sometimes|image|max:4096',
            'status'        => 'nullable|between:0,2',
            'tahun_masuk'   => 'nullable|numeric|date_format:"Y"' . 
            '|after:tgl_lahir|before:"next year"',
            'tahun_lulus'   => 'nullable|numeric|date_format:"Y"' . 
            '|after:tgl_lahir|before:"next year"',
        ]; 
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'tgl_lahir.before' => 'isian tanggal lahir belum mencukupi untuk menjadi siswa, minimal 5 tahun',
            'tgl_lahir.after' => 'isian tanggal lahir harus setelah tanggal 1 Januari 2000',
        ];
    }
}
