<?php

namespace App\Http\Controllers\API;

use App\Helpers\APIFormatter;
use App\Http\Controllers\Controller;
use App\Models\ItemsModel;
use Illuminate\Http\Request;
use App\Models\TransaksiModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = TransaksiModel::getTransaksi()->get();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function checkout(Request $request) {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'exists:obat,id',
            'total_bayar' => 'required',
        ]);

        $transaksi = TransaksiModel::create([
            'total_bayar' => $request->total_bayar,
            'id_user' => Auth::user()->id,
        ]);

        foreach ($request->items as $obat) {
            ItemsModel::create([
                'id_user' => Auth::user()->id,
                'id_obat' => $obat['id'],
                'id_transaksi' => $transaksi->id,
                'jumlah' => $obat['jumlah']
            ]);
        }

        return APIFormatter::createAPI(200, 'Success', $transaksi->load('items.obat'));
    }
}
