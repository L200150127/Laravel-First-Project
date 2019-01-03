<?php

namespace App\Http\Controllers\API;

use App\Artikel;

use Illuminate\Http\Request;
use App\Http\Requests\Artikel as ArtikelRequest;

use App\Http\Controllers\Controller;

use App\Http\Resources\Artikel as ArtikelResource;
use App\Http\Resources\ArtikelCollection;

class ArtikelController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Otentikasi Middleware API dengan Laravel Passport
        if(!$this->middleware('auth:api')) {
            return abort(404);
        }
        // Otorisasi Hak Akses untuk artikel pada masing masing user
        $this->authorizeResource(Artikel::class, 'artikel');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Gate::allows('isAdmin')) {
            // Ambil semua data dalam DB
            $artikel = Artikel::with(['kategori', 'user'])->paginate(10);
        } else {
            $artikel = Artikel::where('id_user', Auth::id())
            ->with(['kategori', 'user'])->paginate(10);
        }
        // Kembalikan ke user dalam bentuk Collection Resource
        return new ArtikelCollection($artikel);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ArtikelRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArtikelRequest $request)
    {
        // Ambil data user yang sedang login sekarang
        // $user = auth('api')->user();
        // $user = auth()->user();
        // Ambil data user yang sedang melakukan request sekarang
        // $user = $request->user();

        // Menggabungkan array data ArtikelRequest dengan data id_user
        $validated = array_add($request->validated(), 'id_user', 
            auth('api')->user()->id_user);

        // Buat Objek Eloquent Model
        $artikel = new Artikel;

        // Mass Assignment Save Data Ke Database
        if ($artikel->fill($validated)->save()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new ArtikelResource($artikel);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function show(Artikel $artikel)
    {
        // Kembalikan Resource dalam bentuk API Resorces
        return new ArtikelResource($artikel);
    }

    /**
     * Display the specified resource by search query.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if ($search = $request->q) {
            $artikel = Artikel::where(function($query) use ($search) {
                $query->where('judul', 'LIKE', "%$search%")
                ->orWhere('slug', 'LIKE', "%$search%")
                ->orWhere('isi', 'LIKE', "%$search%");
            })->paginate(10);
            return new ArtikelCollection($artikel);
        } else {
            return $this->index();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ArtikelRequest  $request
     * @param  \App\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function update(ArtikelRequest $request, Artikel $artikel)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        // Mass Assignment Update Data
        if ($artikel->update($validated)) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new ArtikelResource($artikel);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Artikel $artikel)
    {
        if ($artikel->delete()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new ArtikelResource($artikel);
        }
    }
}
