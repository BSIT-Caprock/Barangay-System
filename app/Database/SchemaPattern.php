<?php

namespace App\Database;

use Illuminate\Support\Facades\Schema;

class SchemaPattern extends Schema
{
    /**
     * create table with id() and timestamps()
     **/
    public static function createIdTimestamps($tableName, $callback = null)
    {
        Schema::create($tableName, function (Blueprint $table) use ($callback) {
            $table->id();
            if ($callback) $callback($table);
            $table->timestamps();
        });
    }

    /**
     * create a self-referencing table.
     * No need to add id() and timestamps().
     * 
     * used for seldom-updated data
     **/
    public static function createSelfReferencing($tableName, $callback, $hasCurrent = True)
    {
        static::createIdTimestamps($tableName, $callback);

        Schema::table($tableName, function (Blueprint $table) use ($tableName, $hasCurrent) {
            if ($hasCurrent) $table->current();
            $tableName->foreignId('parent_id')->nullable()->constrained($tableName);
        });
    }

    /**
     * create a pair of key and record tables. 
     * No need to add id() and timestamps(). 
     * 
     * used for frequently updating data
     **/
    public static function createKeyRecordOf($tablePrefix, $callback, $keyCallback = null)
    {
        static::createIdTimestamps($tablePrefix . '_keys', function (Blueprint $table) use ($keyCallback) {
            if ($keyCallback) $keyCallback($table);
        });

        static::createIdTimestamps($tablePrefix . '_records', function (Blueprint $table) use ($tablePrefix, $callback) {
            $table->foreignId('key_id')->constrained($tablePrefix . '_keys');
            $callback($table);
        });
    }

    /**
     * drop the pair of key and record tables.
     **/
    public static function dropKeyRecordOf($tablePrefix)
    {
        Schema::dropIfExists($tablePrefix . '_records');
        Schema::dropIfExists($tablePrefix . '_keys');
    }
}
