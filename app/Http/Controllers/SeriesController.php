<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Middleware\Autenticador;
use App\Http\Requests\SeriesFormRequest;
use App\Repositories\EloquentSeriesRepository;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Series;
use App\Models\Season;
use App\Models\Episode;
use Illuminate\Routing;


class SeriesController extends Controller
{
    //
    public function __construct(private EloquentSeriesRepository $repository)
    {
        $this->middleware(Autenticador::class)->except('index');
    }
    public function index(Request $request)
    {
        // impede que seja acessível caso não esteja logado
        // if (!Auth::check())
        // {
        //     throw new AuthenticationException();
        // }
        $series = Series::with(['temporadas'])->get();
        $mensagemSucesso = $request->session()->get('mensagem.sucesso');
        return view('series.index', compact('series'))->with('mensagemSucesso', $mensagemSucesso);
    }

    public function create(Request $request)
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request)
    {
        $serie = $this->repository->add($request);

        return to_route('series.index')
            ->with('mensagem.sucesso', "Série '{$serie->nome}' adicionada com sucesso");
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
