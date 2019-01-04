<?php

namespace App\Http\Controllers\API;

use App\Kelas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Kelas as KelasResource;
use App\Http\Resources\KelasCollection;

class KelasController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Otentikasi Middleware API dengan Laravel Passport
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        // Ambil semua data dalam DB
        // Kembalikan ke user dalam bentuk Collection Resource
        return new KelasCollection(Kelas::all());
    }

    /**
     * Display a listing of partial resource.
     * @return \App\Http\Resources
     */
    public function getListKelas()
    {
        // Otorisasi Hak Akses Admin
        // $this->authorize('isAdmin');
        // Ambil semua data dalam DB
        $kelas = Kelas::select('id', 'nama')->get();
        // Kembalikan ke user dalam bentuk Collection Resource
        return new KelasCollection($kelas);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        // Validasi data server
        $validatedData = $request->validate([
            'nama'       => 'required|string|max:50',
            'wali_kelas' => 'nullable|integer',
        ]);

        // Buat Objek Eloquent Model
        $kelas = new Kelas;
        // Mass Assignment Save Data Ke Database
        if ($kelas->fill($validatedData)->save()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new KelasResource($kelas);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Kelas $kelas)
    {
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        // Validasi data server
        $validatedData = $request->validate([
            'nama'       => 'required|string|max:50',
            'wali_kelas' => 'nullable|integer',
        ]);

        // Mass Assignment Update Data
        if ($kelas->update($validatedData)) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new KelasResource($kelas);
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kelas  $kelas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kelas $kelas)
    {
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        if ($kelas->delete()) {
           // Kembalikan Resource dalam bentuk API Resorces
           return new KelasResource($kelas);
        }
    }
}
