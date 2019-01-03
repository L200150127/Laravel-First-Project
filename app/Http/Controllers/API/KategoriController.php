<?php

namespace App\Http\Controllers\API;

use App\Kategori;
use Illuminate\Http\Request;
use App\Http\Requests\Kategori as KategoriRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Kategori as KategoriResource;

class KategoriController extends Controller
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
        // Ambil semua data dalam DB
        $kategori = Kategori::paginate(10)->sortBy('nama');
        // Kembalikan ke user dalam bentuk Collection Resource
        return KategoriResource::collection($kategori);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\KategoriRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KategoriRequest $request)
    {
        $this->authorize('isAdmin');
        // Menggabungkan array data KategoriRequest dengan data id_user
        $validated = $request->validated();

        // Buat Objek Eloquent Model
        $kategori = new Kategori;

        // Mass Assignment Save Data Ke Database
        if ($kategori->fill($validated)->save()) {
            // Tampilkan pesan flash
            $request->session()->flash('success', 'Berhasil menambah kategori.');
            // Redirect dengan pesan flash
            // return redirect()->with('success', 'Berhasil Membuat kategori.');

            // Kembalikan Resource dalam bentuk API Resorces
            return new KategoriResource($kategori);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function show(Kategori $kategori)
    {
        $this->authorize('isAdmin');
        // Kembalikan Resource dalam bentuk API Resorces
        return new KategoriResource($kategori);
    }

    /**
     * Display the specified resource by search query.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(KategoriRequest $request)
    {
        if ($search = $request->q) {
            $kategori = Kategori::where(function($query) use ($search) {
                $query->where('nama', 'LIKE', "%$search%");
            })->paginate(10);
            return new KategoriCollection($kategori);
        } else {
            return new KategoriCollection(Kategori::latest()->paginate(10));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\KategoriRequest  $request
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function update(KategoriRequest $request, Kategori $kategori)
    {
        $this->authorize('isAdmin');
        // Retrieve the validated input data...
        $validated = $request->validated();

        // Mass Assignment Update Data
        if ($kategori->update($validated)) {
            // Tampilkan pesan flash
            $request->session()->flash('success', 'Berhasil mengupdate kategori.');
            // Redirect dengan pesan flash
            // return redirect()->with('success', 'Berhasil Membuat kategori.');

            // Kembalikan Resource dalam bentuk API Resorces
            return new KategoriResource($kategori);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kategori $kategori)
    {
        $this->authorize('isAdmin');
        if ($kategori->delete()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new KategoriResource($kategori);
        }
    }
}
