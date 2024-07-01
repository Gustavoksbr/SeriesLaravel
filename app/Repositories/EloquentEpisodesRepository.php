<?php
namespace App\Repositories;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use App\Http\Requests\EpisodesFormRequest;
use Illuminate\Support\Facades\DB;

class EloquentEpisodesRepository
{
    // public function checar(EpisodesFormRequest $request,Season $season)
    // {
        
    //     return DB::transaction(function () use ($request,$season) {

    //         foreach ($request->episodes as $id) {
    //             Episode::where('id', $id)->update([
    //                 'assistido' => 'true',
    //             ]);
    //         }
    //     });
    // }
}