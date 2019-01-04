<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Siswa;
use App\Artikel;
use App\Guru;
use App\Kelas;
use App\Materi;
use App\Prestasi;
use App\Foto;
use App\Agenda;

class DashboardCOntroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userCount     = User::count();
        $siswaCount    = Siswa::count();
        $artikelCount  = Artikel::count();
        $guruCount     = Guru::count();
        $kelasCount    = Kelas::count();
        $materiCount   = Materi::count();
        $prestasiCount = Prestasi::count();
        $alumniCount    = Siswa::where('status', 1)->count();
        $fotoTerbaru    = Foto::latest()->take(3)->get();
        $agendaBulanIni    = Agenda::whereMonth('tgl_mulai', (date('m',   strtotime('this month'))))->orderBy('tgl_mulai', 'asc')->get();
        
        return response()->json([ 
            'jumlahUser' => $userCount, 
            'jumlahSiswa' => $siswaCount, 
            'jumlahArtikel' => $artikelCount, 
            'jumlahGuru' => $guruCount, 
            'jumlahKelas' => $kelasCount, 
            'jumlahMateri' => $materiCount, 
            'jumlahPrestasi' => $prestasiCount, 
            'jumlahAlumni' => $alumniCount, 
            'fotoTerbaru' => $fotoTerbaru,
            'agendaBulanIni' => $agendaBulanIni
        ]);
    }
}
