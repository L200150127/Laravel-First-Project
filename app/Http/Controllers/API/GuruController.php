<?php

namespace App\Http\Controllers\API;

use App\Guru;

use Illuminate\Http\Request;
use App\Http\Requests\Guru as GuruRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Guru as GuruResource;
use App\Http\Resources\GuruCollection;

class GuruController extends Controller
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
        $this->authorize('isAdmin');
        // Ambil semua data dalam DB
        $guru = Guru::orderBy('nama', 'asc')->paginate(10);
        // Kembalikan ke user dalam bentuk Collection Resource
        return new GuruCollection($guru);
    }

    /**
     * Display a listing of partial resource.
     * @return \App\Http\Resources
     */
    public function getListGuru()
    {
        $this->authorize('isAdmin');
        // Ambil semua data dalam DB
        $guru = Guru::select('id', 'nama')->get();
        // $guru = Guru::all();
        // Kembalikan ke user dalam bentuk Collection Resource
        return new GuruCollection($guru);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\GuruRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuruRequest $request)
    {
        $this->authorize('isAdmin');
        // Menggabungkan array data GuruRequest dengan data id_user
        $validated = $request->validated();

        // Buat Objek Eloquent Model
        $guru = new Guru;
        // Mass Assignment Save Data Ke Database
        if ($guru->fill($validated)->save()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new GuruResource($guru);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function show(Guru $guru)
    {
        $this->authorize('isAdmin');
        // Kembalikan Resource dalam bentuk API Resorces
        return new GuruResource($guru);
    }

    /**
     * Display the specified resource by search query.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $this->authorize('isAdmin');
        $this->validate($request, ['q' => 'nullable|string|max:50']);

        if ($search = $request->q) {
            $guru = Guru::where(function($query) use ($search) {
                $query->where('nama', 'LIKE', "%$search%");
            })->paginate(10);
            return new GuruCollection($guru);
        }
        
        return $this->index();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\GuruRequest  $request
     * @param  \App\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function update(GuruRequest $request, Guru $guru)
    {
        $this->authorize('isAdmin');
        // Retrieve the validated input data...
        $validated = $request->validated();

        // Mass Assignment Update Data
        if ($guru->update($validated)) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new GuruResource($guru);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Guru  $guru
     * @return \Illuminate\Http\Response
     */
    public function destroy(Guru $guru)
    {
        $this->authorize('isAdmin');
       if ($guru->delete()) {
           // Kembalikan Resource dalam bentuk API Resorces
           return new GuruResource($guru);
       }
    }
}
