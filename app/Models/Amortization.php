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
class Amortization extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'loan',
        'periods',
        'interest',
        'monthly_payment',
        'total_cost_interest',
        'total_cost_loan',
        'total_interest_paid',
        'total_principal_paid',
        'remaining_balance',
        'start_date',
        'end_date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function amortizationDetails(): HasMany
    {
        return $this->hasMany(AmortizationDetail::class);
    }
}
