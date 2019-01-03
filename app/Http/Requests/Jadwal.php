<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Jadwal extends FormRequest
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
            'id_kelas'       => 'required|integer',
            'id_mapel'       => 'required|integer',
            'hari'           => 
            'required|in:senin,selasa,rabu,kamis,jumat,sabtu',
            'jam_mulai'      => 
            'required|date_format:"H:i"|before:jam_selesai',
            'jam_selesai'    => 'required|date_format:"H:i"|after:jam_mulai',
        ]; 
    }
}
