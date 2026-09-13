<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\alamat;
use Illuminate\Http\Request;

class alamatController extends Controller
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
            'alamat' => 'required',
        ]);

        try {
            alamat::create([
                'alamat' => $request->name,
            ]);

            return redirect()->route('admin.alamat')->with('addSuccess', 'Data berhasil ditambah!');
            } catch(\Throwable $th) {
                return redirect()->route('admin.alamat')->with('addGagal', 'Data gagal ditambah!');
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
