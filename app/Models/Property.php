<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

/**
 * @mixin Builder
 */
class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'slug',
        'user_id',
        'property_type_id',
        'description',
        'province_id',
        'neighborhood_id',
        'address',
        'map',
        'purpose',
        'price',
        'area',
        'bedrooms',
        'bathrooms',
        'garages',
        'floors',
        'views',
        'outstanding',
        'sold',
        'rented',
        'available',
        'negotiable',
        'furnished',
        'published_at',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function propertyType()
    {
        return $this->belongsTo(PropertyType::class);
    }
}
