<?php

namespace App\Http\Controllers;

use App\Artikel;
use App\Kategori;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $artikel = Artikel::orderBy('id_artikel', 'desc')->paginate(4);
        return view('blog.index')->withArtikel($artikel);
    }

    /**
     * Display a resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function single($slug)
    {
        // ambil data dari database berdasarkan slug
        $artikel = Artikel::where('slug', '=', $slug)->first();
        // // return view dan lewatkan variabelnya
        return view('blog.single')->withArtikel($artikel);
    }

    /**
     * Search resource for given query
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search($q)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Artikel  $artikel
     * @return \Illuminate\Http\Response
     */
    public function showByKategori(Kategori $kategori)
    {
        $artikel = Artikel::where('slug', '=', $slug)->first();
    }
}
