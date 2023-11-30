<?php

namespace App\Http\Controllers;

use App\Models\Neighborhood;
use App\Models\Province;
use Illuminate\Http\Request;

class TerritoryController extends Controller
{
    public function neighborhood()
    {
        $neighborhoods = Neighborhood::where('average_price', '>=', 0)->orderBy('name')->get();
        return response()->json($neighborhoods);
    }

    public function province()
    {
        $provinces = Province::all()->sortBy('name');
        return response()->json($provinces);
    }
}
