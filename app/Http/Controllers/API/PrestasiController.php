<?php

namespace App\Http\Controllers\API;

use App\Prestasi;
use Illuminate\Http\Request;
use App\Http\Requests\Prestasi as PrestasiRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Prestasi as PrestasiResource;
use App\Http\Resources\PrestasiCollection;

class PrestasiController extends Controller
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
     * @return \App\Http\Resources
     */
    public function index()
    {
        // Ambil semua data dalam DB
        // Kembalikan ke user dalam bentuk Collection Resource
        return new PrestasiCollection(Prestasi::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\PrestasiRequest  $request
     * @return \App\Http\Resources
     */
    public function store(PrestasiRequest $request)
    {
        // Menggabungkan array data PrestasiRequest dengan data id_user
        $validated = $request->validated();
        // Buat Objek Eloquent Model
        $prestasi = new Prestasi;
        // Mass Assignment Save Data Ke Database
        if ($prestasi->fill($validated)->save()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new PrestasiResource($prestasi);
        }
    }

    /**
     * Display the specified resource by search query.
     *
     * @param  Illuminate\Http\Request $request
     * @return \App\Http\Resources
     */
    public function search(Request $request)
    {
        // Validasi terhadap query
        $this->validate($request, ['q' => 'nullable|string|max:50']);
        // Melakukan Pencarian berdasarkan query q
        if ($search = $request->q) {
            $prestasi = Prestasi::where(function($query) use ($search) {
                $query->where('nama', 'LIKE', "%$search%")
                ->orWhere('jenis', 'LIKE', "%$search%")
                ->orWhere('tingkat', 'LIKE', "%$search%")
                ->orWhere('tahun', 'LIKE', "%$search%")
                ->orWhere('pencapaian', 'LIKE', "%$search%");
            })->paginate();
            return new PrestasiCollection($prestasi);
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
        // Attention for Bug
        if ($request->kolom) {
            return new PrestasiCollection(Prestasi::orderBy($request->kolom, 
                $request->mode)->paginate());
        } else {
           return $this->index();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\PrestasiRequest  $request
     * @param  \App\Prestasi  $prestasi
     * @return \App\Http\Resources
     */
    public function update(PrestasiRequest $request, Prestasi $prestasi)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();
        // Mass Assignment Update Data
        if ($prestasi->update($validated)) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new PrestasiResource($prestasi);
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Prestasi  $prestasi
     * @return \App\Http\Resources
     */
    public function destroy(Prestasi $prestasi)
    {
       if ($prestasi->delete()) {
           // Kembalikan Resource dalam bentuk API Resorces
           return new PrestasiResource($prestasi);
       }
    }
}
