<?php

namespace App\Http\Controllers\API;

use App\Guru;
use Illuminate\Support\Facades\Storage;
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
        // Kembalikan ke user dalam bentuk Collection Resource
        return new GuruCollection(Guru::paginate(10));
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
        // Ambil data yang sudah divalidasi
        $validated = $request->validated();
        // Buat Objek Eloquent Model
        $guru = new Guru;
        // Mass Assignment data request ke dalam model
        $guru->fill($validated);
        // Jika ada file dalam request maka lakukan proses upload
        // dengan menggunakan fungsi uploadFile
        if ($request->has('foto')) {
            $uploadFoto = $this->uploadFile($request);
            $guru->foto = $uploadFoto;
        }
        // Jika berhasil menyimpan ke DB, kembalikan Resource 
        // dalam bentuk API Resorces
        if ($guru->save()) {
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
        // Validasi terhadap query
        $this->validate($request, ['q' => 'nullable|string|max:50']);

        if ($search = $request->q) {
            $guru = Guru::where(function($query) use ($search) {
                $query->where('nip', 'LIKE', "%$search%")
                ->orWhere('nama', 'LIKE', "%$search%")
                ->orWhere('alamat', 'LIKE', "%$search%")
                ->orWhere('jabatan', 'LIKE', "%$search%");
            })->paginate(10);
            return new GuruCollection($guru);
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
        if ($request->kolom) {
            return new GuruCollection(Guru::orderBy($request->kolom, 
                $request->mode)->paginate(10));
        } else {
            return $this->index();
        }
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

        if ($request->has('foto')) {
            $this->deleteFile($guru);
        }
        // Mass Assignment data request ke dalam model
        $guru->fill($validated);
        // Jika ada file dalam request maka lakukan proses upload
        // dengan menggunakan fungsi deleteFile untuk menhapus file lama 
        // terlebih dahulu kemudian menggunakan fungsi uploadFile untuk 
        // melakukan proses uploadnya
        if ($request->has('foto')) {
            $uploadFoto = $this->uploadFile($request);
            $guru->foto = $uploadFoto;
        }
        // Jika berhasil menyimpan ke DB, kembalikan Resource 
        // dalam bentuk API Resorces
        if ($guru->save()) {
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
        // Hapus File yang berafiliasi dengan data foto
        $this->deleteFile($guru);
        // Hapus data foto dari DB
        if ($guru->delete()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new GuruResource($guru);
        }
    }

    /**
     * Upload file yang ada di Request
     * @param  GuruRequest $request
     * @return string
     */
    private function uploadFile(GuruRequest $request) {
        // Get File
        $guru = $request->file('foto');
        // Get Filename with extension
        $nameWithExt = $guru->getClientOriginalName();
        // Get Filename without extension
        $name = snake_case(pathinfo($nameWithExt, PATHINFO_FILENAME));
        // Get File extension
        $ext = $guru->extension();
        // Jika ada foto dalam request dan merupakan valid
        // Maka lakukan proses upload
        if ($guru->isValid()) {
            // Nama foto yang perlu disimpan dalam database
            // adalah kombinasi nama foto asli dan timestamp
            $fotoNameStore =  $name . '_' . time() . '.' . $ext;
            // Upload and Save foto to folder public/foto
            $path = Storage::putFileAs('public/foto/guru', $guru, 
                $fotoNameStore);
            // kembalikan nama foto beserta ekstensinya
            return $fotoNameStore;
        }
        // kembalikan false jika tidak ada foto dalam request atau jika proses 
        // upload gagal
        return false;
    }

    /**
     * Hapus foto yang berafiliasi dengan data DB
     * @param  Guru $foto
     * @return boolean
     */
    private function deleteFile(Guru $guru)
    {
        // Cek Apakah foto ada
        $exist = Storage::exists('public/foto/guru/' . $guru->foto);  
        if (isset($guru->foto) && $exist) {
            if (Storage::delete('public/foto/guru/' . $guru->foto)) {
                return true;
            }
        }
        return false;
    }

}
