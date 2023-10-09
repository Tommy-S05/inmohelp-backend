<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        'thumbnail',
        'short_description',
        'description',
        'province_id',
        'municipality_id',
        'neighborhood_id',
        'address',
        'map',
        'latitude',
        'longitude',
        'purpose',
        'price',
        'area',
        'bedrooms',
        'bathrooms',
        'garages',
        'status',
        'floors',
        'views',
        'featured',
        'sold',
        'rented',
        'available',
        'negotiable',
        'furnished',
        'published',
        'published_at',
        'year_built',
        'is_active',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'sold' => 'boolean',
        'rented' => 'boolean',
        'available' => 'boolean',
        'negotiable' => 'boolean',
        'furnished' => 'boolean',
        'published' => 'boolean',
        'published_at' => 'datetime',
        'year_built' => 'date:M Y',
        'is_active' => 'boolean',
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

    public function municipality(): BelongsTo
    {
        return $this->belongsTo(Municipality::class);
    }

    public function neighborhood(): BelongsTo
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function amenities(): BelongsToMany
    {
        return $this->belongsToMany(Amenity::class);
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(PropertyGallery::class);
    }
}
