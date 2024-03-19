<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Spatie\Activitylog\Traits\LogsActivity;

class Server extends Model
{
    use HasFactory;
//    use LogsActivity;
    protected $casts = [
        'status_details' => 'array',
    ];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
        // Chain fluent methods for configuration options
    }

    public function logs(){
        return $this->hasMany(Activity::class,'subject_id')->where('subject_type',"App\Models\Server")->orderBy('id','desc');
    }
}
