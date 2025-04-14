<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;

    protected $fillable = [
        'operation',
        'credit_bank',
        'assignment',
        'customer_type',
        'customer_name',
        'description',
        'alert_datetime',
    ];
}
