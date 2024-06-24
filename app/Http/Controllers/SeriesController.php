<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;


class SeriesController extends Controller
{
    //
    public function index(Request $request)
    {
        $series = Series::with(['temporadas'])->get();
        $mensagemSucesso = $request->session()->get('mensagem.sucesso');
        return view('series.index', compact('series'))->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create(Request $request)
    {
        return view('series.create');
    }

    public function store(Request $request)
    {
        $serie = DB::transaction(function () use($request) {


            $serie = Series::create($request->all());
            $seasons = [];
            for ($i = 1; $i <= $request->seasonsQty; $i++) {
                $seasons[] = [
                    'series_id' => $serie->id,
                    'number' => $i,
                ];
            }
            Season::insert($seasons);
            foreach ($serie->temporadas as $season) {
                for ($j = 1; $j <= $request->episodesPerSeason; $j++) {
                    $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j
                    ];

                }
            }
            Episode::insert($episodes);

            return $serie;
        });
        return redirect()->route('series.index')->with('mensagem.sucesso', "Série '{$serie->nome}' adicionado com sucesso");

    }


    public function show()
    {
    }


    public function destroy(Series $series)
    {
        $series->delete();
        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso");
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('serie', $series);
    }
    public function update(Series $series, Request $request)
    {
        $series->update([
            'nome' => $request->input('nome')
        ]);
        return redirect()->route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' atualizada com sucesso");
    }
}
