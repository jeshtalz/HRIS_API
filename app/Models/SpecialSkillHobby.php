<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialSkillHobby extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'personal_data_sheet_id',
        'special_skills'
    ];
}
