<?php

namespace App\Http\Controllers\Api;

use App\Models\Rencana;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RencanaResource;
use Illuminate\Support\Facades\Validator;

class RencanaController extends Controller
{
    public function index()
    {
        //get posts
        $Rencana = Rencana::latest()->paginate(5);

        //return collection of posts as a resource
        return new RencanaResource(true, 'List Data Rencana Perjalanan', $Rencana);
    }

    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'tgl_keberangkatan'     => 'required',
            'waktu_keberangkatan'     => 'required',
            'waktu_perjalanan'   => 'required',
            'tujuan'   => 'required',
            'tlp'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        //create post
        $Rencana = Rencana::create([
            'tgl_keberangkatan'     => $request-> tgl_keberangkatan,
            'waktu_keberangkatan'     => $request-> waktu_keberangkatan,
            'waktu_perjalanan'   => $request-> waktu_perjalanan,
            'tujuan'   => $request->tujuan,
            'tlp'   => $request->tlp,
        ]);

        //return response
        return new RencanaResource(true, 'Data Rencana Perjalanan Berhasil Ditambahkan!', $Rencana);
    }

    public function show(Rencana $Rencana)
    {
        //return single post as a resource
        return new RencanaResource(true, 'Data Rencana Perjalanan Ditemukan!', $Rencana);
    }

    public function update(Request $request, Rencana $Rencana)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'tgl_keberangkatan'     => 'required',
            'waktu_keberangkatan'   => 'required',
            'waktu_perjalanan'   => 'required',
            'tujuan'   => 'required',
            'tlp'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //return response
        return new RencanaResource(true, 'Data Rencana Perjalanan Berhasil Diubah!', $Rencana);
    }

    public function destroy(Rencana $Rencana)
    {

        //delete Rencana
        $Rencana->delete();

        //return response
        return new RencanaResource(true, 'Data Rencana Berhasil Dihapus!', null);
    }
}
