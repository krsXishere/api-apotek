<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemsModel extends Model
{
    use HasFactory;

    protected $table = 'items';
    protected $fillable = [
        'id_user',
        'id_obat',
        'id_transaksi',
        'jumlah'
    ];

    public function obat() {
        return $this->hasOne(ObatModel::class, 'id', 'id_obat');
    }
}
