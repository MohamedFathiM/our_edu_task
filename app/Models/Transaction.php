<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'paid_amount',
        'currency',
        'parent_email',
        'status_code',
        'payment_date',
        'parent_identification',
        'user_id',
    ];

    #region relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    #endregion relationships
}
