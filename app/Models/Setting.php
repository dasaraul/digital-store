<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value'
    ];

    public static function boot()
    {
        parent::boot();

        static::saved(function ($model) {
            Cache::forget('setting_' . $model->key);
        });

        static::deleted(function ($model) {
            Cache::forget('setting_' . $model->key);
        });
    }
}