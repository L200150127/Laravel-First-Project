<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Gate;

class User extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Otorisasi penggunaan FormRequest
        // Approach Ke-1
        // $this->authorize('isAdmin');
        // Approach Ke-2
        if (Gate::allows('isAdmin')) {
            return true;
        }
        // Approach Ke-3
        // return true;
        // Approach Ke-4
        // return auth()->check();
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
            $password_r = 'nullable|string|min:6|confirmed';
            $email_r = 'required|string|email|max:255|unique:users,email,' . $this->input('id');

        } else {
            $password_r = 'required|string|min:6|confirmed';
            $email_r = 'required|string|email|max:255|unique:users';
        }

        return [
           'name'     => 'required|string|max:255',
           'email'    => $email_r,
           'bio'      => 'nullable|string',
           'type'     => 'nullable|string|max:255',
           // 'photo'    => 'filled|image|max:2028',
           'password' => $password_r,
        ];
    }
}
