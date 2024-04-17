<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelKalayangMenu;
use Illuminate\Cache\Repository;

class ControllerKalayang extends Controller
{
    //Controller Menu 
    public function makemenu(Request $request)
    {
        $id_penjual = $request->post('id_penjual');
        $nama_menu = $request->post('nama_menu');
        $harga_menu = $request->post('harga_menu');
        $ekstra = $request->post('ekstra');
        $status_menu = $request->post('status_menu');
        $desc_menu = $request->post('desc_menu');

        if ($nama_menu) {
            if ($harga_menu) {
                $savemenu = new ModelKalayangMenu();
                $savemenu->id_penjual = $id_penjual;
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
                $msg = "Harga menu tidak boleh kosong!";
                $sts = false;
            }
        } else {
            $msg = "Nama menu tidak boleh kosong!";
            $sts = false;
        }

        return response()->json(['message' => $msg, 'status' => $sts], 201);
    }

    public function viewmenu()
    {
        $oneuser = ModelKalayangMenu::all();
        return response()->json(['message' => 'success', 'data' => $oneuser], 200);
    }

    public function updatemenu(Request $request)
    {

        $id_menu = $request->post('id_menu');
        $nama_menu = $request->post('nama_menu');
        $harga_menu = $request->post('harga_menu');
        $ekstra = $request->post('ekstra');
        $status_menu = $request->post('status_menu');
        $desc_menu = $request->post('desc_menu');

        $savemenu = ModelKalayangMenu::find($id_menu);
        if ($savemenu) {
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
        $nama_menu = $request->post('nama_menu');
        $harga_menu = $request->post('harga_menu');
        $ekstra = $request->post('ekstra');
        $status_menu = $request->post('status_menu');
        $desc_menu = $request->post('desc_menu');

        $savemenu = ModelKalayangMenu::find($id_menu);
        if ($savemenu) {
            $savemenu->nama_menu = $nama_menu;
            $savemenu->harga_menu = $harga_menu;
            $savemenu->ekstra = $ekstra;
            $savemenu->status_menu = $status_menu;
            $savemenu->desc_menu = $desc_menu;
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

        if(!$menu){
            return response()->json(['message' => 'Data Not Found'], 404);
        } else {
            return response()->json(['message' => 'success', 'data' => $menu], 200);
        }
       
    }

    //Controller Transaksi
}
