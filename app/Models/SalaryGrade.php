<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SalaryGrade extends s
    use HasFactory;


    protected $fillable = [
        'number',
        'amount',
    ];

}
