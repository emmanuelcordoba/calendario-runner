<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\Edition;
use App\Models\Race;
use App\Models\Search;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->start && $request->end && $request->discipline;
        $start = ($request->desde && $request->end) ? $search = $request->start : Carbon::now()->format('Y-m-d');
        $end = ($request->desde && $request->end) ? $search = $request->end : Carbon::now()->addMonths(12)->format('Y-m-d');
        $discipline = $request->disciplina ? Discipline::find($request->discipline) : 'all';

        if($search)
        {
            Search::create(['start_date' => $start, 'end_date' => $end, 'discipline' => $discipline]);
        }

        $disciplines = Discipline::all();
        $editions = Edition::where('start_date' ,'>=',$start)->where('end_date' ,'<=',$end)->with('race.discipline');
        if($discipline !== 'all')
        {
            $editions = $editions->whereRelation('race.discipline','discipline_id', $discipline->id);
        }
        $editions = $editions->orderBy('start_date')->get();

        return Inertia::render('welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'featured' => false,
            'search' => $search,
            'start' => $start,
            'end' => $end,
            'discipline' => $discipline !== 'all' ? $discipline->id : 'all',
            'disciplines' => $disciplines,
            'editions' => $editions
        ]);
    }

    public function show(Request $request, Race $race, string $year)
    {
        if(!$race)
        {
            abort(404);
        }


        $edition = $race->editions()->whereYear('start_date', $year)->first();
        if($edition)
        {
            $edition->load(['race.places','race.links','race.discipline']);
        }

        $race->searches()->create();

        return Inertia::render('show-edition', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'edition' => $edition
        ]);
    }
}
