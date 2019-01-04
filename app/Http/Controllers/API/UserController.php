<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\User as UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use App\User;

class UserController extends Controller
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
        // Tampilkan daftar user
        $user = User::latest()->paginate(10);
        // Kembalikan ke user dalam bentuk Collection Resource
        return new UserCollection($user);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->authorize('isAdmin');
        // Ambil data yang sudah divalidasi
        $validated = $request->validated();
        // Buat Objek Eloquent Model
        $user = new User;
        // Mass Assignment data request ke dalam model
        $user->fill($validated);
        // Jika ada file dalam request maka lakukan proses upload
        // dengan menggunakan fungsi uploadFile
        if ($request->has('photo')) {
            $uploadFoto = $this->uploadFile($request);
            $user->photo = $uploadFoto;
        }
        // Jika berhasil menyimpan ke DB, kembalikan Resource 
        // dalam bentuk API Resorces
        if ($user->save()) {
            return new UserResource($user);
        }
    }

    /**
     * Display the specified resource.
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
            $user = User::where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%");
            })->paginate(10);
            return new UserCollection($user);
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
            return new UserCollection(User::orderBy($request->kolom, 
                $request->mode)->paginate(10));
        } else {
            return $this->index();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        $this->authorize('isAdmin');
        // Retrieve the validated input data...
        $validated = $request->validated();

        if ($request->has('photo')) {
            $this->deleteFile($user);
        }
        // Mass Assignment data request ke dalam model
        $user->fill($validated);
        // Jika ada file dalam request maka lakukan proses upload
        // dengan menggunakan fungsi deleteFile untuk menhapus file lama 
        // terlebih dahulu kemudian menggunakan fungsi uploadFile untuk 
        // melakukan proses uploadnya
        if ($request->has('photo')) {
            $uploadFoto = $this->uploadFile($request);
            $user->photo = $uploadFoto;
        }
        // Jika berhasil menyimpan ke DB, kembalikan Resource 
        // dalam bentuk API Resorces
        if ($user->save()) {
            return new UserResource($user);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $this->authorize('isAdmin');
        // Hapus File yang berafiliasi dengan data foto
        $this->deleteFile($user);
        // Hapus User
        if ($user->delete()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new UserResource($user);
        }
    }

    /**
     * Upload file yang ada di Request
     * @param  UserRequest $request
     * @return string
     */
    private function uploadFile(UserRequest $request) {
        // Get File
        $file = $request->file('photo');
        // Get Filename with extension
        $nameWithExt = $file->getClientOriginalName();
        // Get Filename without extension
        $name = snake_case(pathinfo($nameWithExt, PATHINFO_FILENAME));
        // Get File extension
        $ext = $file->extension();
        // Jika ada foto dalam request dan merupakan valid
        // Maka lakukan proses upload
        if ($file->isValid()) {
            // Nama foto yang perlu disimpan dalam database
            // adalah kombinasi nama foto asli dan timestamp
            $fotoNameStore =  $name . '_' . time() . '.' . $ext;
            // Upload and Save foto to folder public/foto
            $path = Storage::putFileAs('public/foto/user', $file, 
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
     * @param  User $foto
     * @return boolean
     */
    private function deleteFile(User $user)
    {
        // Cek Apakah foto ada
        $exist = Storage::exists('public/foto/user/' . $user->photo);  
        if (isset($user->photo) && $exist) {
            if (Storage::delete('public/foto/user/' . $user->photo)) {
                return true;
            }
        }
        return false;
    }
}
