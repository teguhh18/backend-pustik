<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggota = Anggota::with('divisi')->get();
        return response()->json([
            'status' => true,
            'message' => 'Data Anggota Berhasil Diambil',
            'data' => $anggota,
        ], 200);
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
        $rules = [
            'nama_anggota' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'divisi_id' => 'required',
            'foto' => 'image',

        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Tambah Anggota Gagal',
                'data' => $validator->errors(),
            ], 401);
        }

        $anggota = new Anggota();
        $anggota->nama_anggota = $request->nama_anggota;
        $anggota->alamat = $request->alamat;
        $anggota->no_telp = $request->no_telp;
        $anggota->divisi_id = $request->divisi_id;
    
        if ($request->hasFile('foto')) {
            $anggota->foto = $request->file('foto')->store('foto-anggota', 'public');
        }

        $anggota = Anggota::create($anggota->toArray());

        return response()->json([
            'status' => true,
            'message' => 'Proses Tambah Anggota Berhasil',
            'data' => $anggota,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $anggota = Anggota::with('divisi')->find($id);
        if (!$anggota) {
            return response()->json([
                'status' => false,
                'message' => 'Anggota Tidak Ditemukan',
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data Anggota Berhasil Diambil',
            'data' => $anggota,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Anggota $anggota)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $anggota = Anggota::find($id);
        // dd($anggota);
        if (!$anggota) {
            return response()->json([
                'status' => false,
                'message' => 'Anggota Tidak Ditemukan',
            ], 404);
        }

        $rules = [
            'nama_anggota' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'divisi_id' => 'required',
            'foto' => 'image',
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Update Anggota Gagal',
                'data' => $validator->errors(),
            ], 401);
        }

        $anggota->nama_anggota = $request->nama_anggota;
        $anggota->alamat = $request->alamat;
        $anggota->no_telp = $request->no_telp;
        $anggota->divisi_id = $request->divisi_id;

        if ($request->hasFile('foto')) {
             if ($anggota->foto) {
                Storage::delete('public/' . $anggota->foto);
                $anggota->foto = $request->file('foto')->store('foto-anggota', 'public');
            }
        }
        $anggota->save();

        return response()->json([
            'status' => true,
            'message' => 'Proses Update Anggota Berhasil',
            'data' => $anggota,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $anggota = Anggota::find($id);
        if (!$anggota) {
            return response()->json([
                'status' => false,
                'message' => 'Anggota Tidak Ditemukan',
            ], 404);
        }

        if ($anggota->foto) {
            Storage::delete('public/' . $anggota->foto);
        }

        $anggota->delete();

        return response()->json([
            'status' => true,
            'message' => 'Proses Hapus Anggota Berhasil',
        ], 200);
    }
}
