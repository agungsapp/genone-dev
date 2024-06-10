<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JabatanModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {

        $data = [
            'jabatans' => JabatanModel::all()
        ];

        return view('admin.jabatan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['nama' => 'required']);

        try {
            $jabatan = JabatanModel::create([
                'nama' => $request->nama,
            ]);

            flash()->addSuccess("Data jabatan $jabatan->nama berhasil dibuat");
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            flash()->addError("Gagal , Terjadi kesalahan pada server !");
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(['nama_edit' => 'required']);

        try {
            $jabatan = JabatanModel::findOrFail($id);
            $jabatan->nama = $request->nama_edit;
            $jabatan->save();
            flash()->addSuccess("Data jabatan $jabatan->nama berhasil di update !");
            return redirect()->back();
        } catch (\Throwable $th) {
            //throw $th;
            flash()->addError("Gagal update , Terjadi kesalahan pada server !");
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $jabatan = JabatanModel::findOrFail($id);
            $jabatan->delete();
            return response()->json([
                'success' => true,
                'message' => 'Data berhasil dihapus',
            ]);
        } catch (\Throwable $th) {
            Log::error("ERROR DELETE DATA JABATAN ADMIN " . $th->getMessage());
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Terjadi kesalahan saat menghapus data',
                ],
                500
            ); // Status code 500 untuk server error
        }
    }
}
