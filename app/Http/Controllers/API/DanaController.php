<?php

namespace App\Http\Controllers\API;

use App\Dana;
use Illuminate\Http\Request;
use App\Http\Requests\Dana as DanaRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Dana as DanaResource;
use App\Http\Resources\DanaCollection;

class DanaController extends Controller
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
        $this->authorize('isAdmin');
        // Ambil semua data dalam DB
        // Kembalikan ke user dalam bentuk Collection Resource
        return new DanaCollection(Dana::latest()->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\DanaRequest  $request
     * @return \App\Http\Resources
     */
    public function store(DanaRequest $request)
    {
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        // Ambil data yang sudah divalidasi
        $validated = $request->validated();
        // Buat Objek Eloquent Model
        $dana = new Dana;
        // Mass Assignment Save Data Ke Database
        if ($dana->fill($validated)->save()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new DanaResource($dana);
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
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        // Validasi terhadap query
        $this->validate($request, ['q' => 'nullable|string|max:50']);
        
        // Melakukan Pencarian berdasarkan query q
        if ($search = $request->q) {
            $dana = Dana::where(function($query) use ($search) {
                $query->where('nama', 'LIKE', "%$search%")
                ->orWhere('jenis', 'LIKE', "%$search%")
                ->orWhere('sumber', 'LIKE', "%$search%");
            })->paginate();
            return new DanaCollection($dana);
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
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        // Validasi terhadap query
        $this->validate($request, [
            'kolom' => 'required|string|max:50',
            'mode' => 'required|string|in:asc,desc'
        ]);
        // Melakukan Pengurutan berdasarkan Kolom dan Mode
        // Attention for Bug
        if ($request->kolom) {
            if ($request->kolom == 'tanggal') {
                if ($request->mode == 'asc') {
                    return new DanaCollection(Dana::latest('tanggal')
                        ->paginate());
                } else {
                    return new DanaCollection(Dana::oldest('tanggal')
                        ->paginate());
                }
            }
            return new DanaCollection(Dana::orderBy($request->kolom, 
                $request->mode)->paginate());
        } else {
           return $this->index();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\DanaRequest  $request
     * @param  \App\Dana  $dana
     * @return \App\Http\Resources
     */
    public function update(DanaRequest $request, Dana $dana)
    {
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        // Retrieve the validated input data...
        $validated = $request->validated();
        // Mass Assignment Update Data
        if ($dana->update($validated)) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new DanaResource($dana);
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dana  $dana
     * @return \App\Http\Resources
     */
    public function destroy(Dana $dana)
    {
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        if ($dana->delete()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new DanaResource($dana);
        }
    }
}
