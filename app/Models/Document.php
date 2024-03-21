<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Filesystem\FilesystemAdapter;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasFactory;

    protected $fillable = ['filename', 'filepath'];

    public const DISK = 'documents';

    public function outputs()
    {
        return $this->hasMany(DocumentOutput::class);
    }

    public function getFullPathAttribute(): string
    {
        return $this->disk()->path($this->filepath);
    }

    public function getFileSizeAttribute(): string
    {
        return $this->disk()->size($this->filepath);
    }

    public function disk(): FilesystemAdapter
    {
        return Storage::disk(self::DISK);
    }
}
