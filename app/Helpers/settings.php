<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('settings')) {
    function settings($key = null, $default = null)
    {
        if (is_null($key)) {
            return app(Setting::class);
        }

        if (is_array($key)) {
            foreach ($key as $k => $v) {
                Cache::forget('setting_' . $k);
                Setting::updateOrCreate(
                    ['key' => $k],
                    ['value' => $v]
                );
            }
            return true;
        }

        return Cache::remember('setting_' . $key, 60 * 24, function () use ($key, $default) {
            $setting = Setting::where('key', $key)->first();
            return $setting ? $setting->value : $default;
        });
    }
}