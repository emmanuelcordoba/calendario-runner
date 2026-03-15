<?php

namespace App\Http\Controllers;

use App\Models\Discipline;
use App\Models\Edition;
use App\Models\Race;
use App\Models\Search;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $start = $request->input('start', Carbon::now()->format('Y-m-d'));
        $end = $request->input('end', Carbon::now()->addMonths(12)->format('Y-m-d'));
        $disciplineId = (string) $request->input('discipline', 'all');
        $search = $request->filled('start') && $request->filled('end') && $request->filled('discipline');
        $discipline = $disciplineId !== 'all' ? Discipline::find($disciplineId) : null;

        if ($disciplineId !== 'all' && ! $discipline) {
            $disciplineId = 'all';
        }

        if ($search) {
            Search::create([
                'start_date' => $start,
                'end_date' => $end,
                'discipline' => $disciplineId,
            ]);
        }

        $disciplines = Discipline::all();
        $editions = Edition::where('start_date' ,'>=',$start)->where('end_date' ,'<=',$end)->with('race.discipline');
        if ($discipline) {
            $editions = $editions->whereRelation('race', 'discipline_id', $discipline->id);
        }
        $editions = $editions->orderBy('start_date')->get();

        return Inertia::render('welcome', [
            'featured' => false,
            'search' => $search,
            'start' => $start,
            'end' => $end,
            'discipline' => $discipline ? (string) $discipline->id : 'all',
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
            'edition' => $edition
        ]);
    }
}
