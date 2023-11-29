<?php

namespace App\Http\Controllers;

use App\Models\Neighborhood;
use Illuminate\Http\Request;

class TerritoryController extends Controller
{
    public function neighborhood()
    {
        $neighborhoods = Neighborhood::where('average_price', '>=', 0)->get();
        return response()->json($neighborhoods);
    }
}
