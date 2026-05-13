<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public $timestamps = true;

    // 🔹 جلب قيمة setting
    public static function getValue($key, $default = null)
    {
        return Cache::remember("setting_$key", 3600, function () use ($key, $default) {
            return self::where('key', $key)->value('value') ?? $default;
        });
    }

    // 🔹 تحديث أو إنشاء setting
    public static function setValue($key, $value)
    {
        Cache::forget("setting_$key");

        return self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );
    }
}