<?php

namespace App\Http\Controllers\API;

use App\Jadwal;
use App\Mapel;
use App\Kelas;
use Illuminate\Http\Request;
use App\Http\Requests\Jadwal as JadwalRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Jadwal as JadwalResource;
use App\Http\Resources\JadwalCollection;

class JadwalController extends Controller
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
        $jadwal = Jadwal::orderBy('id_kelas')->paginate();
        // Kembalikan ke user dalam bentuk Collection Resource
        return new JadwalCollection($jadwal);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\JadwalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(JadwalRequest $request)
    {
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        // Ambil data yang sudah divalidasi
        $validated = $request->validated();
        // Buat Objek Eloquent Model
        $jadwal = new Jadwal;
        // Mass Assignment Save Data Ke Database
        if ($jadwal->fill($validated)->save()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new JadwalResource($jadwal);
        }
    }

    /**
     * Display the specified resource by search query.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        // Validasi terhadap query
        $this->validate($request, ['q' => 'nullable|string|max:50']);

        if ($search = $request->q) {
            $mapelArr = Mapel::where('nama', 'LIKE', "%$search%")->pluck('id')->toArray();
            $kelasArr = Kelas::where('nama', 'LIKE', "%$search%")->pluck('id')->toArray();
            $jadwal = Jadwal::where(function($query) 
                use ($search, $mapelArr, $kelasArr) {
                $query->whereIn('id_kelas', $kelasArr)
                ->orWhereIn('id_mapel', $mapelArr)
                ->orWhere('hari', 'LIKE', "%$search%");
            })->paginate();
            return new JadwalCollection($jadwal);
        } else {
            return $this->index();
        }
    }

    /**
     * Display a listing of sorted resource.
     * @param  Illuminate\Http\Request $request
     * @return \App\Http\Resources
     */
    public function orderBy(Request $request)
    {
        // Validasi terhadap query
        $this->validate($request, [
            'kolom' => 'required|string|max:50',
            'mode' => 'required|string|in:asc,desc'
        ]);
        // Melakukan Pengurutan berdasarkan Kolom dan Mode
        if ($request->kolom) {
            return new JadwalCollection(Jadwal::orderBy($request->kolom, 
                $request->mode)->paginate());
        } else {
            return $this->index();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\JadwalRequest  $request
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function update(JadwalRequest $request, Jadwal $jadwal)
    {
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        // Retrieve the validated input data...
        $validated = $request->validated();
        // Mass Assignment Update Data
        if ($jadwal->update($validated)) {
            // Kembalikan Resource dalam bentuk API Resources
            return new JadwalResource($jadwal);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Jadwal  $jadwal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jadwal $jadwal)
    {
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        if ($jadwal->delete()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new JadwalResource($jadwal);
        }
    }
}
