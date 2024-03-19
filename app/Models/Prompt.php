<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prompt extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'properties',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'properties' => 'json',
    ];

    public function getIsActiveTextAttribute()
    {
        return $this->is_active ? 'yes' : 'no';
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
