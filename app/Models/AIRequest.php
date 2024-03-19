<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class AIRequest extends Model
{
    use HasFactory;

    protected $table = 'a_i_requests';

    protected $fillable = [
        'identifier',
        'server_ip',
        'request',
        'response',
        'status',
        'image',
        'image_path',
        'image_url',
        'category',
        'start_execution_time',
        'end_execution_time',
    ];

    protected $casts = [
        'response' => 'array',
        'request' => 'array',
        'start_execution_time' => 'datetime',
        'end_execution_time' => 'datetime',
    ];

    public function getImageAttribute($value)
    {
        return !is_null($value) ? asset(Storage::url($value)) : '';
    }

}
