<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("siswa.index", [
            'data' => Siswa::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("siswa.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "nama" => "required|max:50",
            "kelas" => "required"
        ]);

        Siswa::create($request->all());

        return redirect()->route("siswa.index")->with("success", $request->nama . " ditambahkan");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view("siswa.update", [
            "siswa" => Siswa::findOrFail($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Aspian btw
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $siswa = Siswa::findOrFail($id);

        $validated = $request->validate([
            "nama" => "required|max:50",
            "kelas" => "required"
        ]);

        $siswa->update($validated);

        return redirect()->route("siswa.index")->with("success", $siswa->nama . " berhasil diubah");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();
        return redirect()->route("siswa.index")->with("success", $siswa->nama . " berhasil dihapus.");
    }
}
