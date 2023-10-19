<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class Account extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_incomes',
        'total_expenses',
        'budget',
        'is_active',
    ];

    protected $casts = [
        'total_incomes' => 'float',
        'total_expenses' => 'float',
        'budget' => 'float',
        'is_active' => 'boolean',
    ];

    public function accountTransactions()
    {
        return $this->hasMany(AccountTransaction::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
