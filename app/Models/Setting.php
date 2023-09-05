<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Builder
 */
class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'interest_rate',
        'down_payment_available',
        'loan_term',
        'is_active',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
