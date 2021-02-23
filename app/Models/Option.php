<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;
    protected $fillable = ['key', 'value'];
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
}
