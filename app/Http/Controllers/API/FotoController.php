<?php

namespace App\Http\Controllers\API;

use App\Foto;
use Illuminate\Support\Facades\Storage;
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
        // Ambil data yang sudah divalidasi
        $validated = $request->validated();
        // Buat Objek Eloquent Model
        $foto = new Foto;
        // Mass Assignment data request ke dalam model
        $foto->fill($validated);
        // Jika ada file dalam request maka lakukan proses upload
        // dengan menggunakan fungsi uploadFile
        if ($request->has('foto')) {
            $uploadFoto = $this->uploadFile($request);
            $foto->path = $uploadFoto[0];
            $foto->ukuran = $uploadFoto[1];
        }
        // Jika berhasil menyimpan ke DB, kembalikan Resource 
        // dalam bentuk API Resorces
        if ($foto->save()) {
            return new FotoResource($foto);
        }
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
            $foto = Foto::where(function($query) 
                use ($search) {
                $query->where('nama', 'LIKE', "%$search%")
                ->orWhere('deskripsi', 'LIKE', "%$search%");
            })->paginate(10);
            return new FotoCollection($foto);
        } else {
            return $this->index();
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
        // Mass Assignment data request ke dalam model
        $foto->fill($validated);
        // Jika ada file dalam request maka lakukan proses upload
        // dengan menggunakan fungsi deleteFile untuk menhapus file lama 
        // terlebih dahulu kemudian menggunakan fungsi uploadFile untuk 
        // melakukan proses uploadnya
        if ($request->has('foto')) {
            $this->deleteFile($foto);
            $uploadFoto = $this->uploadFile($request);
            $foto->path = $uploadFoto[0];
            $foto->ukuran = $uploadFoto[1];
        }
        // Jika berhasil menyimpan ke DB, kembalikan Resource 
        // dalam bentuk API Resorces
        if ($foto->save()) {
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
        // Hapus File yang berafiliasi dengan data foto
        $this->deleteFile($foto);
        // Hapus data foto dari DB
        if ($foto->delete()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new FotoResource($foto);
        }
    }

    /**
     * Upload file yang ada di Request
     * @param  FotoRequest $request
     * @return string
     */
    private function uploadFile(FotoRequest $request) {
        // Get File
        $foto = $request->file('foto');
        // Get Filename with extension
        $nameWithExt = $foto->getClientOriginalName();
        // Get Filename without extension
        $name = snake_case(pathinfo($nameWithExt, PATHINFO_FILENAME));
        // Get File extension
        $ext = $foto->extension();
        // Jika ada foto dalam request dan merupakan valid
        // Maka lakukan proses upload
        if ($foto->isValid()) {
            // Ambil ukuran file
            $size = $foto->getClientSize();
            // Nama foto yang perlu disimpan dalam database
            // adalah kombinasi nama foto asli dan timestamp
            $fotoNameStore =  $name . '_' . time() . '.' . $ext;
            // Upload and Save foto to folder public/foto
            $path = Storage::putFileAs('public/foto', $foto, $fotoNameStore);
            // kembalikan nama foto beserta ekstensinya
            return [ $fotoNameStore, $size ];
        }
        // kembalikan false jika tidak ada foto dalam request atau jika proses 
        // upload gagal
        return false;
    }

    /**
     * Hapus foto yang berafiliasi dengan data DB
     * @param  Foto $foto
     * @return boolean
     */
    private function deleteFile(Foto $foto)
    {
        // Cek Apakah foto ada
        $exist = Storage::exists('public/foto/' . $foto->path);
        if (isset($foto->path) && $exist) {
            if (Storage::delete('public/foto/' . $foto->path)) {
                return true;
            }
        }
        return false;
    }
}
