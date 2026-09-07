<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\colorWeb;
use Illuminate\Http\Request;

class colorWebController extends Controller
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
        // 1. Validasi input dari form
        $validatedData = $request->validate([
            'warna_header' => 'required|string',
            'warna_runningText' => 'required|string',
            'warna_footer' => 'required|string',
        ]);

        try {
            // 2. Tambahkan query() agar linter editor mengenali method Eloquent
            $colorWeb = colorWeb::query()->first();
    
            if ($colorWeb) {
                // Linter sekarang akan mengenali update() karena berasal dari object builder
                $colorWeb->update($validatedData);
            } else {
                $validatedData['is_active'] = true;
                colorWeb::query()->create($validatedData);
            }
    
            return redirect()->route('admin.settings')->with('success', 'Data Berhasil Disimpan!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.settings')->with('gagal', 'Data Gagal Disimpan!' );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
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
