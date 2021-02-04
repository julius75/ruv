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

    protected $casts = [
        'created_at' => 'datetime:j F Y g:i A',
    ];

    public function transactionable()
    {
        return $this->morphTo();
    }

    public function scopeFailed($query)
    {
        return $query->where('status','=', false);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
