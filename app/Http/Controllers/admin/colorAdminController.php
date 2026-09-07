<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\colorAdmin;
use Illuminate\Http\Request;

class colorAdminController extends Controller
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
            'warna_sidebar' => 'required|string',
            'warna_main' => 'required|string',
        ]);

        try {
            // 2. Tambahkan query() agar linter editor mengenali method Eloquent
            $colorAdmin = colorAdmin::query()->first();
    
            if ($colorAdmin) {
                // Linter sekarang akan mengenali update()
                $colorAdmin->update($validatedData);
            } else {
                // Jika belum ada, set is_active = true, lalu buat baru (create)
                $validatedData['is_active'] = true;
                colorAdmin::query()->create($validatedData);
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
