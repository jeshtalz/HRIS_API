<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SalaryGrade;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Position extends Model
{
    use HasFactory;
    
    public function belongsToSalaryGrade (): BelongsTo
    {
        return $this->belongsTo(SalaryGrade::class,'salary_grade_id');
    }
    public function hasManyQualificationStandard (): HasMany
    {
        return $this->hasMany(QualificationStandard::class);
    }
    public function hasManyPlantilla (): HasMany
    {
        return $this->hasMany(Plantilla::class);
    }

    protected $primaryKey = 'id';
    // protected $foreignKey = 'salary_grade_id';

    protected $fillable = [
        'title',
        'salary_grade_id'
    ];
}
