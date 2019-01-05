<?php

namespace App\Http\Controllers;

use App\Artikel;
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
        $artikel = Artikel::latest()->paginate(6);
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
        $artikelTerbaru = Artikel::latest()->take(3)->get();
        // // return view dan lewatkan variabelnya
        return view('blog.single')
        ->withArtikel($artikel)
        ->withArtikelTerbaru($artikelTerbaru);
    }

    /**
     * Search resource for given query
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search($q)
    {
        $artikel = Artikel::where('judul', 'LIKE', "%$q%")->paginate();
        return view('blog.index')->withArtikel($artikel);
    }
}
