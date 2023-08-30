<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $statusCodes = array_flip(config('settings.transactions.codes'));

        return [
            'id' => $this->id,
            'paid_amount' => (float) $this->paid_amount,
            'currency' => $this->currency,
            'parent_email' => $this->parent_email,
            'status_code' => $this->status_code ? $statusCodes[$this->status_code] : '',
            'payment_date' => Carbon::parse($this->payment_date)->format('Y-m-d'),
            'parent_identification' => $this->parent_identification,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
