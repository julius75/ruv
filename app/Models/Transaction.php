<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference_number',
        'amount',
        'vendor_id',
        'merchant_id',
        'user_id',
        'status',
        'approved',
        'transactionable_id',
        'transactionable_type',
        'created_at',
        'updated_at'
    ];

    protected $casts = [
//        'created_at' => 'datetime:j F Y g:i A',
        'created_at' => 'datetime:Y-m-d h:i:s',
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
        return $this->belongsTo(User::class, 'user_id');
    }

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
}
