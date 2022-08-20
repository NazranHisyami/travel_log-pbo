<?php

namespace App\Http\Controllers\Api;

use App\Models\Catatan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\CatatanResource;
use Illuminate\Support\Facades\Validator;

class CatatanController extends Controller
{
    public function index()
    {
        //get posts
        $Catatan = Catatan::latest()->paginate(5);

        //return collection of posts as a resource
        return new CatatanResource(true, 'List Data Catatan', $Catatan);
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
            'rating'   => 'required',
            'catatan_user'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }


        //create post
        $Catatan = Catatan::create([
            'tgl_keberangkatan'     => $request-> tgl_keberangkatan,
            'waktu_keberangkatan'     => $request-> waktu_keberangkatan,
            'waktu_perjalanan'   => $request-> waktu_perjalanan,
            'tujuan'   => $request->tujuan,
            'tlp'   => $request->tlp,
            'rating'   => $request->rating,
            'catatan_user'   => $request->catatan_user,
        ]);

        //return response
        return new CatatanResource(true, 'Data Catatan Perjalanan Berhasil Ditambahkan!', $Catatan);
    }

    public function show(Catatan $Catatan)
    {
        //return single post as a resource
        return new CatatanResource(true, 'Data Catatan Perjalanan Ditemukan!', $Catatan);
    }

    public function update(Request $request, Catatan $Catatan)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'tgl_keberangkatan'     => 'required',
            'waktu_keberangkatan'   => 'required',
            'waktu_perjalanan'   => 'required',
            'tujuan'   => 'required',
            'tlp'   => 'required',
            'rating'   => 'required',
            'catatan_user'   => 'required',
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $Catatan->update([
            'tgl_keberangkatan'     => $request-> tgl_keberangkatan,
            'waktu_keberangkatan'     => $request-> waktu_keberangkatan,
            'waktu_perjalanan'   => $request-> waktu_perjalanan,
            'tujuan'   => $request->tujuan,
            'tlp'   => $request->tlp,
            'rating'   => $request->rating,
            'catatan_user'   => $request->catatan_user,
        ]);

        //return response
        return new CatatanResource(true, 'Data Catatan Perjalanan Berhasil Diubah!', $Catatan);
    }

    public function destroy(Catatan $Catatan)
    {

        //delete Rencana
        $Catatan->delete();

        //return response
        return new CatatanResource(true, 'Data Catatan Perjalanan Berhasil Dihapus!', null);
    }
}
