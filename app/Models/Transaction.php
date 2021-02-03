<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount',
        'user_id',
        'status',
        'transactionable_id',
        'transactionable_type',
        'created_at',
        'updated_at'
    ];

    public function transactionable()
    {
        return $this->morphTo();
    }

    public function scopeFailed($query)
    {
        return $query->where('status','=', false);
    }
}
