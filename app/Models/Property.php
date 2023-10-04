<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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

    public function propertyType(): BelongsTo
    {
        return $this->belongsTo(PropertyType::class);
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class);
    }

    public function neighborhood(): BelongsTo
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class);
    }
}
