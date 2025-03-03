<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partit extends Model
{

    protected static function booted()
    {
        static::updated(function ($partit) {
            event(new PartitActualitzat($partit));
        });
    }
}
