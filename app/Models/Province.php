<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class Province extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'region_id',
    ];

    public function municipalities()
    {
        return $this->hasMany(Municipality::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }
}
