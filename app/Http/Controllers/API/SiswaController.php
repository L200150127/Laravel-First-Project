<?php

namespace App\Http\Controllers\API;

use App\Siswa;
use Illuminate\Support\Facades\Storage;
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
        return new SiswaCollection(Siswa::orderBy('tahun_masuk', 'desc')
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
        // Ambil data yang sudah divalidasi
        $validated = $request->validated();
        // Buat Objek Eloquent Model
        $siswa = new Siswa;
        // Mass Assignment data request ke dalam model
        $siswa->fill($validated);
        // Jika ada file dalam request maka lakukan proses upload
        // dengan menggunakan fungsi uploadFile
        if ($request->has('foto')) {
            $uploadFoto = $this->uploadFile($request);
            $siswa->foto = $uploadFoto;
        }
        // Jika berhasil menyimpan ke DB, kembalikan Resource 
        // dalam bentuk API Resorces
        if ($siswa->save()) {
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
        $siswa = Siswa::where('status', 1)->orderBy('tahun_lulus', 'desc')
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
        // Validasi terhadap query
        $this->validate($request, ['q' => 'nullable|string|max:50']);

        if ($search = $request->q) {
            $siswa = Siswa::where(function($query) use ($search) {
                $query->where('nis', 'LIKE', "%$search%")
                ->orWhere('nama', 'LIKE', "%$search%")
                ->orWhere('alamat', 'LIKE', "%$search%");
            })->orderBy('tahun_masuk', 'desc')->paginate(10);
            return new SiswaCollection($siswa);
        } else {
            return $this->index();
        }
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
            $siswa = Siswa::where('status', 1)->where(function($query) use ($search) {
                $query->where('nama', 'LIKE', "%$search%")
                ->orWhere('nis', 'LIKE', "%$search%")
                ->orWhere('alamat', 'LIKE', "%$search%");
            })->orderBy('tahun_lulus', 'desc')->paginate(10);
            return new SiswaCollection($siswa);
        } else {
            return $this->alumni();
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
            return new SiswaCollection(Siswa::orderBy($request->kolom, 
                $request->mode)->paginate(10));
        } else {
            return $this->index();
        }
    }

    /**
     * Display a listing of sorted resource.
     * @param  Illuminate\Http\Request $request
     * @return \App\Http\Resources
     */
    public function orderByAlumni(Request $request)
    {
        // Validasi terhadap query
        $this->validate($request, [
            'kolom' => 'required|string|max:50',
            'mode' => 'required|string|in:asc,desc'
        ]);
        // Melakukan Pengurutan berdasarkan Kolom dan Mode
        if ($request->kolom) {
            return new SiswaCollection(Siswa::where('status', 1)
                ->orderBy($request->kolom, $request->mode)->paginate(10));
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
        // Mass Assignment data request ke dalam model
        $siswa->fill($validated);
        // Jika ada file dalam request maka lakukan proses upload
        // dengan menggunakan fungsi deleteFile untuk menhapus file lama 
        // terlebih dahulu kemudian menggunakan fungsi uploadFile untuk 
        // melakukan proses uploadnya
        if ($request->has('foto')) {
            $this->deleteFile($siswa);
            $uploadFoto = $this->uploadFile($request);
            $siswa->foto = $uploadFoto;
        }
        // Jika berhasil menyimpan ke DB, kembalikan Resource 
        // dalam bentuk API Resorces
        if ($siswa->save()) {
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
        // Hapus File yang berafiliasi dengan data foto
        $this->deleteFile($siswa);
        // Hapus data foto dari DB
        if ($siswa->delete()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new SiswaResource($siswa);
        }
    }

    /**
     * Upload file yang ada di Request
     * @param  SiswaRequest $request
     * @return string
     */
    private function uploadFile(SiswaRequest $request) {
        // Get File
        $siswa = $request->file('foto');
        // Get Filename with extension
        $nameWithExt = $siswa->getClientOriginalName();
        // Get Filename without extension
        $name = snake_case(pathinfo($nameWithExt, PATHINFO_FILENAME));
        // Get File extension
        $ext = $siswa->extension();
        // Jika ada foto dalam request dan merupakan valid
        // Maka lakukan proses upload
        if ($siswa->isValid()) {
            // Ambil ukuran file
            $size = $siswa->getClientSize();
            // Nama foto yang perlu disimpan dalam database
            // adalah kombinasi nama foto asli dan timestamp
            $fotoNameStore =  $name . '_' . time() . '.' . $ext;
            // Upload and Save foto to folder public/foto
            $path = Storage::putFileAs('public/foto/siswa', $siswa, 
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
     * @param  Siswa $foto
     * @return boolean
     */
    private function deleteFile(Siswa $siswa)
    {
        // Cek Apakah foto ada
        $exist = Storage::exists('public/foto/siswa/' . $siswa->foto);  
        if (isset($siswa->foto) && $exist) {
            if (Storage::delete('public/foto/siswa/' . $siswa->foto)) {
                return true;
            }
        }
        return false;
    }
}
