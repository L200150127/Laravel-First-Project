<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;

class Profil extends FormRequest
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
        if ($this->has('password_baru')) {
            return [
               'password'        => 'required|string|min:6',
               'password_baru'   => 'required|string|min:6|confirmed'
            ];
        }
        return [
           'password'      => 'required|string|min:6|bail',
           'name'          => 'required|string|max:255',
           'email'         => 
           'required|string|email|max:255|unique:users,email,' . 
           $this->input('id'),
           'bio'           => 'nullable|string',
           'photo'         => 'sometimes|image|max:2028',
        ];
    }

    /**
     * Melakukan validasi lebih lanjut setelah proses validasi utama selesai.
     *
     * @return array
     */
    public function withValidator($validator)
    {
        // checks user current password before making changes
        $validator->after(function ($validator) {
            if (!Hash::check($this->input('password'), 
                $this->user()->password)) 
            {
                $validator->errors()->add('password', 'Password yang anda masukan salah');
            }
        });
        return;
    }
}
