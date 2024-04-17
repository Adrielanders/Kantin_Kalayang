<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelKalayangMenu;
use App\Models\ModelKalayangTransaksi;
use Illuminate\Cache\Repository;
use Illuminate\Support\Facades\DB;

class ControllerKalayang extends Controller
{
    //Controller Menu 
    public function makemenu(Request $request)
    {
        $id_penjual = $request->post('id_penjual');
        $jenis = $request->post('jenis');
        $nama_menu = $request->post('nama_menu');
        $harga_menu = $request->post('harga_menu');
        $ekstra = $request->post('ekstra');
        $status_menu = $request->post('status_menu');
        $desc_menu = $request->post('desc_menu');

        if ($nama_menu) {
            if ($harga_menu) {
                if ($jenis) {
                    $savemenu = new ModelKalayangMenu();
                    $savemenu->id_penjual = $id_penjual;
                    $savemenu->jenis = $jenis;
                    $savemenu->nama_menu = $nama_menu;
                    $savemenu->harga_menu = $harga_menu;
                    $savemenu->ekstra = $ekstra;
                    $savemenu->status_menu = $status_menu;
                    $savemenu->desc_menu = $desc_menu;
                    $savemenu->save();
                    if ($savemenu) {
                        $msg = "Data berhasil di simpan";
                        $sts = true;
                    } else {
                        $msg = "Data gagal di simpan";
                        $sts = false;
                    }
                } else {
                    $msg = "Jenis menu tidak boleh kosong!";
                    $sts = false;
                }
            } else {
                $msg = "Harga menu tidak boleh kosong!";
                $sts = false;
            }
        } else {
            $msg = "Nama menu tidak boleh kosong!";
            $sts = false;
        }

        return response()->json(['message' => $msg, 'status' => $sts], 200);
    }

    public function viewmenu()
    {
        $allmenu = ModelKalayangMenu::all();
        return response()->json(['message' => 'success', 'data' => $allmenu], 200);
    }

    public function updatemenu(Request $request)
    {

        $id_menu = $request->post('id_menu');
        $jenis = $request->post('jenis');
        $nama_menu = $request->post('nama_menu');
        $harga_menu = $request->post('harga_menu');
        $ekstra = $request->post('ekstra');
        $status_menu = $request->post('status_menu');
        $desc_menu = $request->post('desc_menu');

        $savemenu = ModelKalayangMenu::find($id_menu);
        if ($savemenu) {
            $savemenu->jenis = $jenis;
            $savemenu->nama_menu = $nama_menu;
            $savemenu->harga_menu = $harga_menu;
            $savemenu->ekstra = $ekstra;
            $savemenu->status_menu = $status_menu;
            $savemenu->desc_menu = $desc_menu;
            $savemenu->save();

            return response()->json(['message' => "Menu Update Successfully"], 200);
        } else {
            return response()->json(['message' => "Menu not found"], 404);
        }
    }

    public function deletemenu(Request $request)
    {
        $id_menu = $request->post('id_menu');
        $savemenu = ModelKalayangMenu::find($id_menu);
        if ($savemenu) {
            $savemenu->delete();

            return response()->json(['message' => "Menu Delete Successfully"], 200);
        } else {
            return response()->json(['message' => "Menu not found"], 404);
        }
    }

    public function viewonemenu(Request $request)
    {
        $id_menu = $request->post('id_menu');
        $menu = ModelKalayangMenu::find($id_menu);

        if (!$menu) {
            return response()->json(['message' => 'Data Not Found'], 404);
        } else {
            return response()->json(['message' => 'success', 'data' => $menu], 200);
        }
    }

    //Controller Transaksi
    public function viewtransaksi(Request $request)
    {
        $id_penjual = $request->post('id_penjual');
        $nomor_meja = $request->post('nomor_meja');
        $alltransaksi = ModelKalayangTransaksi::select(
                'id_menu',
                DB::raw('MAX(id_order) AS id_order'),
                DB::raw('MAX(tanggal_pemesanan) AS tanggal_pemesanan'),
                DB::raw('MAX(nomor_meja) AS nomor_meja'),
                DB::raw('MAX(status_pesanan) AS status_pesanan'),
                DB::raw('MAX(catatan_pemesan) AS catatan_pemesan'),
                DB::raw('MAX(ekstra_menu) AS ekstra_menu'),
                DB::raw('MAX(created_at) AS created_at'),
                DB::raw('MAX(updated_at) AS updated_at'),
                DB::raw('COUNT(id_menu) AS Jumlah_pesan'),
                'id_penjual'
            )
            ->where('id_penjual', $id_penjual)
            ->where('nomor_meja',  $nomor_meja)
            ->groupBy('id_menu', 'id_penjual')
            ->get();

        return response()->json(['message' => 'success', 'data' => $alltransaksi], 200);
    }

    public function savetransaksi(Request $request)
    {
        $id_menu = $request->post('id_menu');
        $id_penjual = $request->post('id_penjual');
        $nomor_meja = $request->post('nomor_meja');
        $status_pesanan = $request->post('status_pesanan');
        $catatan_pemesan = $request->post('catatan_pemesan');
        $ekstra_menu = $request->post('ekstra_menu');


        $transaction = new ModelKalayangTransaksi();
        $transaction->id_menu = $id_menu;
        $transaction->id_penjual = $id_penjual;
        $transaction->id_order = $this->generateUniqueNumber();
        $transaction->nomor_meja = $nomor_meja;
        $transaction->status_pesanan = $status_pesanan;
        $transaction->catatan_pemesan = $catatan_pemesan;
        $transaction->ekstra_menu = $ekstra_menu;
        $transaction->save();

        if ($transaction) {
            $msg = "Data berhasil di simpan";
            $sts = true;
        } else {
            $msg = "Data gagal di simpan";
            $sts = false;
        }

        return response()->json(['message' => $msg, 'status' => $sts], 200);
    }


    //Controller Privaate Function
    private function generateUniqueNumber()
    {
        $date = date('dmy');
        $lastNumber = ModelKalayangTransaksi::where('id_order', 'like', '#M' . $date . '%')->max('id_order');
        $lastSequentialNumber = $lastNumber ? intval(substr($lastNumber, 10)) : 0;
        if (!$lastNumber) {
            $nextSequentialNumber = 1;
        } else {
            $nextSequentialNumber = $lastSequentialNumber + 1;
        }
        return '#M' . $date . sprintf('%04d', $nextSequentialNumber);
    }
}
