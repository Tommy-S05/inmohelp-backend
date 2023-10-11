<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class PropertyImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'image',
    ];

    public function property(): BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
