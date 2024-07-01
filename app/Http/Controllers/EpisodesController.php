<?php

namespace App\Http\Controllers;

use App\Http\Requests\EpisodesFormRequest;
use App\Models\Season;
use App\Models\Series;
use App\Models\Episode;
use App\Http\Controllers\Controller;
use App\Repositories\EloquentEpisodesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class EpisodesController extends Controller
{
    public function __construct(private EloquentEpisodesRepository $repository)
    {

    }
    public function index(Season $season)
    {
        return view('episodes.index',[
            'episodes'=>$season->episodes,
            'mensagemSucesso' => session('mensagem.sucesso')
        ]);
    }
    public function update(Request $request, Season $season)
    {

    //     $assistidos = $request->episodes;
    //     $season->episodes->each(function(Episode $episode) use($assistidos)
    // {
    //     $episode->assistido = in_array($episode->id,$assistidos);
    // });
    // $season->push();
    // $this->repository->checar($request,$season);

    //     return to_route('episodes.index',$season->id);

    DB::transaction(function () use ($request, $season) {
        $assistidos = $request->episodes;
        
        $season->episodes->each(function (Episode $episode) use ($assistidos) {
            $episode->assistido = in_array($episode->id, $assistidos);
        });

        $season->push();
    });

    return to_route('episodes.index', $season->id)->with('mensagem.sucesso','Episódios marcados como assistidos');

    }
}