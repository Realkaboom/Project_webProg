<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class supplier extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'contact',
        'address',
    ];
    public function barangs()
    {
        return $this->hasMany(barang::class, 'supplierbarang');
    }
}
