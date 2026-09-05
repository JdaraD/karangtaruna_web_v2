<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; 
use Intervention\Image\Encoders\WebpEncoder;

class kegiatanController extends Controller
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
                
                // Resize mengikuti saran di form Anda (tinggi 320)
                $img->scaleDown(height: 320);
                $encoded = $img->encode(new WebpEncoder(quality: 80));

                $path = "uploads/kegiatan/{$filename}";
                Storage::disk('public')->put($path, (string) $encoded);
            }

            kegiatan::create([
                'judul'     => $request->judul,
                'gambar'    => $path,
                'deskripsi' => $request->deskripsi,
                'tanggal'   => $request->tanggal,
            ]);

            return redirect()->route('admin.kegiatan')->with('addSuccess', 'Data berhasil ditambah!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.kegiatan')->with('addGagal', 'Data gagal ditambah!');
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
