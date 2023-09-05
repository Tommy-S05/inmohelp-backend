<?php

namespace App\Http\Controllers;

use App\Models\PropertyType;
use App\Http\Requests\StorePropertyTypeRequest;
use App\Http\Requests\UpdatePropertyTypeRequest;

class PropertyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //        $propertyTypes = PropertyType::orderBy('id', 'desc');
        $propertyTypes = PropertyType::orderBy('id', 'asc')->take(5)->get();
        return response()->json([
            'success' => true,
            'message' => 'Listado de tipos de propiedades, primeras 5',
            'data' => $propertyTypes
        ]);
    }

    public function getAll()
    {
        $propertyTypes = PropertyType::orderBy('id', 'asc')->get();
        return response()->json([
            'success' => true,
            'message' => 'Listado de tipos de propiedades',
            'data' => $propertyTypes
        ]);
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePropertyTypeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(PropertyType $propertyType)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePropertyTypeRequest $request, PropertyType $propertyType)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PropertyType $propertyType)
    {
        //
    }
}
