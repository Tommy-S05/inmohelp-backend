<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class Neighborhood extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'municipality_id',
    ];

    public function municipality()
    {
        return $this->belongsTo(Municipality::class);
    }
}
