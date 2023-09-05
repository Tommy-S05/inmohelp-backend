<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountTransaction;
use App\Models\Property;
use App\Models\Setting;
use App\QueryFilters\Property\AreaFilter;
use App\QueryFilters\Property\BathroomsFilter;
use App\QueryFilters\Property\BedroomsFilter;
use App\QueryFilters\Property\GaragesFilter;
use App\QueryFilters\Property\MaxPriceFilter;
use App\QueryFilters\Property\MinPriceFilter;
use App\QueryFilters\Property\NeighborhoodFilter;
use App\QueryFilters\Property\ProvinceFilter;
use App\QueryFilters\Property\PurposeFilter;
use App\Traits\FinancialsTrait;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FinancialController extends Controller
{
    use FinancialsTrait;

    public function affordableProperties(Request $request)
    {
        $available = $this->monthlyBudget()->getData();
        //        $perPage = $request->input('per_page', 5); // Obtener el número de elementos por página de la solicitud
        //        $currentPage = $request->input('page', 1); // Obtener la página actual de la solicitud

        $query = Property::query()
            ->select('id', 'name', 'slug', 'province', 'purpose', 'price', 'area', 'bedrooms', 'bathrooms', 'garages')
            ->whereRaw('(' . $this->monthlyPaymentsSql() . ') <= ?', [$available]);

        $properties = app(Pipeline::class)
            ->send($query)
            ->through([
                AreaFilter::class,
                PurposeFilter::class,
                ProvinceFilter::class,
                NeighborhoodFilter::class,
                BedroomsFilter::class,
                BathroomsFilter::class,
                GaragesFilter::class,
                MinPriceFilter::class,
                MaxPriceFilter::class,
            ])
            ->thenReturn()
            ->get();
        //            ->paginate($perPage, ['*'], 'page', $currentPage);

        return response()->json([
            'success' => true,
            'message' => 'Affordable properties',
            'data' => $properties
        ]);
    }

    //    public function affordableProperties()
    //    {
    //        $available = $this->monthlyBudget()->getData();
    //        //        $properties = Property::select('*')
    //        //            ->whereRaw('monthlyPayments(price) <= ?', [$available])
    //        //            //            ->whereRaw('? <= ?', [50000, $available])
    //        //            ->get();
    //
    //        $properties = Property::all(['id', 'name', 'slug', 'province', 'purpose', 'price', 'area', 'bedrooms', 'bathrooms', 'garages'])
    //            ->filter(function($property) use ($available) {
    //                $request = new Request();
    //                $request->price = $property->price;
    //                $monthlyPayments = $this->monthlyPayments($request)->getData();
    //                if($monthlyPayments <= $available) {
    //                    return $property;
    //                }
    //                return null;
    //            })->values();
    //        return response()->json([
    //            'success' => true,
    //            'message' => 'Affordable properties',
    //            'data' => $properties
    //        ]);
    //    }

    public function affordableProperties2()
    {
        $available = $this->monthlyBudget2()->getData();
        $properties = Property::all()->filter(function($property) use ($available) {
            $request = new Request();
            $request->price = $property->price;
            //            $request->merge(['price' => $property->price]);
            $monthlyPayments = $this->monthlyPayments($request)->getData();
            if($monthlyPayments <= $available) {
                return $property;
            }
            return null;
        })->values();
        return response()->json([
            'success' => true,
            'message' => 'Affordable properties',
            'data' => $properties
        ]);
    }
}
