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
    protected $primaryKey = 'id_transaksi';
    public $incrementing = true;
    protected $fillable = [
        'total_bayar',
        'id_user',
        'id_obat',
    ];

    static function getTransaksi(){
        $data = DB::table('transaksi')->join('users', 'users.id', '=', 'transaksi.id_user')->join('obat', 'obat.id', '=', 'transaksi.id_obat');
        return $data;
    }

    protected $hidden = [];
}
