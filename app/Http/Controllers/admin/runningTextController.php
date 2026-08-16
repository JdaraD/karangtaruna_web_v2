<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\runningText;
use Illuminate\Http\Request;

class runningTextController extends Controller
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
            'judul' => 'required',
            'text' => 'required'
        ]);

        try {
            RunningText::create([
                'judul' => $request->judul,
                'text' => $request->text
            ]);
            
            return redirect()->route('admin.running-text')->with('success', 'Data berhasil ditambahkan!');
            } catch (\Throwable $th) {
                return redirect()->route('admin.running-text')->with('gagal', 'Data gagal ditambahkan!');
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
