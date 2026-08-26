<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\misi;
use Illuminate\Http\Request;

class misiController extends Controller
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
            'isi_misi' => 'required'
        ]);

        try {
            misi::create([
                'isi_misi' => $request->isi_misi
            ]);

            return redirect()->route('admin.about-us')->with('addSuccess', 'Data berhasil ditambah!');
            } catch (\Throwable $th) {
            return redirect()->route('admin.about-us')->with('addGagal', 'Data berhasil ditambah!');
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
