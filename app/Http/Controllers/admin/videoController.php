<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\video;
use Illuminate\Http\Request;

class videoController extends Controller
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
            'judul_video'     => 'required|string|max:255',
            'album_video_id'  => 'required', // Pastikan ID album valid
            'link_video'      => 'required|url',
            'deskripsi_video' => 'required|string',
        ]);

        try {
            video::create([
                'judul_video'     => $request->judul_video,
                'album_video_id'  => $request->album_video_id,
                'link_video'      => $request->link_video,
                'deskripsi_video' => $request->deskripsi_video,
                'is_active'       => 1, // Default aktif
            ]);

            return redirect()->route('admin.video')->with('addSuccess', 'Data berhasil ditambah!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.video')->with('addGagal', 'Data gagal ditambah!');
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
