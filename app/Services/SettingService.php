<?php

namespace App\Services;

use App\Models\Setting;

class SettingService
{
    public function get($key, $group = null, $default = null)
    {
        $query = Setting::where('key', $key);
        if ($group) {
            $query->where('group', $group);
        }

        return $query->value('value') ?? $default;
    }

    public function set($key, $value, $group = null)
    {
        Setting::updateOrCreate(['key' => $key], ['value' => $value, 'group' => $group]);
    }
}
