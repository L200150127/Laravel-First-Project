<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Requests\User as UserRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use Image;

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
        // Menggabungkan array data DanaRequest dengan data id_user
        $validated = $request->validated();
        // Buat Objek Eloquent Model
        $user = new User;
        // Mass Assignment Save Data Ke Database
        if ($user->fill($validated)->save()) {
            // Kembalikan Resource dalam bentuk API Resorces
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
        if ($search = $request->q) {
            $users = User::where(function($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%");
            })->paginate(10);
            return new UserCollection($users);
        } else {
            $users = User::latest()->paginate(10);
            return new UserCollection($users);
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
        // Mass Assignment Update Data
        if ($user->update($validated)) {
            // Tampilkan pesan flash
            // $request->session()->flash('success', 'Berhasil mengupdate user.');
            // Redirect dengan pesan flash
            // return redirect()->with('success', 'Berhasil Membuat user.');
            // Kembalikan Resource dalam bentuk API Resorces
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
        // Hapus User
        if ($user->delete()) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new UserResource($user);
        }
    }
}
