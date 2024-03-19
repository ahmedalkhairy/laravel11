<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'spi_id',
        'spi_url',
        'is_active',
        'description',
        'active_prompt',
        'attributes',
        'active_attributes',
    ];

    protected $casts = [
        'attributes' => 'json',
        'active_attributes' => 'json',
    ];

    public function getIsActiveTextAttribute(): string
    {
        return $this->is_active ? 'yes' : 'no';
    }

    public function prompts(): HasMany
    {
        return $this->hasMany(Prompt::class);
    }
}
