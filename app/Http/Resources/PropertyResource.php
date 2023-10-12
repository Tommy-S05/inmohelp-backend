<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    public static $wrap = '';

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'code' => $this->code,
            'name' => $this->name,
            'agent' => new UserResource($this->user),
            'property_type' => $this->propertyType->name,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'province' => $this->province->name,
            'municipality' => $this->municipality->name,
            'neighborhood' => $this->neighborhood->name,
            'address' => $this->address,
            'purpose' => $this->purpose,
            'price' => $this->price,
            'area' => $this->area,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'garages' => $this->garages,
            'property_status' => $this->propertyStatus->name,
            'floors' => $this->floors,
            'featured' => $this->featured,
            'negotiable' => $this->negotiable,
            'furnished' => $this->furnished,
            'published_at' => $this->published_at,
            'year_built' => $this->year_built,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'amenities' => $this->amenities->pluck('name'),
            'thumbnail' => $this->getMedia('thumbnail'),
            'gallery' => $this->getMedia('*'),
        ];
//        return parent::toArray($request);
    }
}
