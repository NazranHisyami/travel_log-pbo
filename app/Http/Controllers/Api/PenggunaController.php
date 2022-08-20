<?php

namespace App\Http\Controllers\Api;

use App\Models\Pengguna;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\PenggunaResource;
use Illuminate\Support\Facades\Validator;

class PenggunaController extends Controller
{
    public function index()
    {
        $pengguna = Pengguna::latest()->paginate(5);

        return new PenggunaResource(true, 'List Data User', $pengguna);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_lengkap'     => 'required',
            'email'     => 'required',
            'tgl_lahir'   => 'required',
            'NIK'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //create post
        $pengguna = Pengguna::create([
            'nama_lengkap'     => $request->nama_lengkap,
            'email'     => $request->email,
            'tgl_lahir'   => $request->tgl_lahir,
            'NIK'   => $request->NIK,
        ]);

        //return response
        return new PenggunaResource(true, 'Data User Berhasil Ditambahkan!', $pengguna);
    }

    public function show(Pengguna $pengguna)
    {
        //return single post as a resource
        return new PenggunaResource(true, 'Data User Ditemukan!', $pengguna);
    }

    public function update(Request $request, Pengguna $pengguna)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'nama_lengkap'     => 'required',
            'email'   => 'required',
            'tgl_lahir'   => 'required',
            'NIK'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //return response
        return new PenggunaResource(true, 'Data User Berhasil Diubah!', $pengguna);
    }

    public function destroy(Pengguna $pengguna)
    {

        //delete post
        $pengguna->delete();

        //return response
        return new PenggunaResource(true, 'Data User Berhasil Dihapus!', null);
    }
}
