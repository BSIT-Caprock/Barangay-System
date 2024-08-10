<?php

namespace App\Models\Generator;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class Template extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'file_path',
        'title',
    ];

    protected $appends = [
        'file_name',
    ];

    public static $disk = 'local';

    protected static function booted(): void
    {
        static::updated(function (self $model) {
            if ($model->isDirty('file_path')) {
                Storage::disk($model::$disk)->delete($model->getOriginal('file_path'));
            }
        });
    }

    public function outputs()
    {
        return $this->hasMany(Output::class);
    }

    protected function fileName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->title . '.' . pathinfo($this->file_path, PATHINFO_EXTENSION),
        );
    }

    protected function macros(): Attribute
    {

        $processor = new TemplateProcessor(Storage::disk($this::$disk)->path($this->file_path));
        return Attribute::make(
            get: fn () => $processor->getVariables(),
        );
    }
}
