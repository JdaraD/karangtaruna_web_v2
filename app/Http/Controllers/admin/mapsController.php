<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\map;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class mapsController extends Controller
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
                'link_maps' => 'required', // Bisa diubah menjadi 'string' karena inputnya berupa tag iframe atau URL
            ]);

        try {
            map::updateOrCreate(
                ['id' => 1],
                [
                    'link_maps' => $request->link_maps, // Menyimpan tag iframe lengkap atau link embed
                ]
            );

            return redirect()->back()->with('success', 'Link Maps berhasil disimpan!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('gagal', 'Link Maps gagal disimpan!'. $th->getMessage());
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
