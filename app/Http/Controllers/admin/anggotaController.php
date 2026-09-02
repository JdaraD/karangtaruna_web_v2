<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\anggota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Intervention\Image\ImageManager;

class anggotaController extends Controller
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
            'nama' => 'required',
            'image' => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'jabatan' => 'required',
            'tempat_lahir' => 'required',
            'alamat' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
        ]);

        try {
            $path = null;

            // Proses gambar hanya jika ada file yang diupload
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filename = time() . '_' . uniqid() . '.webp';

                $manager = ImageManager::usingDriver(Driver::class);

                $image = $manager->decode(
                    file_get_contents($file->getRealPath())
                );

                // Resize dengan mempertahankan aspect ratio
                $image->scaleDown(
                    height: 192,
                    width: 152
                );

                // Encode menjadi WebP quality 80
                $encoded = $image->encodeUsingFormat(
                    Format::WEBP,
                    quality: 80
                );

                // Disimpan di folder uploads/anggota
                $path = "uploads/anggota/{$filename}";

                Storage::disk('public')->put(
                    $path,
                    $encoded
                );
            }

            // Simpan ke database
            anggota::create([
                'nama'         => $request->nama,
                'jabatan'      => $request->jabatan,
                'tempat_lahir' => $request->tempat_lahir,
                'alamat'       => $request->alamat,
                'no_telp'      => $request->no_telp,
                'email'        => $request->email,
                'image'        => $path, // Akan berisi path gambar atau null
                // 'is_active' => 1 // Tidak perlu ditulis, karena di blueprint sudah default(1)
            ]);

            return redirect()->route('admin.struktur')->with('addSuccess', 'Data berhasil ditambah!');
        } catch (\Throwable $th) {
            // return redirect()->route('admin.struktur')->with('addGagal', 'Data gagal ditambah!');
            dd($th->getMessage());
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
