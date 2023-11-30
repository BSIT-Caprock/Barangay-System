<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Street extends Model
{
    use \App\Attributes\BarangayAttribute;
    use \App\Attributes\InhabitantsAttribute;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['name'];

    public function __toString()
    {
        return $this->name;
    }
}
