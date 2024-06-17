<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Serie;

class SeriesController extends Controller
{
    //
    public function index(Request $request)
    {

        // $series = DB::select('Select nome from series;');
        $series = Serie::all();


        // return view('listar-series',['series'=>$series]);
        return view('series.index',compact('series'));
    }

    public function create(Request $request)
    {
        return view('series.create');
    }
    public function store(Request $request)
    {
        $nomeSerie = $request->input('nome');
        $serie = new Serie();
        $serie->nome = $nomeSerie;
        $serie->save();
        return redirect('/series');
        // if (DB::insert('INSERT INTO series (nome) VALUES (?)',[$nomeSerie]))
        // {return "OK";}
        // else{
        //     "deu erro";
        // }
    }
    public function show(){}
    public function destroy(){}
}
