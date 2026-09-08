<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Format;
use Intervention\Image\ImageManager;

class sponsorController extends Controller
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
        ]);

        try {
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.webp';

            $manager = ImageManager::usingDriver(Driver::class);
            $image = $manager->decode(
                file_get_contents($file->getRealPath())
            );

            $image->scaleDown(
                width: 112,
                height: 96
            );

            $encoded = $image->encodeUsingFormat(
                Format::WEBP,
                quality: 80
            );

            // Sesuaikan folder penyimpanan untuk sponsor
            $path = "uploads/sponsors/{$filename}";

            Storage::disk('public')->put(
                $path,
                $encoded
            );

            Sponsor::create([
                'name' => $request->name,
                'image' => $path,
            ]);

            return redirect()->route('admin.sponsor')->with('addSuccess', 'Data berhasil ditambah!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.sponsor')->with('addGagal', 'Data gagal ditambah!');
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
