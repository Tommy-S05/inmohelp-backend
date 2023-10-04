<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class Icon extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
        'icon_type_id',
        'icon_family',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function iconType(): BelongsTo
    {
        return $this->belongsTo(IconType::class);
    }

    public function amenities(): HasMany
    {
        return $this->hasMany(Amenity::class);
    }
}
