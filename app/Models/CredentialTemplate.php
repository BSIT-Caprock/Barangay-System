<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CredentialTemplate extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'filename',
        'filepath',
        'title',
    ];

    public function outputs()
    {
        return $this->hasMany(Credential::class, 'credential_template_id');
    }
}
