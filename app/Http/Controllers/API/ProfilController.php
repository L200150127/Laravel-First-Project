<?php

namespace App\Http\Controllers\API;

use App\User;
use Illuminate\Http\Request;
use App\Http\Requests\Profil as ProfilRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\User as UserResource;
use Auth;

class ProfilController extends Controller
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\ProfilRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(ProfilRequest $request)
    {
        // Retrieve the validated input data...
        $validated = $request->validated()->except('password');

        $user_login = Auth::user();

        if ($request->photo != $user_login->photo) {
            $name = time() . '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            Image::make($request->photo)->fit(250)->save(public_path('img/profil/'.$name));
            
            if (file_exists($user->photo)) {
                unlink($user->photo);
            }

            $request->merge(['photo' => 'img/profil/' . $name]);
        }

        // Mass Assignment Update Data
        if ($profil->update($validated)) {
            // Kembalikan Resource dalam bentuk API Resorces
            return new UserResource($profil);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Siswa  $siswa
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return new UserResource(auth('api')->user());
    }
}
