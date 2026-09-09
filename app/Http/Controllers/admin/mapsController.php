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
        $iframeInput = $request->link_maps;

            // Otomatis mengganti width dan height bawaan Google Maps menjadi 100%
            $iframeInput = preg_replace('/width="[^"]+"/', 'width="100%"', $iframeInput);
            $iframeInput = preg_replace('/height="[^"]+"/', 'height="100%"', $iframeInput);

        try {
            map::updateOrCreate(
                ['id' => 1],
                [
                    'link_maps' => $iframeInput,
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
