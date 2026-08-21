<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Intervention\Image\ImageManager;

class NewsController extends Controller
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
            'image' => 'required|mimes:png,jpg,jpeg,webp|image|max:2048',
            'isi_berita' => 'required',
            'tanggal_publish' => 'required'
        ]);

        try {
            $file = $request->file('image');

            $filename = time(). '_' . uniqid(). '.webp';

            $manager = ImageManager::usingDriver(Driver::class);

            $image = $manager->decode(
                file_get_contents($file->getRealPath())
            );

            // Resize dengan mempertahankan aspect ratio
            $image->scaleDown(
                width: 520,
                height: 320
            );

            // Encode menjadi WebP quality 80
            $encoded = $image->encodeUsingFormat(
                Format::WEBP,
                quality: 80
            );

            $path = "uploads/news/{$filename}";

            Storage::disk('public')->put(
                $path,
                $encoded
            );

            News::create([
                'name' => $request->name,
                'image' => $path,
                'isi_berita' => $request->isi_berita,
                'tanggal_publish' => $request->tanggal_publish
            ]);

            return redirect()->route('admin.news')->with('addSuccess', 'Data berhasil ditambah!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.news')->with('addGagal', 'Data gagal ditambah!');
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
