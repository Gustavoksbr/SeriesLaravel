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

        // $series = DB::select('Select nome from series;');
        // ou
        // $series = Serie::all();
        //ou
        $series = Series::with([ 'temporadas'])->get();
        // ou
        // se eu quiser, posso fazer por ordem alfabetica
        // $serie = Serie::query()->orderBy('nome')->get();

        $mensagemSucesso = $request->session()->get('mensagem.sucesso');

        // $request->session()->forget('mensagem.sucesso'); apaga a mensagem de session após um refresh. Utiliza-se se o método destroy utiliza o put, em vez do flash

        // return view('listar-series',['series'=>$series]);
        return view('series.index', compact('series'))->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create(Request $request)
    {
        return view('series.create');
    }
    // método store expressivo desatualizado só com series
    // public function store(Request $request)
    // {
    //     $serie = Serie::create($request->all());
    //     $request->session()->flash('mensagem.sucesso',"Série '{$serie->nome}' adicionado com sucesso");
    //     return redirect()->route('series.index');
    // }
    
    //método store atualizado só q gera mts queries
    // public function store(Request $request)
    // {
    //     $serie = Series::create($request->all());
    //     for ($i=1;$i<=$request->seasonsQty;$i++)
    //     {
    //             $season = $serie->temporadas()->create([
    //                 'number' => $i,

    //         ]);
    //         for ($j=1;$j<=$request->episodesPerSeason;$j++)
    //         {
    //                 $season->episodes()->create([
    //                     'number' => $j,
                        
    //             ]);
    //         }
    //     }

        public function store(Request $request)
        {
            $serie = Series::create($request->all());
            $seasons = [];
            for ($i=1;$i<=$request->seasonsQty;$i++)
            {
                    $seasons[] = [
                    'series_id' => $serie->id,
                    'number' => $i,
                ];
            }
            Season::insert($seasons);
            foreach ($serie->temporadas as $season){
                for ($j=1;$j<=$request->episodesPerSeason;$j++)
                {
                       $episodes[] = [
                        'season_id' => $season->id,
                        'number' => $j
                       ];
                    
                }
            }
            Episode::insert($episodes);

    
            return redirect()->route('series.index')->with('mensagem.sucesso', "Série '{$serie->nome}' adicionado com sucesso");
        
        }
    

    public function show()
    {
    }

    // Este método destroy só deleta e manda mensagem de sucesso, mas não diz qual série ele deletou
    // public function destroy(Request $request){
    //     Serie::destroy($request->series);
    //     $request->session()->flash('mensagem.sucesso','Série removida com sucesso');
    //     return to_route('series.index');
    // }

    // Método destroy expressivo
    // public function destroy(Serie $series, Request $request){
    //     $series->delete();
    //     $request->session()->flash('mensagem.sucesso',"Série '{$series->nome}' removida com sucesso");
    //     return to_route('series.index');
    // }


    public function destroy(Series $series)
    {
        $series->delete();
        return to_route('series.index')->with('mensagem.sucesso', "Série '{$series->nome}' removida com sucesso");
    }

    public function edit(Series $series)
    {
        return view('series.edit')->with('serie',$series);
    }
    public function update(Series $series, Request $request)
    {
        //nao funcionou:
        // $series->nome = $request->nome;
        // $series-save();
        // return to_route('series.index')
        //     ->with('mensagem.sucesso',"Série '{$series->nome}' atualizada com sucesso");
        $series->update([
            'nome' => $request->input('nome')
        ]);
        return redirect()->route('series.index')->with('mensagem.sucesso',"Série '{$series->nome}' atualizada com sucesso");
    }
}
