<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Foto;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; 
use Intervention\Image\Encoders\WebpEncoder;

class fotoController extends Controller
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
            // PERBAIKAN: Ubah 'judul' menjadi 'album_fotos'
            'judul_id' => 'required|exists:album_fotos,id', 
            'foto'     => 'required|array',
            'foto.*'   => 'image|mimes:png,jpg,jpeg,webp|max:2048',
        ]);

        try {
            if ($request->hasFile('foto')) {
                $manager = ImageManager::usingDriver(Driver::class);

                foreach ($request->file('foto') as $file) {
                    $filename = time() . '_' . uniqid() . '.webp';
                    
                    $img = $manager->decode(file_get_contents($file->getRealPath()));
                    $img->scaleDown(width: 1200); 
                    $encoded = $img->encode(new WebpEncoder(quality: 80));

                    $path = "uploads/fotos/{$filename}";
                    Storage::disk('public')->put($path, (string) $encoded);
                    
                    Foto::create([
                        'judul_id'  => $request->judul_id,
                        'foto'      => $path,
                        'is_active' => 1,
                    ]);
                }
            }

            return redirect()->route('admin.foto')->with('addSuccess', 'Data berhasil ditambah!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.foto')->with('addGagal', 'Data gagal ditambah!');
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
