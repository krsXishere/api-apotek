<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class TransaksiModel extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'transaksi';
    protected $fillable = [
        'total_bayar',
        'id_user',
    ];

    // static function getTransaksi(){
    //     $data = DB::table('transaksi')->join('users', 'users.id', '=', 'transaksi.id_user')->join('obat', 'obat.id', '=', 'transaksi.id_obat');
    //     return $data;
    // }

    public function user() {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function items() {
        return $this->hasMany(ItemsModel::class, 'id_transaksi', 'id');
    }

    protected $hidden = [];
}
