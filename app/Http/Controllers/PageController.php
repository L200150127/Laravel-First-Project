<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Siswa;
use App\Artikel;
use App\Guru;
use App\Materi;
use App\Kelas;
use App\Prestasi;
use App\Foto;
use App\Agenda;
use App\Dana;

class PageController extends Controller
{
    public function homePage()
    {
        // Lewatkan data ke view yang sesuai
        $artikelTerbaru = Artikel::latest()->take(1)->get();
        $artikelBaru    = Artikel::latest()->skip(1)->take(3)->get();
        $siswaCount     = Siswa::count();
        $guruCount      = Guru::count();
        $prestasiCount  = Prestasi::count();
        $materi         = Materi::latest()->take(3)->get();
        $agendaBulanIni = Agenda::whereMonth('tgl_mulai', (date('m',   strtotime('this month'))))->orderBy('tgl_mulai', 'asc')->get();
        $fotoTerbaru    = Foto::latest()->take(4)->get();

        return view('guests.homepage', compact('artikelTerbaru', 'artikelBaru', 'siswaCount', 'guruCount', 'prestasiCount', 'materi', 'agendaBulanIni', 'fotoTerbaru'));
    }

    public function struktur()
    {
        $kepalaSekolah = Guru::where('jabatan', 'LIKE', "%Kepala Sekolah%")->limit(1)->get();
        $komiteSekolah = Guru::where('jabatan', 'LIKE',"%Komite%")->get();
        $bendahara     = Guru::where('jabatan', 'LIKE', "%Bendahara%")->get();
        $unitPerpus    = Guru::where('jabatan', 'LIKE', "%Perpus%")
        ->get();
        $waliKelas    = Kelas::all();
        return view('guests.struktur')
        ->withWaliKelas($waliKelas)
        ->withKepalaSekolah($kepalaSekolah)
        ->withKomiteSekolah($komiteSekolah)
        ->withBendahara($bendahara)
        ->withUnitPerpus($unitPerpus);
    }

    public function materi()
    {
    	$materi = Materi::latest()->paginate();
        return view('guests.materi')->withMateri($materi);
    }

    public function prestasi()
    {
        $prestasi = Prestasi::orderBy('tahun', 'desc')->paginate();
        return view('guests.prestasi-prestasi')->withPrestasi($prestasi);
    }

    public function dana()
    {
        $dana = Dana::orderBy('tanggal', 'desc')->paginate();
        return view('guests.dana')->withDana($dana);
    }

    public function showGuru()
    {
    	$guru = Guru::orderBy('nama', 'asc')->paginate();
        return view('guests.data-guru')->withGuru($guru);
    }

    public function ShowSiswa()
    {
    	$siswa = Siswa::where('status', 0)
        ->orderBy('nis', 'desc')->paginate();
        return view('guests.data-siswa')->withSiswa($siswa);
    }

    public function ShowAlumni()
    {
    	$alumni = Siswa::where('status', 1)
        ->orderBy('nis', 'desc')->paginate();
        return view('guests.data-alumni')->withAlumni($alumni);
    }

    public function albumFoto()
    {
        $galeri = Foto::latest()->paginate();
        return view('guests.album-foto')->withGaleri($galeri);
    }

    public function postContact(Request $request)
    {

        $this->validate($request, [
            'name'  => 'required|string', 
            'email'  => 'required|email', 
            'phone'  => 'nullable|numeric', 
            'call_time'  => 'nullable',
            'comments'  => 'required|string|min:10'
        ]);
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'call_time' => $request->call_time,
            'comments' => $request->comments
        ];
        // var_dump($data);
        Mail::send('emails.kontak', $data, function ($message) use ($data) {
            $message->from($data['email']);
            $message->to('noreply@mimpucangan.com');
            $message->subject($data['name']);
        });
        // Tampilkan pesan flash
        $request->session()->flash('success', 'Pesan Anda Telah Terkirim.');
        // Redirect ke halaman lain
        return redirect('kontak');
    }
}
