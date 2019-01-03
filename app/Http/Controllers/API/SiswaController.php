<?php

namespace App\Http\Controllers\API;

use App\Siswa;

use Illuminate\Http\Request;
use App\Http\Requests\Siswa as SiswaRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Siswa as SiswaResource;
use App\Http\Resources\SiswaCollection;

class SiswaController extends Controller
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
     * @return \App\Http\Resources\SiswaResource
     */
    public function index()
    {
        $this->authorize('isAdmin');
        // Ambil semua data dalam DB
        // Kembalikan ke user dalam bentuk Collection Resource
        return new SiswaCollection(Siswa::orderBy('nama', 'asc')
            ->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Http\Resources\SiswaResource
     */
    public function store(SiswaRequest $request)
    {
        $this->authorize('isAdmin');
        // Menggabungkan array data SiswaRequest dengan data id_user
        $validated = $request->validated();
        // Buat Objek Eloquent Model
        $siswa = new Siswa;
        // Mass Assignment Save Data Ke Database
        if ($siswa->fill($validated)->save()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new SiswaResource($siswa);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \App\Http\Resources\SiswaResource
     */
    public function show(Siswa $siswa)
    {
        $this->authorize('isAdmin');
        // Kembalikan Resource dalam bentuk API Resorces
        return new SiswaResource($siswa);
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \App\Http\Resources\SiswaResource
     */
    public function alumni()
    {
        // Ambil semua data dalam DB
        $siswa = Siswa::where('status', 1)->orderBy('nama', 'asc')
        ->paginate(10);
        // Kembalikan ke user dalam bentuk Collection Resource
        return new SiswaCollection($siswa);
    }

    /**
     * Display the specified resource by search query.
     *
     * @param  int  $id
     * @return \App\Http\Resources\SiswaResource
     */
    public function search(Request $request)
    {
        $this->authorize('isAdmin');
        $this->validate($request, ['q' => 'nullable|string|max:50']);

        if ($search = $request->q) {
            $siswa = Siswa::where(function($query) use ($search) {
                $query->where('nama', 'LIKE', "%$search%");
            })->paginate(10);
            return new SiswaCollection($siswa);
        }

        return $this->index();
    }

    /**
     * Display the specified resource by search query.
     *
     * @param  int  $id
     * @return \App\Http\Resources\SiswaResource
     */
    public function searchAlumni(Request $request)
    {
        $this->validate($request, ['q' => 'nullable|string|max:50']);

        if ($search = $request->q) {
            $siswa = Siswa::where('status', 1)
            ->where(function($query) use ($search) {
                $query->where('nama', 'LIKE', "%$search%");
            })
            ->orderBy('nama', 'asc')->paginate(10);
            return new SiswaCollection($siswa);
        } else {
            return $this->alumni();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\SiswaRequest  $request
     * @param  \App\Siswa  $siswa
     * @return \App\Http\Resources\SiswaResource
     */
    public function update(SiswaRequest $request, Siswa $siswa)
    {
        $this->authorize('isAdmin');
        // Retrieve the validated input data...
        $validated = $request->validated();

        // Mass Assignment Update Data
        if ($siswa->update($validated)) {
            return new SiswaResource($siswa);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Siswa  $siswa
     * @return \App\Http\Resources\SiswaResource
     */
    public function destroy(Siswa $siswa)
    {
        $this->authorize('isAdmin');
        if ($siswa->delete()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new SiswaResource($siswa);
        }
    }
}
