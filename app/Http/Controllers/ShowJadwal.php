<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jadwal;
use App\Kelas;

class ShowJadwal extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $kelas = Kelas::findOrFail($id);
        $jadwalSenin = Jadwal::where('id_kelas', $id)->where('hari', 'senin')->get();
        $jadwalSelasa = Jadwal::where('id_kelas', $id)->where('hari', 'selasa')->get();
        $jadwalRabu = Jadwal::where('id_kelas', $id)->where('hari', 'rabu')->get();
        $jadwalKamis = Jadwal::where('id_kelas', $id)->where('hari', 'kamis')->get();
        $jadwalJumat = Jadwal::where('id_kelas', $id)->where('hari', 'jumat')->get();
        $jadwalSabtu = Jadwal::where('id_kelas', $id)->where('hari', 'sabtu')->get();
        return view('guests.jadwal', 
            compact('kelas', 'jadwalSenin', 'jadwalSelasa', 'jadwalRabu', 'jadwalKamis', 'jadwalJumat', 'jadwalSabtu'));
    }
}
