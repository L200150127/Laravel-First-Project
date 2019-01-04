<?php

namespace App\Http\Controllers\API;

use App\Materi;
use App\Mapel;
use App\Kelas;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Http\Requests\Materi as MateriRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Materi as MateriResource;
use App\Http\Resources\MateriCollection;

class MateriController extends Controller
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
        $materi = Materi::latest()->paginate();
        // Kembalikan ke user dalam bentuk Collection Resource
        return new MateriCollection($materi);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\JadwalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MateriRequest $request)
    {
        // Ambil data yang sudah divalidasi
        $validated = $request->validated();
        // Buat Objek Eloquent Model
        $materi = new Materi;
        // Mass Assignment data request ke dalam model
        $materi->fill($validated);
        // Jika ada file dalam request maka lakukan proses upload
        // dengan menggunakan fungsi uploadFile
        if ($request->has('file')) {
            $materi->path = $this->uploadFile($request);
        }
        // Jika berhasil menyimpan ke DB, kembalikan Resource 
        // dalam bentuk API Resorces
        if ($materi->save()) {
            return new MateriResource($materi);
        }
    }

    /**
     * Display the specified resource by search query.
     *
     * @param  Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        // Validasi terhadap query
        $this->validate($request, ['q' => 'nullable|string|max:50']);

        if ($search = $request->q) {
            $mapelArr = Mapel::where('nama', 'LIKE', "%$search%")->pluck('id')->toArray();
            $kelasArr = Kelas::where('nama', 'LIKE', "%$search%")->pluck('id')->toArray();
            $materi = Materi::where(function($query) 
                use ($search, $mapelArr, $kelasArr) {
                $query->whereIn('id_kelas', $kelasArr)
                ->orWhereIn('id_mapel', $mapelArr)
                ->orWhere('nama', 'LIKE', "%$search%");
            })->paginate();
            return new MateriCollection($materi);
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
            return new MateriCollection(Materi::orderBy($request->kolom, 
                $request->mode)->paginate());
        } else {
            return $this->index();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\MateriRequest  $request
     * @param  \App\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function update(MateriRequest $request, Materi $materi)
    {
        // Retrieve the validated input data...
        $validated = $request->validated();
        if ($validated['id_kelas'] == 'null') {
            $validated['id_kelas'] = null;
        }
        if ($validated['id_mapel'] == 'null') {
            $validated['id_mapel'] = null;
        }
        // Mass Assignment data request ke dalam model
        $materi->fill($validated);
        // Jika ada file dalam request maka lakukan proses upload
        // dengan menggunakan fungsi deleteFile untuk menhapus file lama 
        // terlebih dahulu kemudian menggunakan fungsi uploadFile untuk 
        // melakukan proses uploadnya
        if ($request->has('file')) {
            $this->deleteFile($materi);
            $materi->path = $this->uploadFile($request);
        }
        // Jika berhasil menyimpan ke DB, kembalikan Resource 
        // dalam bentuk API Resorces
        if ($materi->save()) {
            return new MateriResource($materi);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Materi  $materi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Materi $materi)
    {
        // Hapus File yang berafiliasi dengan data materi
        $this->deleteFile($materi);
        // Hapus data materi dari DB
        if ($materi->delete()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new MateriResource($materi);
        }
    }

    /**
     * Upload file yang ada di Request
     * @param  MateriRequest $request
     * @return string
     */
    private function uploadFile(MateriRequest $request) {
        // Get File
        $file = $request->file('file');
        // Get Filename with extension
        $nameWithExt = $file->getClientOriginalName();
        // Get Filename without extension
        $name = snake_case(pathinfo($nameWithExt, PATHINFO_FILENAME));
        // Get File extension
        $ext = $file->extension();
        // Jika ada file dalam request dan merupakan valid
        // Maka lakukan proses upload
        if ($file->isValid()) {
            // Nama file yang perlu disimpan dalam database
            // adalah kombinasi nama file asli dan timestamp
            $fileNameStore =  $name . '_' . time() . '.' . $ext;
            // Upload and Save file to folder public/materi
            $path = Storage::putFileAs('public/materi', $file, $fileNameStore);
            // $file->storeAs('public/materi', $fileNameStore);
            // kembalikan nama file beserta ekstensinya
            return $fileNameStore;
        }
        // kembalikan false jika tidak ada file dalam request atau jika proses 
        // upload gagal
        return false;
    }

    /**
     * Hapus file yang berafiliasi dengan data DB
     * @param  Materi $materi
     * @return boolean
     */
    private function deleteFile(Materi $materi)
    {
        // Cek Apakah file ada
        $exist = Storage::exists('public/materi/' . $materi->path);
        if (isset($materi->path) && $exist) {
            if (Storage::delete('public/materi/' . $materi->path)) {
                return true;
            }
        }
        return false;
    }


}
