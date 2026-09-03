<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

class productController extends Controller
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
            'nama_produk'       => 'required|string|max:255',
            'kategori_usaha_id' => 'required|exists:kategori_usahas,id', // pastikan nama tabel kategori benar
            'gambar'            => 'required|array',
            'gambar.*'          => 'image|mimes:png,jpg,jpeg,webp|max:2048',
            'deskripsi'         => 'required|string',
            'harga'             => 'required|integer|min:0',
            'link_pembelian'    => 'nullable|url'
        ]);

        try {
            $imagePaths = [];

            // Looping semua gambar yang diupload
            if ($request->hasFile('gambar')) {
                $manager = ImageManager::usingDriver(Driver::class);

                foreach ($request->file('gambar') as $file) {
                    $filename = time() . '_' . uniqid() . '.webp';
                    
                    $img = $manager->decode(file_get_contents($file->getRealPath()));
                    $img->scaleDown(width: 800); // Sesuaikan ukuran scaleDown
                    $encoded = $img->encode(new WebpEncoder(quality: 80));

                    $path = "uploads/products/{$filename}";
                    Storage::disk('public')->put($path, (string) $encoded);
                    
                    // Masukkan path ke dalam array
                    $imagePaths[] = $path;
                }
            }

            product::create([
                'nama_produk'       => $request->nama_produk,
                'kategori_usaha_id' => $request->kategori_usaha_id,
                'gambar'            => json_encode($imagePaths), // Simpan array sebagai string JSON
                'deskripsi'         => $request->deskripsi,
                'harga'             => $request->harga,
                'link-pembelian'    => $request->link_pembelian,
            ]);

            return redirect()->back()->with('addSuccess', 'Data produk berhasil ditambah!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('addGagal', 'Data gagal ditambah! ' . $th->getMessage());
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
