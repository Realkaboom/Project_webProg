<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestData extends Model
{
    protected $table = 'requests';

    protected $fillable = [
        'user_id',
        'barang_id',
        'quantity',
        'status',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function barang()
    {
        return $this->belongsTo(barang::class, 'barang_id');
    }

    public function logs()
    {
        return $this->hasMany(RequestLog::class, 'request_id');
    }
}
