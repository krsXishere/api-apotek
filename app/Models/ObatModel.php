<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ObatModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'obat';
    protected $fillable = [
        'nama_obat',
        'jenis_obat',
        'harga',
    ];
    protected $hidden = [];
}
