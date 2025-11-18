<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategoribarang',
        'supplierbarang',
        'namabarang',
        'hargabarang',
        'jumlahbarang',
        'fotobarang'
    ];
    public function category()
    {
        return $this->belongsTo(category::class, 'kategoribarang');
    }
    public function supplier()
    {
        return $this->belongsTo(supplier::class, 'supplierbarang');
    }
}
