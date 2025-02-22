<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("barang.index", ["barang"=> Barang::all()]);
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
        $validate = $request->validate([
            "nama" => "required|string|max:255",
            "harga" => "required|integer",
            "deskripsi" => "string",
            "stok" => "required|integer",
            "kategori" => "string|max:255",
        ]);

        Barang::create($validate);
        return redirect()->route("barang.index")->with("success","Berhasil menambahkan data baru!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Barang::all()->find($id)->update($request->validate([
            "nama" => "required|string|max:255",
            "harga" => "required|integer",
            "deskripsi" => "string",
            "stok" => "required|integer",
            "kategori" => "string|max:255",
        ]));

        return redirect()->route("barang.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Barang::all()->find($id)->delete();
        return redirect()->route("barang.index");
    }
}
