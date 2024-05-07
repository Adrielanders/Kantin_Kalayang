<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ModelKalayangMenu;
use App\Models\ModelKalayangTransaksi;
use App\Models\ModelKalayangPenjual;
use App\Models\ModelKalayangSession;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Mail\SendEmailNew;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class ControllerKalayang extends Controller
{
    //Controller Menu CRUD
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
            'tb_transaksi.id_menu',
            DB::raw('MAX(tb_transaksi.id_order) AS id_order'),
            DB::raw("DATE_FORMAT(MAX(tb_transaksi.tanggal_pemesanan), '%d/%m/%Y %h:%s') AS formatted_tanggal_pemesanan"),
            DB::raw('MAX(tb_transaksi.nomor_meja) AS nomor_meja'),
            DB::raw('MAX(tb_transaksi.status_pesanan) AS status_pesanan'),
            DB::raw('MAX(tb_transaksi.catatan_pemesan) AS catatan_pemesan'),
            DB::raw('MAX(tb_transaksi.ekstra_menu) AS ekstra_menu'),
            DB::raw('MAX(tb_transaksi.created_at) AS created_at'),
            DB::raw('MAX(tb_transaksi.updated_at) AS updated_at'),
            DB::raw("CONCAT('x', COUNT(tb_transaksi.id_menu)) AS Jumlah_pesan"),
            'tb_transaksi.id_penjual',
            DB::raw('SUM(tb_menu.harga_menu) AS harga_menu'),
        )
            ->join('tb_menu', 'tb_menu.id_menu', '=', 'tb_transaksi.id_menu')
            ->where('tb_transaksi.id_penjual', $id_penjual)
            ->where('tb_transaksi.nomor_meja',  $nomor_meja)
            ->whereNotIn('tb_transaksi.status_pesanan', ['SELESAI'])
            ->groupBy('tb_transaksi.id_menu', 'tb_transaksi.id_penjual')
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

    public function viewrekap(Request $request)
    {
        $id_penjual = $request->post('id_penjual');
        $alltransaksi = ModelKalayangTransaksi::select(
            DB::raw("DATE_FORMAT(DATE(tb_transaksi.tanggal_pemesanan), '%d/%m/%Y %h:%i') AS formatted_tanggal_pemesanan"),
            DB::raw('MAX(tb_transaksi.id_order) AS id_order'),
            DB::raw('MAX(tb_transaksi.nomor_meja) AS nomor_meja'),
            DB::raw('MAX(tb_transaksi.status_pesanan) AS status_pesanan'),
            DB::raw('MAX(tb_transaksi.catatan_pemesan) AS catatan_pemesan'),
            DB::raw('MAX(tb_transaksi.ekstra_menu) AS ekstra_menu'),
            DB::raw('MAX(tb_transaksi.created_at) AS created_at'),
            DB::raw('MAX(tb_transaksi.updated_at) AS updated_at'),
            DB::raw('COUNT(tb_transaksi.id_penjual) AS Jumlah_pesan'),
            'tb_transaksi.id_penjual',
            DB::raw('SUM(tb_menu.harga_menu) AS harga_menu')
        )
            ->join('tb_menu', 'tb_menu.id_menu', '=', 'tb_transaksi.id_menu')
            ->where('tb_transaksi.id_penjual', $id_penjual)
            ->groupBy('formatted_tanggal_pemesanan', 'tb_transaksi.id_penjual')
            ->get();

        return response()->json(['message' => 'success', 'data' => $alltransaksi], 200);
    }

    public function detailrekap(Request $request)
    {
        $id_penjual = $request->post('id_penjual');
        $date = $request->post('date');
        $alltransaksi = ModelKalayangTransaksi::select(
            DB::raw("DATE_FORMAT(DATE(tb_transaksi.tanggal_pemesanan), '%d/%m/%Y %h:%i') AS formatted_tanggal_pemesanan"),
            DB::raw('MAX(tb_transaksi.id_order) AS id_order'),
            DB::raw('MAX(tb_transaksi.nomor_meja) AS nomor_meja'),
            DB::raw('MAX(tb_transaksi.status_pesanan) AS status_pesanan'),
            DB::raw('MAX(tb_transaksi.catatan_pemesan) AS catatan_pemesan'),
            DB::raw('MAX(tb_transaksi.ekstra_menu) AS ekstra_menu'),
            DB::raw('MAX(tb_transaksi.created_at) AS created_at'),
            DB::raw('MAX(tb_transaksi.updated_at) AS updated_at'),
            DB::raw('COUNT(tb_transaksi.id_penjual) AS Jumlah_pesan'),
            'tb_transaksi.id_penjual',
            DB::raw('SUM(tb_menu.harga_menu) AS harga_menu'),
            DB::raw('MAX(tb_menu.nama_menu) AS nama_menu'),
            DB::raw('COUNT(tb_menu.id_menu) AS Jumlah')
        )
            ->join('tb_menu', 'tb_menu.id_menu', '=', 'tb_transaksi.id_menu')
            ->where('tb_transaksi.id_penjual', $id_penjual)
            ->wheredate('tb_transaksi.tanggal_pemesanan', $date)
            ->groupBy('formatted_tanggal_pemesanan', 'tb_transaksi.id_penjual')
            ->get();

        return response()->json(['message' => 'success', 'data' => $alltransaksi], 200);


        return response()->json(['message' => 'success', 'data' => $alltransaksi], 200);


        $detailtransaksi = ModelKalayangTransaksi::select(
            DB::raw("DATE_FORMAT(DATE(tb_transaksi.tanggal_pemesanan), '%d/%m/%Y %h:%i') AS formatted_tanggal_pemesanan"),
            'tb_transaksi.id_penjual',
            DB::raw('SUM(tb_menu.harga_menu) AS harga_menu'),
            DB::raw('MAX(tb_menu.nama_menu) AS nama_menu'),
            DB::raw('COUNT(tb_menu.id_menu) AS Jumlah')
        )
            ->join('tb_menu', 'tb_menu.id_menu', '=', 'tb_transaksi.id_menu')
            ->where('tb_transaksi.id_penjual', $id_penjual)
            ->wheredate('tb_transaksi.tanggal_pemesanan', $date)
            ->groupBy('formatted_tanggal_pemesanan', 'tb_transaksi.id_penjual', 'tb_menu.id_menu')
            ->get();



        return response()->json(['message' => 'success', 'data' => $alltransaksi, 'detail' => $detailtransaksi], 200);
    }

    //Controller Penjual
    public function savedatapenjual(Request $request)
    {
        $nama_pemilik_toko = $request->post('nama_pemilik_toko');
        $nama_toko = $request->post('nama_toko');
        $nomor_telepon = $request->post('nomor_telepon');
        $nomor_toko = $request->post('nomor_toko');
        $email = $request->post('email');
        $existingEmail = ModelKalayangPenjual::where('email', $email)->first();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "Format email tidak valid";
            $sts = false;
            return response()->json(['message' => $msg, 'status' => $sts], 404);
        } else {
            if ($existingEmail) {
                $msg = "Email sudah terdaftar";
                $sts = false;
                return response()->json(['message' => $msg, 'status' => $sts], 404);
            } else {
                if ($nama_pemilik_toko) {
                    if ($nama_toko) {
                        if ($nomor_telepon) {
                            if ($nomor_toko) {
                                if ($email) {
                                    $savedata = new ModelKalayangPenjual();
                                    $savedata->nama_pemilik = $nama_pemilik_toko;
                                    $savedata->nama_toko = $nama_toko;
                                    $savedata->nomor_telepon = $nomor_telepon;
                                    $savedata->nomor_toko = $nomor_toko;
                                    $savedata->email = $email;
                                    $savedata->save();

                                    if ($savedata) {
                                        $msg = "Data berhasil di simpan";
                                        $sts = true;
                                    } else {
                                        $msg = "Data gagal di simpan";
                                        $sts = false;
                                    }
                                } else {
                                    $sts = false;
                                    $msg = "Email tidak boleh kosong";
                                }
                            } else {
                                $sts = false;
                                $msg = "Nomor toko tidak boleh kosong";
                            }
                        } else {
                            $sts = false;
                            $msg = "Nomor telepon tidak boleh kosong";
                        }
                    } else {
                        $sts = false;
                        $msg = "Nama toko tidak boleh kosong";
                    }
                } else {
                    $sts = false;
                    $msg = "Nama pemilik toko tidak boleh kosong";
                }
                return response()->json(['message' => $msg, 'status' => $sts], 200);
            }
        }
    }

    public function generatepassword(Request $request)
    {
        $email = $request->post('email');
        $penjual = ModelKalayangPenjual::where('email', 'like', $email . '%')->first();
        if ($penjual) {
            $idPenjual = $penjual->id_penjual;
            $UpdatePenjual = ModelKalayangPenjual::find($idPenjual);
            $password = Str::password(16, true, true, false, false);
            if ($UpdatePenjual) {
                $UpdatePenjual->kata_sandi = $password;
                $UpdatePenjual->save();
                return response()->json(['message' => "Update berhasil", 'status' => true], 200);
            } else {
                return response()->json(['message' => "Update penjual gagal", 'status' => false], 500);
            }
        } else {
            return  response()->json(['message' => "gagal mencari id", 'status' => false], 404);
        }
    }

    public function loginnewuser(Request $request)
    {
        $email = $request->post('email');
        $kata_sandi = $request->post('kata_sandi');
        $penjual = ModelKalayangPenjual::where('email', $email)->first();

        if (!$penjual) {
            return response()->json(['message' => "Akun belum terdaftar", 'status' => false], 404);
        }

        $emaildatabase = $penjual->email;
        $password = $penjual->kata_sandi;

        if ($email != $emaildatabase || $kata_sandi != $password) {
            return response()->json(['message' => "Email atau Password salah", 'status' => false], 404);
        }
        return response()->json(['message' => "Berhasil login", 'status' => true], 200);
    }

    public function RegisterUser(Request $request)
    {
        $email = $request->post('email');
        $penjual = ModelKalayangPenjual::where('email', 'like', $email . '%')->first();
    }

    //E-Mail
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendemail(Request $request)
    {
        $email = $request->post('email');
        $penjual = ModelKalayangPenjual::where('email', 'like', $email . '%')->first();
        if ($penjual) {
            session(['namaPemilik' => $penjual['nama_pemilik']]);
            session(['email' => $penjual['email']]);
            session(['nomorTelepon' => $penjual['nomor_telepon']]);
            session(['KataSandi' => $penjual['kata_sandi']]);
            if ($email) {
                Mail::to($email)->send(new SendEmail());
            } else {
                return "error";
            }
            return  response()->json(['message' => "berhasil kirim", 'status' => true], 200);
        } else {
            return response()->json(['message' => "Data tidak ditemukan", 'status' => false, 'data' => $penjual], 404);
        }
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

    // Han Vir

    public function savedatapenjual_new(Request $request)
    {
        $nama_pemilik_toko = $request->post('nama_pemilik_toko');
        $nama_toko = $request->post('nama_toko');
        $nomor_telepon = $request->post('nomor_telepon');
        $nomor_toko = $request->post('nomor_toko');
        $email = $request->post('email');
        $existingEmail = ModelKalayangPenjual::where('email', $email)->first();
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $msg = "Format email tidak valid";
            $sts = false;
            return response()->json(['message' => $msg, 'status' => $sts, 'email' => $email], 404);
        } else {
            if ($existingEmail) {
                $msg = "Email sudah terdaftar";
                $sts = false;
                return response()->json(['message' => $msg, 'status' => $sts], 404);
            } else {
                if ($nama_pemilik_toko) {
                    if ($nama_toko) {
                        if ($nomor_telepon) {
                            if ($nomor_toko) {
                                if ($email) {
                                    $savedata = new ModelKalayangPenjual();
                                    $savedata->nama_pemilik = $nama_pemilik_toko;
                                    $savedata->nama_toko = $nama_toko;
                                    $savedata->nomor_telepon = $nomor_telepon;
                                    $savedata->nomor_toko = $nomor_toko;
                                    $savedata->email = $email;
                                    $savedata->status_acc = 'WAITING';
                                    $savedata->kata_sandi = Str::password(16, true, true, false, false);
                                    $savedata->save();

                                    if ($savedata) {
                                        $msg = "Data berhasil di simpan";
                                        $sts = true;
                                    } else {
                                        $msg = "Data gagal di simpan";
                                        $sts = false;
                                    }
                                } else {
                                    $sts = false;
                                    $msg = "Email tidak boleh kosong";
                                }
                            } else {
                                $sts = false;
                                $msg = "Nomor toko tidak boleh kosong";
                            }
                        } else {
                            $sts = false;
                            $msg = "Nomor telepon tidak boleh kosong";
                        }
                    } else {
                        $sts = false;
                        $msg = "Nama toko tidak boleh kosong";
                    }
                } else {
                    $sts = false;
                    $msg = "Nama pemilik toko tidak boleh kosong";
                }
                return response()->json(['message' => $msg, 'status' => $sts], 200);
            }
        }
    }

    public function sendemail_new($email)
    {
        $penjual = ModelKalayangPenjual::where('email', 'like', $email . '%')->first();
        if ($email) {
            if ($penjual) {
                $content = '<!DOCTYPE html>
                <html>

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <meta http-equiv="X-UA-Compatible" content="ie=edge">
                    <style>
                        body {
                            height: 750px;
                            margin: 2px;
                            padding: 2px;
                            font-family: Helvetica, Arial, sans-serif;
                        }

                        .button-container {
                            margin: 40px 0;
                        }

                        #box {
                            width: 850px;
                            margin: 0 auto;
                            height: 100%;
                        }

                        #header {
                            height: 200px;
                            width: 100%;
                            position: relative;
                            display: block;
                            border-bottom: 1px solid #504597;
                        }

                        .button {
                            background-color: #d60e0e;
                            border: none;
                            color: white !important;
                            padding: 10px 25px;
                            text-align: center;
                            text-decoration: none;
                            margin: auto;
                            font-size: 22px;
                            cursor: pointer;
                            border-radius: 10px;
                        }

                        #image {
                            width: 150px;
                            height: auto;
                            margin-top: 16px;
                        }

                        #rightbar {
                            width: 100%;
                            height: 560px;
                            padding: 0px;
                        }

                        .text-div {
                            font-size: 18px;
                            margin-bottom: 3px;
                        }

                        #footer {
                            clear: both;
                            height: 40px;
                            text-align: center;
                            background-color: #2d0f80;
                            margin: 0px;
                            padding: 0px;
                            color: white;
                        }

                        p,
                        pre {
                            font-size: 18px;
                            line-height: 1.4;
                        }

                        .heading {
                            color: #504597;
                            font-size: 24px;
                        }
                    </style>
                </head>

                <body>
                    <!-- mail body -->
                    <div id="box">
                        <div id="header">
                        </div>
                        <div class="spacing"></div>
                        <div id="rightbar">
                            <h1 class="heading"></h1>
                            <p>Hi, '.$penjual['nama_pemilik'].'</p>
                            <p>Terimakasih telah mendaftar di kantin kalayang</p>
                            <p>dengan email ini kami telah menyetujui seluruh berkas yang anda berikan</p>
                            <p>berikut kami berikan username dan password :</p>
                            <p>Email : '.$penjual['email'].'</p>
                            <p>Password : '.$penjual['kata_sandi'].'</p>
                            <p>Mohon setelah anda berhasil login dapat langsung mengganti password anda</p>
                            <div class="text-div">Terima kasih,</div>
                            <div class="text-div">Admin Kantin Kalayang</div>
                        </div>
                    </div>
                </body>

                </html>';
                $mailData = [
                    'to' => $penjual['email'],
                    'content' => $content,
                    'subject' => 'Your Registration is Accepted!!!',
                ];
                $send = Mail::to($mailData['to'])->send(new SendEmailNew($mailData));
                echo var_dump($send);
                exit;
            } else {
                return "error";
            }
            return true;
        } else {
            return false;
        }
    }

}
