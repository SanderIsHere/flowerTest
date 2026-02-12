<?php

namespace App\Http\Controllers;

use App\Services\OmdbServices;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    //buat properti utk nyimpen instance dr omdbServices
    protected $omdbServices;

    public function __construct(OmdbServices $omdbServices)  //buat manggil services OmdbServices
    {
        //ini buat nyimpen services td ke property omdbServices biar accesible di controller
        $this->omdbServices = $omdbServices;
    }


    public function showAll(Request $request)
    {
        //buat ambil key search nya, 'cars' adalah default jika kosong
        $keysearch = $request->input('search', 'marvel');

        // utk narik metode searchAll dr services dimn keyword dikirim n terima hasil search 
        $movies = $this->omdbServices->searchAll($keysearch);

        // utk ngirim ke view
        return view('movies.showAll', [
            'movies' => $movies,
            'keysearch' => $keysearch
        ]);
    }


    public function showOneMovie($omdbID)
    {
        // buat kirim data by id dan nampilin based on id nya   
        $movie = $this->omdbServices->movieDetail($omdbID);

        // utk view nya
        return view('movies.showOneMovie', [
            'movie' => $movie
        ]);
    }
}
