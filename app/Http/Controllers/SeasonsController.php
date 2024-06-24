<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Series;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SeasonsController extends Controller
{
    //
    // public function index(Series $series)
    // {  
    //     $seasons = Season::query()
    //     ->with('episodes')
    //     ->where('series_id',$series)
    //     ->get();
    //     return view('seasons.index')->with('seasons', $seasons)->with('series',$series);
    // }  
    public function index(Series $series)
    {  
        $seasons = $series->temporadas()->with('episodes')->get();
        return view('seasons.index')->with('seasons', $seasons)->with('series',$series);
    }
    public function create()
    {

    }


    public function store()
    {


    }


    public function show()
    {
    }

    public function destroy()
    {

    }

    public function edit()
    {

    }
    public function update()
    {

    }
}

