<?php
namespace App\Repositories;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Series;
use App\Http\Requests\SeriesFormRequest;


use Illuminate\Support\Facades\DB;


interface SeriesRepository
{
    public function add(SeriesFormRequest $request):Series;
}