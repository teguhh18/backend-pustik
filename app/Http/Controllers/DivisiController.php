<?php

namespace App\Http\Controllers;

use App\Models\Divisi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DivisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisi = Divisi::all();
        return response()->json([
            'status' => true,
            'message' => 'Data Divisi Berhasil Diambil',
            'data' => $divisi,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'nama_divisi' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Tambah Divisi Gagal',
                'data' => $validator->errors(),
            ], 401);
        }

        $divisi = Divisi::create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Proses Tambah Divisi Berhasil',
            'data' => $divisi,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Divisi $divisi, $id)
    {
        $divisi = Divisi::find($id);
        if (!$divisi) {
            return response()->json([
                'status' => false,
                'message' => 'Divisi Tidak Ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data Divisi Berhasil Diambil',
            'data' => $divisi,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, $id)
    {
        // 
    }
       

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $divisi = Divisi::find($id);
        // dd($divisi);
        $rules = [
            'nama_divisi' => 'required',
        ];

       $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Ubah Divisi Gagal',
                'data' => $validator->errors(),
            ], 401);
        }

        $divisi->nama_divisi = $request->nama_divisi;
        $divisi->save();
        // $divisi->update($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Proses Ubah Divisi Berhasil',
            'data' => $divisi,
        ], 200);
   
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Divisi $divisi, $id)
    {
        $divisi = Divisi::find($id);
        if (!$divisi) {
            return response()->json([
                'status' => false,
                'message' => 'Divisi Tidak Ditemukan',
            ], 404);
        }

        $divisi->delete();
        return response()->json([
            'status' => true,
            'message' => 'Proses Hapus Divisi Berhasil',
        ], 200);
    }
}
