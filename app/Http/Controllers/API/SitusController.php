<?php

namespace App\Http\Controllers\API;

use App\Situs;
use Illuminate\Http\Request;
use App\Http\Requests\Situs as SitusRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Situs as SitusResource;
use App\Http\Resources\SitusCollection;

class SitusController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Otentikasi Middleware API dengan Laravel Passport
        $this->middleware('auth:api')->except(['index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Ambil semua data dalam DB
        $situs = Situs::latest()->paginate(10);
        // Kembalikan ke user dalam bentuk Collection Resource
        return new SitusCollection($situs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\SitusRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SitusRequest $request)
    {
        $this->authorize('isAdmin');
        // Menggabungkan array data SitusRequest dengan data id_user
        $validated = $request->validated();
        // Buat Objek Eloquent Model
        $situs = new Situs;
        // Mass Assignment Save Data Ke Database
        if ($situs->fill($validated)->save()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new SitusResource($situs);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Situs  $situs
     * @return \Illuminate\Http\Response
     */
    public function show(Situs $situs)
    {
        $this->authorize('isAdmin');
        // Kembalikan Resource dalam bentuk API Resorces
        return new SitusResource($situs);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SitusRequest  $request
     * @param  \App\Situs  $situs
     * @return \Illuminate\Http\Response
     */
    public function update(SitusRequest $request, Situs $situs)
    {
        $this->authorize('isAdmin');
        // Retrieve the validated input data...
        $validated = $request->validated();
        // Mass Assignment Update Data
        if ($situs->update($validated)) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new SitusResource($situs);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Situs  $situs
     * @return \Illuminate\Http\Response
     */
    public function destroy(Situs $situs)
    {
        $this->authorize('isAdmin');
       if ($situs->delete()) {
           // Kembalikan Resource dalam bentuk API Resorces
           return new SitusResource($situs);
       }
    }
}
