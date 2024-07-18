<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CredentialTemplate extends Model
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

    public function outputs()
    {
        return $this->hasMany(Credential::class, 'credential_template_id');
    }

    protected function fileName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->title . '.' . pathinfo($this->file_path, PATHINFO_EXTENSION),
        );
    }
}
