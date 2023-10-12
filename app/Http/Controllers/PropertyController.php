<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePropertyRequest;
use App\Http\Requests\UpdatePropertyRequest;
use App\Http\Resources\PropertyResource;
use App\QueryFilters\Property\AffordableFilter;
use App\QueryFilters\Property\AreaFilter;
use App\QueryFilters\Property\PropertyTypeFilter;
use App\Traits\FinancialsTrait;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Property;
use App\QueryFilters\Property\BathroomsFilter;
use App\QueryFilters\Property\BedroomsFilter;
use App\QueryFilters\Property\GaragesFilter;
use App\QueryFilters\Property\MaxPriceFilter;
use App\QueryFilters\Property\MinPriceFilter;
use App\QueryFilters\Property\NeighborhoodFilter;
use App\QueryFilters\Property\ProvinceFilter;
use App\QueryFilters\Property\PurposeFilter;
use Illuminate\Pipeline\Pipeline;

class PropertyController extends Controller
{
    use FinancialsTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $properties = app(Pipeline::class)
            ->send(Property::query())
            ->through([
                AreaFilter::class,
                PurposeFilter::class,
                //                PropertyTypeFilter::class,
                //                ProvinceFilter::class,
                //                NeighborhoodFilter::class,
                BedroomsFilter::class,
                BathroomsFilter::class,
                GaragesFilter::class,
                MinPriceFilter::class,
                MaxPriceFilter::class,
            ])
            ->thenReturn()
            ->where('available', true)
            ->where('published', true)
            ->where('published_at', '<=', now())
            ->where('is_active', true)
            ->get(['id', 'name', 'slug', 'province_id', 'purpose', 'price', 'area', 'bedrooms', 'bathrooms', 'garages']);
        //            ->paginate(10, ['id', 'name', 'slug', 'city', 'purpose', 'price', 'area', 'bedrooms', 'bathrooms', 'garages']);

        return response()->json($properties);
    }

    public function affordableProperties(Request $request): JsonResponse
    {
        if (!$request->has('affordable') || $request->input('affordable') != 'true') {
            $request->merge(['affordable' => 'true']);
        }
        $properties = app(Pipeline::class)
            ->send(Property::query())
            ->through([
                AffordableFilter::class,
                AreaFilter::class,
//                PurposeFilter::class,
                //                PropertyTypeFilter::class,
                //                ProvinceFilter::class,
                //                NeighborhoodFilter::class,
                BedroomsFilter::class,
                BathroomsFilter::class,
                GaragesFilter::class,
                MinPriceFilter::class,
                MaxPriceFilter::class,
            ])
            ->thenReturn()
            ->where('available', true)
            ->where('published', true)
            ->where('published_at', '<=', now())
            ->where('is_active', true)
            ->get(['id', 'name', 'slug', 'province_id', 'purpose', 'price', 'area', 'bedrooms', 'bathrooms', 'garages']);

        return response()->json($properties);
    }

    public function outstanding(): JsonResponse
    {
        //outstanding properties
        //        $properties = Property::where('outstanding', 1)->get(['id', 'name', 'slug', 'city', 'purpose', 'price', 'area', 'bedrooms', 'bathrooms', 'garages']);
        $properties = Property::orderBy('views', 'desc')
            ->take(9)
            ->where('available', true)
            ->where('published', true)
            ->where('published_at', '<=', now())
            ->where('is_active', true)
            ->get(['id', 'name', 'slug', 'province_id', 'purpose', 'price', 'area', 'bedrooms', 'bathrooms', 'garages', 'views']);

        foreach ($properties as $property) {
            $property->thumbnail = $property->getFirstMediaUrl('thumbnail');
        }
        return response()->json($properties);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyRequest $request)
    {
        //        return response()->json([
        //            'success' => true,
        //            'message' => 'Property created successfully.',
        //            'data' => $request->all(),
        //        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property): JsonResponse
    {
        return response()->json(new PropertyResource($property));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyRequest $request, Property $property)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return response()->noContent();
    }
}
