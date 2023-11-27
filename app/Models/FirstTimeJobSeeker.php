<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FirstTimeJobSeeker extends Model
{
    use \App\Attributes\BarangayAttribute;
    use \App\Attributes\CourseAttribute;
    use \App\Attributes\EducationalLevelAttribute;
    use \App\Attributes\SexAttribute;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'last_name',
        'first_name',
        'middle_name',
        'birth_date',
        'course_id',
        'date_applied',
    ];

    public function getMonthYearAttribute()
    {
        return Carbon::parse($this->date_applied)->format('F Y');
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birth_date)->age;
    }
}
