<?php

namespace App\Http\Controllers\API;

use App\Agenda;
use Illuminate\Http\Request;
use App\Http\Requests\Agenda as AgendaRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Agenda as AgendaResource;
use App\Http\Resources\AgendaCollection;

class AgendaController extends Controller
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
        $agenda = Agenda::latest()->paginate(4);
        // Kembalikan ke user dalam bentuk Collection Resource
        return new AgendaCollection($agenda);
    }

    /**
     * Display all listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        // Ambil semua data dalam DB
        $agenda = Agenda::all();
        // Kembalikan ke user dalam bentuk Collection Resource
        return new AgendaCollection($agenda);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\AgendaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgendaRequest $request)
    {
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        // Ambil data yang sudah divalidasi
        $validated = $request->validated();
        // Buat Objek Eloquent Model
        $agenda = new Agenda;
        // Mass Assignment Save Data Ke Database
        if($agenda->fill($validated)->save()){
            // Kembalikan Resource dalam bentuk API Resorces
            return new AgendaResource($agenda);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\AgendaRequest  $request
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(AgendaRequest $request, Agenda $agenda)
    {
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        // Retrieve the validated input data...
        $validated = $request->validated();
        // Mass Assignment Update Data
        if($agenda->update($validated)){
            // Kembalikan Resource dalam bentuk API Resorces
            return new AgendaResource($agenda);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Agenda  $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Agenda $agenda)
    {
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        if ($agenda->delete()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new AgendaResource($agenda);
        }
    }
}
