<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\kolaborasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

class kolaborasiController extends Controller
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
            'nama_kolaborasi'       => 'required|string|max:255',
            'wilayah_kolaborasi_id' => 'required',
            'image'                 => 'required|array', // Sesuai dengan name="image[]"
            'image.*'               => 'image|mimes:png,jpg,jpeg,webp|max:2048',
            'deskripsi_kolaborasi'  => 'required|string',
            'tanggal_mulai'         => 'required|date',
            'tanggal_selesai'       => 'required|date|after_or_equal:tanggal_mulai', // Validasi tgl selesai harus setelah/sama dengan tgl mulai
        ]);

        try {
            $imagePaths = [];

            if ($request->hasFile('image')) {
                $manager = ImageManager::usingDriver(Driver::class);

                foreach ($request->file('image') as $file) {
                    $filename = time() . '_' . uniqid() . '.webp';
                    
                    $img = $manager->decode(file_get_contents($file->getRealPath()));
                    $img->scaleDown(width: 800);
                    $encoded = $img->encode(new WebpEncoder(quality: 80));

                    $path = "uploads/kolaborasi/{$filename}";
                    Storage::disk('public')->put($path, (string) $encoded);
                    
                    $imagePaths[] = $path;
                }
            }

            kolaborasi::create([
                'nama_kolaborasi'       => $request->nama_kolaborasi,
                'wilayah_kolaborasi_id' => $request->wilayah_kolaborasi_id,
                'image'                 => json_encode($imagePaths),
                'deskripsi_kolaborasi'  => $request->deskripsi_kolaborasi,
                'tanggal_mulai'         => $request->tanggal_mulai,
                'tanggal_selesai'       => $request->tanggal_selesai,
            ]);

            return redirect()->route('admin.kolaborasi')->with('addSuccess', 'Data berhasil ditambah!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.kolaborasi')->with('addGagal', 'Data gagal ditambah!');
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
