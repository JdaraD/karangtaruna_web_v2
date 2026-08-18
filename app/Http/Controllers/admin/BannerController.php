<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
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
            'image' => 'required|image|mimes:png,jpg,jpeg,webp|max:2048',
            'tanggal_publish' => 'required|date'
        ]);

        try {
            $file = $request->file('image');

            $filename = time() . '_' . uniqid() . '.webp';

            $manager = ImageManager::usingDriver(Driver::class);

            $image = $manager->decode(
                file_get_contents($file->getRealPath())
            );

            // Resize dengan mempertahankan aspect ratio
            $image->scaleDown(
                width: 2800,
                height: 900
            );

            // Encode menjadi WebP quality 80
            $encoded = $image->encodeUsingFormat(
                Format::WEBP,
                quality: 80
            );

            $path = "uploads/banner/{$filename}";

            Storage::disk('public')->put(
                $path,
                $encoded
            );

            Banner::create([
                'name' => $request->name,
                'image' => $path,
                'tanggal_publish' => $request->tanggal_publish,
            ]);
            return redirect()->route('admin.banner')->with('addSuccess', 'Data berhasil ditambah!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.banner')->with('addGagal', 'Data gagal ditambah!');
            // dd($th->getMessage());
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
