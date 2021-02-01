<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PhoneNumber extends Model
{
    use SoftDeletes, HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'provider_id',
        'phone_number',
        'user_default',
        'passcode',
        'is_active',
        'deleted_at'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
