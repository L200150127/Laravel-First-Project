<?php

namespace App\Http\Controllers\API;

use App\Mapel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Mapel as MapelResource;
use App\Http\Resources\MapelCollection;

class MapelController extends Controller
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
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        // Ambil semua data dalam DB
        // Kembalikan ke user dalam bentuk Collection Resource
        return new MapelCollection(Mapel::with('guru')->paginate());
    }

    /**
     * Display a listing of partial resource.
     * @return \App\Http\Resources
     */
    public function getListMapel()
    {
        // $this->authorize('isAdmin');
        // Ambil semua data dalam DB
        $mapel = Mapel::select('id', 'nama')->get();
        // Kembalikan ke user dalam bentuk Collection Resource
        return new MapelCollection($mapel);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request  $request
     * @return \App\Http\Resources
     */
    public function store(Request $request)
    {
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        // Validasi data server
        $validatedData = $request->validate([
            'nama'    => 'required|string|max:50',
            'id_guru' => 'sometimes|array',
        ]);

        // Buat Objek Eloquent Model
        $mapel = new Mapel;

        // Mass Assignment Save Data Ke Database
        if ($mapel->fill($validatedData)->save()) {
            // Mensinkronkan relasi antara mapel dengan guru
            $mapel->guru()->sync($validatedData['id_guru'], false);
            // Kembalikan Resource dalam bentuk API Resources
            return new MapelResource($mapel);
        }
    }
    
    /**
     * Display the specified resource by search query.
     *
     * @param  int  $id
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
            $mapel = Mapel::where(function($query) use ($search) {
                $query->where('nama', 'LIKE', "%$search%");
            })->paginate();
            return new MapelCollection($mapel);
        } else {
           return $this->index();
        }
    }

    /**
     * Display a listing of sorted resource.
     * @param  \App\Http\Request  $request
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
            return new MapelCollection(Mapel::with('guru')
                ->orderBy($request->kolom, $request->mode)->paginate());
        } else {
           return $this->index();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\MapelRequest  $request
     * @param  \App\Mapel  $mapel
     * @return \App\Http\Resources
     */
    public function update(Request $request, Mapel $mapel)
    {
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        // Retrieve the validated input data...
        $validatedData = $request->validate([
            'nama'    => 'required|string|max:50',
            'id_guru' => 'sometimes|array',
        ]);

        // Mass Assignment Update Data
        if ($mapel->update($validatedData)) {

            // Mensinkronkan relasi antara mapel dengan guru
            if ($request->filled('id_guru')) {
                $mapel->guru()->sync($validatedData['id_guru']);
            } else {
                $mapel->guru()->sync([]);
            }
            
            // Kembalikan Resource dalam bentuk API Resorces
            return new MapelResource($mapel);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mapel  $mapel
     * @return \App\Http\Resources
     */
    public function destroy(Mapel $mapel)
    {
        // Otorisasi Hak Akses Admin
        $this->authorize('isAdmin');
        // Hapus relasi guru dengan mapel terlebih dahulu sebelum dihapus
        $mapel->guru()->detach();
        
        // Hapus Mapel dari DB
        if ($mapel->delete()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new MapelResource($mapel);
        }
    }
}
