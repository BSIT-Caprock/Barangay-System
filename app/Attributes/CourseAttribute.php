<?php

namespace App\Attributes;

use App\Models\Course;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CourseAttribute
{
    protected function initializeCourseAttribute()
    {
        $this->mergeFillable([$this->getCourseKey()]);
    }

    public function getCourseKey()
    {
        return $this->courseKey ?? 'course_id';
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, $this->getCourseKey());
    }
}
