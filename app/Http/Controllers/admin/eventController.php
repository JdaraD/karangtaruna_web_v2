<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; 
use Intervention\Image\Encoders\WebpEncoder;

class eventController extends Controller
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
            'judul'     => 'required|string|max:255',
            'gambar'    => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
            'deskripsi' => 'required|string',
            'tanggal'   => 'required|date',
        ]);

        try {
            $path = null;

            if ($request->hasFile('gambar')) {
                $file = $request->file('gambar');
                $filename = time() . '_' . uniqid() . '.webp';

                $manager = ImageManager::usingDriver(Driver::class);
                $img = $manager->decode(file_get_contents($file->getRealPath()));
                
                // Resize sesuai kebutuhan (misal tinggi 320 menyesuaikan pesan di form)
                $img->scaleDown(height: 320);
                $encoded = $img->encode(new WebpEncoder(quality: 80));

                $path = "uploads/events/{$filename}";
                Storage::disk('public')->put($path, (string) $encoded);
            }

            Event::create([
                'judul'     => $request->judul,
                'gambar'    => $path,
                'deskripsi' => $request->deskripsi,
                'tanggal'   => $request->tanggal,
            ]);

            return redirect()->route('admin.event')->with('addSuccess', 'Data berhasil ditambah!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.event')->with('addGagal', 'Data gagal ditambah!');
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
