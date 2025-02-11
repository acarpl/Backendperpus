<?php

namespace App\Http\Controllers;

use App\Models\bukuModel;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = BukuModel::all();
        return response()->json($data,200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        if(empty($request->judul_buku) || empty($request->pengarang) || empty($request->penerbit)):
            $pesan = [
                'status' => false,
                'massage' => 'Data tidak lengkap/kosong, silahkan dilengkapi'
            ];
            $status = 403;
    else:
        $data = [
            'judul_buku' => $request ->judul_buku,
            'pengarang' => $request ->pengarang,
            'penerbit' => $request ->penerbit
        ];
        if(bukuModel::create($data)):
            $pesan = [
                'status' => true,
                'massage' => 'Data berhasil di tambahkan'
            ];
            $status = 201;
        else:
            $pesan = [
                'status' => false,
                'massage' => 'Data tidak lengkap/kosong, silahkan dilengkapi'
            ];
            $status = 400;
        endif;
    endif;
    return response()->json($pesan,$status);
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $data = BukuModel::where('id_buku','=',$id)->get();
        return response()->json($data,200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        if (empty($request->judul_buku) || empty($request->pengarang) || empty($request->penerbit)):

            $pesan = [
            'status' => false,
            'message' => 'Update data gagal, periksa lagi data yang dikirim'
            ];
            
            $status = 403;
            
            else:
            
            $data = [
                'judul_buku' => $request->judul_buku,
                'pengarang' => $request->pengarang,
                'penerbit' => $request->penerbit
            ];
            
            $update = BukuModel::where('id_buku', '=', $id)->update($data);
            
            if ($update):
            $pesan = [
            'status' => true,
            'message' => 'Data berhasil diperbarui'
            ];
            $status = 201;
            
            else:
            $pesan = [
            'status' => false,
            'message' => 'Data gagal diperbarui'
            ];
            $status = 400; //Forbidden
            endif;
            endif;
            return response()->json($pesan, $status);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $aksiHapus = BukuModel::where('id_buku', '=', $id)->delete();
        if($aksiHapus):
            $pesan = [
                'status' => true,
                'massage' => 'Data di hapus'
            ];
            $status = 200;
        else:
            $pesan = [
                'status' => false,
                'massage' => 'Data gagal di hapus'
            ];
            $status = 403;
        endif;
        return response()->json($pesan,$status);
    }
}
