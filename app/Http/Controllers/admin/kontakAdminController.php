<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\kontakAdmin;
use Illuminate\Http\Request;

class kontakAdminController extends Controller
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
            'name' => 'required',
            'gmail' => 'required|email',
            'no_hp' => 'required|max:20',
        ]);

        try {
            kontakAdmin::create([
                'name' => $request->name,
                'gmail' => $request->gmail,
                'no_hp' => $request->no_hp,
            ]);

            return redirect()->route('admin.kontak')->with('addSuccess', 'Data berhasil ditambah!');
            } catch(\Throwable $th) {
                return redirect()->route('admin.kontak')->with('addGagal', 'Data gagal ditambah!');
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
