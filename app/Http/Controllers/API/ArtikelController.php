<?php

namespace App\Http\Controllers\API;

use App\Artikel;
use App\Kategori;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\Artikel as ArtikelRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Artikel as ArtikelResource;
use App\Http\Resources\ArtikelCollection;
use Gate;
use Auth;

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
        // $this->authorizeResource(Artikel::class, 'artikel');
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
            $artikel = Artikel::with(['user'])->paginate(10);
        } else {
            $artikel = Artikel::where('id_user', Auth::id())
            ->with(['user'])->paginate(10);
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
            Auth::id());

        // Buat Objek Eloquent Model
        $artikel = new Artikel;
        // Mass Assignment data request ke dalam model
        $artikel->fill($validated);
        $artikel->slug = str_slug($validated['judul']);
        // Jika ada file dalam request maka lakukan proses upload
        // dengan menggunakan fungsi uploadFile
        if ($request->has('gambar_cover')) {
            $uploadFoto = $this->uploadFile($request);
            $artikel->gambar_cover = $uploadFoto;
        }
        // Jika berhasil menyimpan ke DB, kembalikan Resource 
        // dalam bentuk API Resorces
        if ($artikel->save()) {
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
        // Validasi terhadap query
        $this->validate($request, ['q' => 'nullable|string|max:50']);

        if ($search = $request->q) {
            $artikel = Artikel::where(function($query) 
                use ($search) {
                $query->Where('judul', 'LIKE', "%$search%");
            })->paginate(10);
            return new ArtikelCollection($artikel);
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
            return new ArtikelCollection(Artikel::orderBy($request->kolom, 
                $request->mode)->paginate(10));
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
    public function update(Artikel $artikel, ArtikelRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();
        // Mass Assignment data request ke dalam model
        if ($request->has('gambar_cover')) {
            $this->deleteFile($artikel);
        }
        $artikel->fill($validated);
        $artikel->slug = str_slug($validated['judul']);
        // Jika ada file dalam request maka lakukan proses upload
        // dengan menggunakan fungsi deleteFile untuk menhapus file lama 
        // terlebih dahulu kemudian menggunakan fungsi uploadFile untuk 
        // melakukan proses uploadnya
        if ($request->has('gambar_cover')) {
            $uploadFoto = $this->uploadFile($request);
            $artikel->gambar_cover = $uploadFoto;
        }
        // Jika berhasil menyimpan ke DB, kembalikan Resource 
        // dalam bentuk API Resorces
        if ($artikel->save()) {
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
        // Hapus File yang berafiliasi dengan data foto
        $this->deleteFile($artikel);
        // Hapus data foto dari DB
        if ($artikel->delete()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new ArtikelResource($artikel);
        }
    }

    /**
     * Upload file yang ada di Request
     * @param  ArtikelRequest $request
     * @return string
     */
    private function uploadFile(ArtikelRequest $request) {
        // Get File
        $file = $request->file('gambar_cover');
        // Get Filename with extension
        $nameWithExt = $file->getClientOriginalName();
        // Get Filename without extension
        $name = snake_case(pathinfo($nameWithExt, PATHINFO_FILENAME));
        // Get File extension
        $ext = $file->getClientOriginalExtension();
        // Jika ada foto dalam request dan merupakan valid
        // Maka lakukan proses upload
        if ($file->isValid()) {
            // Nama foto yang perlu disimpan dalam database
            // adalah kombinasi nama foto asli dan timestamp
            $fotoNameStore =  $name . '_' . time() . '.' . $ext;
            // Upload and Save foto to folder public/foto
            $path = Storage::putFileAs('public/foto/artikel', $file, 
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
     * @param  Artikel $foto
     * @return boolean
     */
    private function deleteFile(Artikel $artikel)
    {
        // Cek Apakah foto ada
        $exist = Storage::exists('public/foto/artikel/' . 
            $artikel->gambar_cover);
        if (isset($artikel->gambar_cover) && $exist) {
            if (Storage::delete('public/foto/artikel/' . 
                $artikel->gambar_cover)) {
                return true;
            }
        }
        return false;
    }
}
