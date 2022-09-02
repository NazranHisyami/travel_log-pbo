<?php

namespace App\Http\Controllers\Api;

use App\Models\Rencana;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\RencanaResource;
use Illuminate\Support\Facades\Validator;

class RencanaController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        //get data from table posts
        $rencanas = Rencana::latest()->get();

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'List Data rencana',
            'data'    => $rencanas  
        ], 200);

    }
    
     /**
     * show
     *
     * @param  mixed $id
     * @return void
     */
    public function show($id)
    {
        //find post by ID
        $rencana = Rencana::findOrfail($id);

        //make response JSON
        return response()->json([
            'success' => true,
            'message' => 'Detail Data rencana',
            'data'    => $rencana 
        ], 200);

    }
    
    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'tgl_keberangkatan'   => 'required',
            'waktu_keberangkatan' => 'required',
            'waktu_perjalanan'    => 'required',
            'tujuan'              => 'required',
            'tlp'                 => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //save to database
        $rencana = Rencana::create([
            'tgl_keberangkatan'   => $request->tgl_keberangkatan,
            'waktu_keberangkatan' => $request->waktu_keberangkatan,
            'waktu_perjalanan'    => $request->waktu_perjalanan,
            'tujuan'              => $request->tujuan,
            'tlp'                 => $request->tlp
        ]);

        //success save to database
        if($rencana) {

            return response()->json([
                'success' => true,
                'message' => 'rencana Created',
                'data'    => $rencana  
            ], 201);

        } 

        //failed save to database
        return response()->json([
            'success' => false,
            'message' => 'rencana Failed to Save',
        ], 409);

    }
    
    /**
     * update
     *
     * @param  mixed $request
     * @param  mixed $rencana
     * @return void
     */
    public function update(Request $request, Rencana $rencana)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'tgl_keberangkatan'   => 'required',
            'waktu_keberangkatan' => 'required',
            'waktu_perjalanan'    => 'required',
            'tujuan'              => 'required',
            'tlp'                 => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find post by ID
        $rencana = Rencana::findOrFail($rencana->id);

        if($rencana) {

            //update rencana
            $rencana->update([
                'tgl_keberangkatan'   => $request->tgl_keberangkatan,
                'waktu_keberangkatan' => $request->waktu_keberangkatan,
                'waktu_perjalanan'    => $request->waktu_perjalanan,
                'tujuan'              => $request->tujuan,
                'tlp'                 => $request->tlp
            ]);

            return response()->json([
                'success' => true,
                'message' => 'rencana Updated',
                'data'    => $rencana  
            ], 200);

        }

        //data rencana not found
        return response()->json([
            'success' => false,
            'message' => 'rencana Not Found',
        ], 404);

    }
    
    /**
     * destroy
     *
     * @param  mixed $id
     * @return void
     */
    public function destroy($id)
    {
        //find post by ID
        $rencana = Rencana::findOrfail($id);

        if($rencana) {

            //delete rencana
            $rencana->delete();

            return response()->json([
                'success' => true,
                'message' => 'rencana Deleted',
            ], 200);

        }

        //data post not found
        return response()->json([
            'success' => false,
            'message' => 'rencana Not Found',
        ], 404);
    }
}
