<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dealer;
use App\Models\JabatanModel;
use App\Models\Kota;
use App\Models\Sales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminSalesController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    $data = Sales::orderBy('id', 'desc')->get();
    $jabatans = JabatanModel::all();
    $dealers = Dealer::all();
    return view('admin.sales.index', [
      'sales' => $data,
      'jabatans' => $jabatans,
      'dealers' => $dealers
    ]);
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

    // dd($request->active);
    // dd(isset($request->active));

    $validator = Validator::make($request->all(), [
      'nama' => 'required',
      'kode' => 'required',
      'username' => 'required',
      'password' => 'required',
      'jabatan' => 'required',
      'nomor' => 'required',
      'slogan' => 'required',
      'dealer' => 'required',
      'urutan' => 'required',
      'foto' => 'nullable',
      // 'active' => 'required',
    ]);


    // dd($request->all());

    if ($validator->fails()) {
      flash()->addError($validator->errors()->first());
      return redirect()->back()->withInput();
    }

    $usernameLower = strtolower($request->input('username'));
    $nipLower = strtolower($request->input('kode'));

    // Check for uniqueness of 'username' and 'nip' using a single query (case-insensitive)
    $existingSales = Sales::whereRaw('LOWER(username) = ?', [$usernameLower])
      ->orWhereRaw('LOWER(nip) = ?', [$nipLower])
      ->first();

    if ($existingSales) {
      flash()->addError('Username atau NIP sudah digunakan!.');
      return redirect()->back()->withInput();
    }

    // Validasi Urutan Unik per Jabatan
    $existingSales = Sales::where('id_jabatan', $request->jabatan)
      ->where('urutan', $request->urutan)
      ->exists();

    if ($existingSales) {
      flash()->addError('Urutan sudah digunakan untuk jabatan ini.');
      return redirect()->back()->withInput();
    }

    // Penanganan Unggah File Gambar
    $imagePath = 'default.png';
    if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
      $file = $request->file('foto');
      $request->validate([
        'foto' => 'image|mimes:jpeg,png,jpg,gif',
      ]);
      $filename = uniqid() . '.' . $file->getClientOriginalExtension(); // Nama unik
      $file->storeAs('public/sales', $filename);
      $imagePath = $filename;
    }

    try {
      Sales::create([
        'nama' => $request->input('nama'),
        'nip' => $request->input('kode'),
        'username' => $request->input('username'),
        'password' => Hash::make($request->input('password')),
        'jabatan' => $request->jabatan,
        'nomor' => $request->nomor,
        'slogan' => $request->slogan,
        'id_dealer' => $request->dealer,
        'urutan' => $request->urutan,
        'path_image' => $imagePath,
        'active' => isset($request->active) && $request->active != null,
      ]);

      flash()->addSuccess("Sales $request->nama berhasil dibuat");
      return redirect()->back();
    } catch (\Throwable $th) {
      Log::error($th); // Log kesalahan untuk debugging
      flash()->addError("Gagal membuat data, pastikan sudah benar!");
      return redirect()->back()->withInput();
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
    $validator = Validator::make($request->all(), [
      'nama' => 'required',
      'kode' => 'required',
      'username' => 'required',
      'jabatan' => 'required',
      'nomor' => 'required',
      'slogan' => 'required',
      'urutan' => 'required',
      'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif', // Validasi file gambar
      // Tambahkan validasi lain sesuai kebutuhan
    ]);

    if ($validator->fails()) {
      flash()->addError($validator->errors()->first()); // Tampilkan pesan error spesifik
      return redirect()->back()->withInput();
    }

    $sales = Sales::findOrFail($id);

    // Validasi Urutan Unik per Jabatan (pastikan tidak sama dengan data lain yang memiliki jabatan yang sama)
    $existingSales = Sales::where('id_jabatan', $request->jabatan)
      ->where('urutan', $request->urutan)
      ->where('id', '!=', $id) // Kecualikan data yang sedang diupdate
      ->exists();

    if ($existingSales) {
      flash()->addError('Urutan sudah digunakan untuk jabatan ini.');
      return redirect()->back()->withInput();
    }

    // Penanganan Unggah File Gambar
    if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
      $file = $request->file('foto');
      $filename = uniqid() . '.' . $file->getClientOriginalExtension();
      $file->storeAs('public/sales', $filename);
      // Jika ada gambar lama, hapus terlebih dahulu (opsional)
      if ($sales->path_image != 'default.png') {
        Storage::delete('public/sales/' . $sales->path_image);
      }
      $sales->path_image = $filename;
    }

    // Update data sales lainnya
    $sales->nama = $request->nama;
    $sales->nip = $request->kode;
    $sales->username = $request->username;
    if ($request->filled('password')) { // Perbarui password jika diisi
      $sales->password = Hash::make($request->input('password'));
    }
    $sales->id_jabatan = $request->jabatan;
    $sales->nomor = $request->nomor;
    $sales->slogan = $request->slogan;
    $sales->id_dealer = $request->dealer;
    $sales->urutan = $request->urutan;
    $sales->active = isset($request->active) && $request->active != null;

    try {
      $sales->save();
      flash()->addSuccess("Sales $sales->nama berhasil diperbarui");
    } catch (\Throwable $th) {
      Log::error($th);
      flash()->addError("Gagal memperbarui data, pastikan sudah benar!");
    }

    return redirect()->back();
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
      $type = Sales::findOrFail($id);
      $type->delete();
      flash()->addSuccess("Berhasil menghapus data!");
      return redirect()->back();
    } catch (\Throwable $th) {
      flash()->addError("$type->name tidak bisa dihapus karena data digunakan oleh data lain!");
      return redirect()->back();
    }
  }
}
