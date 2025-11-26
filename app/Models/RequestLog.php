<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    protected $table = 'request_logs';

    protected $fillable = [
        'request_id',
        'user_id',
        'status',
        'quantity',
        'message',
    ];

    public function request()
    {
        return $this->belongsTo(RequestData::class, 'request_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
