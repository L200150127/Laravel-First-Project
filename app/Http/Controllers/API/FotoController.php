<?php

namespace App\Http\Controllers\API;

use App\Foto;
use Illuminate\Http\Request;
use App\Http\Requests\Foto as FotoRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Foto as FotoResource;
use App\Http\Resources\FotoCollection;

class FotoController extends Controller
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
        $foto = Foto::latest()->paginate(10);
        // Kembalikan ke user dalam bentuk Collection Resource
        return new FotoCollection($foto);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\FotoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FotoRequest $request)
    {
        // Menggabungkan array data FotoRequest dengan data id_user
        $validated = $request->validated();

        // Buat Objek Eloquent Model
        $foto = new Foto;

        // Mass Assignment Save Data Ke Database
        if ($foto->fill($validated)->save()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new FotoResource($foto);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function show(Foto $foto)
    {
        // Kembalikan Resource dalam bentuk API Resorces
        return new FotoResource($foto);
    }

    /**
     * Display the specified resource by search query.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(FotoRequest $request)
    {
        if ($search = $request->q) {
            $foto = Foto::where(function($query) use ($search) {
                $query->where('nama', 'LIKE', "%$search%")
                ->orWhere('deskripsi', 'LIKE', "%$search%");
            })->paginate(10);
            return new FotoCollection($foto);
        } else {
            return new FotoCollection(Foto::latest()->paginate(10));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\FotoRequest  $request
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function update(FotoRequest $request, Foto $foto)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();

        // Mass Assignment Update Data
        if ($foto->update($validated)) {
            // Tampilkan pesan flash
            $request->session()->flash('success', 'Berhasil mengupdate foto.');
            // Redirect dengan pesan flash
            // return redirect()->with('success', 'Berhasil Membuat foto.');

            // Kembalikan Resource dalam bentuk API Resorces
            return new FotoResource($foto);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Foto  $foto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Foto $foto)
    {
        if ($foto->delete()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new FotoResource($foto);
        }
    }
}
