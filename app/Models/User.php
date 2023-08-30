<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'balance',
        'currency',
        'uuid',
        'created_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    #region relationships
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
    #endregion relationships

    #region scopes
    public function scopeSearch(Builder $query, Request $request): void
    {
        $query->when(
            $request->status && in_array($request->status, array_keys(config('settings.transactions.codes'))),
            fn ($q) => $q->where('transactions.status_code', config("settings.transactions.codes.{$request->status}"))
        );

        $query->when($request->user_currency, fn ($q) => $q->where('users.currency', 'like', "%$request->user_currency%"));

        $query->when($request->transaction_currency, fn ($q) => $q->where('transactions.currency', 'like', "%$request->transaction_currency%"));

        $query->when(($request->amount_from || $request->amount_to), fn ($q) => $q->whereBetween('paid_amount', [$request->amount_from, $request->amount_to]));

        $query->when(($request->date_from || $request->date_to),
            fn ($q) => $q->where('payment_date', '>=', $request->date_from)
                ->where('payment_date', '<=', $request->date_to)
        );
    }
    #endregion scopes

}
