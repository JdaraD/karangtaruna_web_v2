<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\pasal;
use Illuminate\Http\Request;

class pasalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'isi_pasal' => 'required'
        ]);

        try {
            pasal::create([
                'isi_pasal' => $request->isi_pasal
            ]);

            return redirect()->route('admin.legal')->with('addSuccess', 'Data Berhasil Ditambah!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.legal')->with('addGagal', 'Data Gagal Ditambah!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
