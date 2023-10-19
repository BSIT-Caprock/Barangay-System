<?php

namespace App\Models\Personnel;

use App\Models\Abstract\RecordModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonnelRecord extends RecordModel
{
    protected $table = 'personnel_records';
    
    protected $fillable = [
        'barangay_record_id',
        'last_name',
        'first_name',
        'middle_name',
        'suffix',
        'position',
    ];

    protected static $keyModel = Personnel::class;

    public function barangay_record()
    {
        return $this->belongsTo(BarangayRecord::class);
    }
}
