<?php

namespace App\Database;

use Illuminate\Database\Schema\Blueprint as SchemaBlueprint;

class Blueprint extends SchemaBlueprint
{
    /**
     * create a 'current' column indicating whether the record is the most current version.
     **/
    public function current()
    {
        return $this->boolean('current');
    }

    /**
     * create columns for `last_name`, `first_name`, and `middle_name`
     **/
    public function fullName($nullableLast = true, $nullableFirst = true, $nullableMiddle = true)
    {
        $this->string('last_name')->nullable($nullableLast);
        $this->string('first_name')->nullable($nullableFirst);
        $this->string('middle_name')->nullable($nullableMiddle);
    }

    /**
     * create foreign key reference for barangay
     **/
    public function barangayId($column = 'barangay_id', $nullable = true)
    {
        return $this->foreignId($column)->nullable($nullable)->constrained('barangays');
    }

    /**
     * create foreign key reference for places (city/municipality)
     **/
    public function placeId($column = 'place_id', $nullable = true)
    {
        return $this->foreignId($column)->nullable($nullable)->constrained('places');
    }

    /**
     * create foreign key id for key table
     **/
    public function foreignRecordId($column, $prefix = null, $nullable = true)
    {
        $pref = $prefix ? $prefix : preg_replace('/_id$/', '', $column);
        $table = $pref . '_records';
        return $this->foreignId($column)->nullable($nullable)->constrained($table);
    }
}
