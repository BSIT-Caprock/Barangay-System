<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class House extends Model
{
    use \App\Attributes\BarangayAttribute;
    use \App\Attributes\InhabitantsAttribute;
    use \App\Attributes\StreetAttribute;
    use \App\Attributes\ZoneAttribute;
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['number'];

    public function __toString()
    {
        return $this->number;
    }
}
