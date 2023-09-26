<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class AmortizationDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'amortization_id',
        'year',
        'period',
        'payment',
        'interest_paid',
        'principal_paid',
        'remaining_balance',
        'payment_date',
        'is_paid',
    ];

    public function amortization(): BelongsTo
    {
        return $this->belongsTo(Amortization::class);
    }
}
