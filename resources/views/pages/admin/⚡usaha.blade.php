<?php

use Livewire\Component;
use App\Models\kategoriUsaha;
use App\Models\product;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

new class extends Component
{
    use WithFileUploads;

    public $nama_kategori, $kategori, $kategori_id, $nama_produk, $kategori_usaha_id, $deskripsi, $harga, $link_pembelian, $products;
    public $productId;
    public $gambar = []; // Untuk gambar baru (berupa array)
    public $currentGambar = []; // Untuk menampilkan gambar lama

    public $overlayAddKategori = false;
    public $overlayEditKategori = false;
    public $overlayAddProduct = false;
    public $overlayEditProduct = false;

    public $editSuccess;
    public $editGagal;
    public $deleteSuccess;
    public $deleteGagal;

    // load data
    public function loadKategori()
    {
        $this->kategori = KategoriUsaha::all();
    }

    public function loadProducts()
    {
        $this->products = product::all();
    }
    // load data

    // function mount
    public function mount()
    {
        $this->loadKategori();
        $this->loadProducts();
    }
    // function mount

    // function Button
    public function btnOpenAddKategori()
    {
        $this->overlayAddKategori = true;
    }
    
    public function btnCloseKategori()
    {
        $this->overlayAddKategori = false;
    }

    public function btnOpenEditKategori($id)
    {
        $kategori = KategoriUsaha::findOrFail($id);

        $this->kategori_id = $kategori->id;
        $this->nama_kategori = $kategori->nama_kategori;

        $this->overlayEditKategori = true;
    }

    public function btnCloseEditKategori()
    {
        $this->overlayEditKategori = false;
        $this->reset(['nama_kategori', 'kategori_id']);
    }

    public function btnOpenAddProduct()
    {
        $this->overlayAddProduct = true;
    }

    public function btnCloseProduct()
    {
        $this->overlayAddProduct = false;
    }

    public function btnOpenEditProduct($id)
    {
        $product = Product::findOrFail($id);
        
        $this->productId = $product->id;
        $this->nama_produk = $product->nama_produk;
        $this->kategori_usaha_id = $product->kategori_usaha_id;
        $this->deskripsi = $product->deskripsi;
        $this->harga = $product->harga;
        // Karena di fillable menggunakan tanda strip '-', kita panggilnya seperti ini:
        $this->link_pembelian = $product->{'link-pembelian'}; 
        
        // Decode JSON gambar menjadi array
        $this->currentGambar = $product->gambar ? json_decode($product->gambar, true) : [];
        $this->gambar = []; // Reset input file baru

        $this->overlayEditProduct = true;
    }

    public function btnCloseEditProduct()
    {
        $this->overlayEditProduct = false;
        $this->reset([
            'productId', 
            'nama_produk', 
            'kategori_usaha_id', 
            'deskripsi', 
            'harga', 
            'link_pembelian', 
            'currentGambar', 
            'gambar']);
    }
    // function Button

    // add function
    // add function

    // update function
    public function updateKategori()
    {
        $this->validate([
            'nama_kategori' => 'required|string|max:255',
        ]);

        try {
            $kategori = KategoriUsaha::findOrFail($this->kategori_id);

            $kategori->update([
                'nama_kategori' => $this->nama_kategori,
            ]);

            $this->loadKategori();
            $this->overlayEditKategori = false;
            
            $this->editSuccess = 'Data Berhasil Diedit!';
            $this->editGagal = '';
        } catch (\Throwable $th) {
            $this->editGagal = 'Data Gagal Diedit!';
            $this->editSuccess = '';
        }
    }

    public function updateProduct()
    {
        $rules = [
            'nama_produk'       => 'required|string|max:255',
            'kategori_usaha_id' => 'required',
            'deskripsi'         => 'required|string',
            'harga'             => 'required|numeric',
        ];

        // Validasi jika ada upload gambar baru
        if (!empty($this->gambar)) {
            $rules['gambar.*'] = 'image|mimes:png,jpg,jpeg,webp|max:2048';
        }

        $this->validate($rules);

        try {
            $product = Product::findOrFail($this->productId);

            $dataToUpdate = [
                'nama_produk'       => $this->nama_produk,
                'kategori_usaha_id' => $this->kategori_usaha_id,
                'deskripsi'         => $this->deskripsi,
                'harga'             => $this->harga,
                'link-pembelian'    => $this->link_pembelian,
            ];

            // JIKA ADA GAMBAR BARU YANG DIUNGGAH (Ganti gambar lama)
            if (!empty($this->gambar)) {
                $imagePaths = [];
                $manager = ImageManager::usingDriver(Driver::class);

                foreach ($this->gambar as $file) {
                    $filename = time() . '_' . uniqid() . '.webp';
                    
                    $img = $manager->decode(file_get_contents($file->getRealPath()));
                    $img->scaleDown(width: 800);
                    $encoded = $img->encode(new WebpEncoder(quality: 80));

                    $path = "uploads/products/{$filename}";
                    Storage::disk('public')->put($path, (string) $encoded);
                    
                    $imagePaths[] = $path;
                }

                // Hapus semua gambar lama dari storage
                if (is_array($this->currentGambar)) {
                    foreach ($this->currentGambar as $oldImage) {
                        if (Storage::disk('public')->exists($oldImage)) {
                            Storage::disk('public')->delete($oldImage);
                        }
                    }
                }

                // Masukkan array gambar baru menjadi JSON string
                $dataToUpdate['gambar'] = json_encode($imagePaths);
            }

            $product->update($dataToUpdate);

            $this->btnCloseEditProduct();
            $this->editSuccess = 'Data Berhasil Diedit!';
            $this->editGagal = '';
        } catch (\Throwable $th) {
            $this->editGagal = 'Data Gagal Diedit!';
            $this->editSuccess = '';
        }
    }
    // update function

    // delete function
    public function btnDeleteKategori($id)
    {
        try {
            $kategori = KategoriUsaha::findOrFail($id);
            $kategori->delete();

            $this->loadKategori();
            $this->deleteSuccess = 'Data Berhasil Dihapus!';
            $this->deleteGagal = '';
        } catch (\Throwable $th) {
            $this->deleteGagal = 'Data Gagal Dihapus!';
            $this->deleteSuccess = '';
        }
    }

    public function deleteProduct($id)
    {
        try {
            $product = Product::findOrFail($id);

            // Decode gambar dan hapus satu per satu dari storage
            $images = $product->gambar ? json_decode($product->gambar, true) : [];
            
            if (is_array($images)) {
                foreach ($images as $img) {
                    if (Storage::disk('public')->exists($img)) {
                        Storage::disk('public')->delete($img);
                    }
                }
            }

            $product->delete();
            $this->deleteSuccess = 'Data Berhasil Dihapus!';
            $this->deleteGagal = '';
        } catch (\Throwable $th) {
            $this->deleteGagal = 'Data Gagal Dihapus!';
            $this->deleteSuccess = '';
        }
    }
    // delete function
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.admin', [
                'title' => 'Usaha Mandiri'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    <article class="flex flex-none gap-2 items-center">
        <x-gmdi-business-center class="h-6 w-6" />
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Usaha Mandiri</h1>
    </article>

    <article class="flex flex-wrap w-full gap-4 items-center">
        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-auto p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Kategori Usaha</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <button type="button" wire:click="btnOpenAddKategori" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </button>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 w-full max-h-40 gap-2 overflow-y-auto scrollbar-none">
                @foreach ($kategori as $ka)
                    <div class="flex flex-col w-full h-auto gap-2 p-2 bg-[#9CB080] rounded-md shadow-md hover:scale-101 duration-120 ease-in-out transition-transform">
                        <div class="flex w-full h-full gap-1 p-1 justify-between items-center bg-[#618764]/40 rounded-md">
                            <p class="text-base font-semibold capitalize">{{ $ka->nama_kategori }}</p>
                            <div class="flex gap-1">
                                <button type="button" wire:click="btnOpenEditKategori({{ $ka->id }})" class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                                    <x-bi-pencil class="h-4 w-4 text-white"/>
                                </button>
                                <button type="button" wire:click="btnDeleteKategori({{ $ka->id }})" class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                                    <x-bi-trash class="h-4 w-4 text-white"/>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-auto p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <h1 class="font-semibold text-base text-black capitalize">Product Usaha</h1>
                <button type="button" wire:click="btnOpenAddProduct" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah">
                    <x-bi-plus class="h-6 w-6 text-white"/>
                </button>
            </div>

            <!-- Filter (Biarkan jika ingin dinamis, silakan foreach kategori Anda di sini) -->
            <div class="flex w-full h-auto gap-1 items-center overflow-x-auto scrollbar-none">
                @foreach($kategori as $kat)
                    <div class="flex w-auto h-auto gap-1 items-center bg-gray-100 hover:bg-gray-200 rounded-md p-2 cursor-pointer flex-none">
                        <h1 class="font-semibold text-sm text-black capitalize">{{ $kat->nama_kategori }}</h1>
                    </div>
                @endforeach
            </div>

            <!-- Card Grid Dinamis -->
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 w-full 3xl:h-210 lg:h-68 md:h-66 h-64 gap-2 p-2 overflow-y-auto scrollbar-none">
                @foreach ($products as $prod)
                    <div class="flex flex-col w-full h-auto gap-2 p-2 bg-[#9CB080] rounded-md shadow-md hover:scale-102 duration-120 ease-in-out transition-transform">
                        
                        <div class="flex w-full h-[80%]">
                            <!-- Menampilkan gambar pertama dari JSON -->
                            @php
                                $images = $prod->gambar ? json_decode($prod->gambar, true) : [];
                                $firstImage = (is_array($images) && count($images) > 0) ? asset('storage/' . $images[0]) : asset('img/no-image.jpg');
                            @endphp
                            <img src="{{ $firstImage }}" class="w-full h-46 object-cover rounded-md bg-white">
                        </div>

                        <div class="flex w-full h-full gap-1 p-1 justify-between items-center bg-[#618764]/40 rounded-md">
                            <p class="text-base font-semibold capitalize text-white truncate max-w-[60%]">{{ $prod->nama_produk }}</p>
                            
                            <div class="flex gap-1">
                                <!-- Tombol Edit (Kuning) -->
                                <div wire:click="btnOpenEditProduct({{ $prod->id }})" class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Edit">
                                    <x-bi-pencil class="h-4 w-4 text-white"/>
                                </div>
                                
                                <!-- Tombol Hapus (Merah) -> Bisa Anda hubungkan dgn konfirmasi alert dulu jika mau -->
                                <div wire:click="deleteProduct({{ $prod->id }})" class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                                    <x-bi-trash class="h-4 w-4 text-white"/>
                                </div>
                            </div>
                            <p class="text-sm text-yellow-300 font-bold">
                                Rp {{ number_format($prod->harga, 0, ',', '.') }}
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </article>

    {{-- overlay Add Kategori --}}
    @if ($overlayAddKategori)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Tambah Kategori</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button wire:click="btnCloseKategori" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form action="{{ route('admin.kategoriUsaha.store') }}" enctype="multipart/form-data" method="POST" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="nama_kategori" class="text-sm font-semibold text-gray-800">
                                Nama Kategori
                            </label>
    
                            <input type="text" name="nama_kategori" id="nama_kategori" required placeholder="Masukkan Nama Kategori" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                    </div>
    
                    <div class="flex w-full h-full justify-end items-end">
                        <button type="submit" class="flex justify-center items-center p-2 rounded-md bg-green-500 hover:bg-green-700 shadow-md cursor-pointer">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
            
        </article>
        
    @endif
    {{-- overlay Add Kategori --}}

    {{-- overlay Edit Kategori --}}
    @if ($overlayEditKategori)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Edit Kategori</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button type="button" wire:click="btnCloseEditKategori" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="updateKategori" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="nama_kategori" class="text-sm font-semibold text-gray-800">
                                Nama Kategori
                            </label>
    
                            <input type="text" wire:model="nama_kategori" name="nama_kategori" id="nama_kategori" required placeholder="Masukkan Nama Kategori" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                    </div>
    
                    <div class="flex w-full h-full justify-end items-end">
                        <button type="submit" class="flex justify-center items-center p-2 rounded-md bg-green-500 hover:bg-green-700 shadow-md cursor-pointer">
                            Edit
                        </button>
                    </div>
                </form>
            </div>
            
        </article>
        
    @endif
    {{-- overlay Edit Kategori --}}

    {{-- overlay Add Product --}}
    @if ($overlayAddProduct)
        <article class="fixed flex top-0 left-0 items-center justify-center w-full h-full bg-gray-900/60 z-50 p-4">
            <div class="flex flex-col w-full max-w-2xl max-h-[90vh] bg-white rounded-md shadow-xl overflow-hidden">
                
                <div class="flex w-full gap-1 justify-between items-center bg-gray-100 border-b border-gray-200 p-4">
                    <h1 class="font-semibold text-lg text-black capitalize">Tambah Product</h1>
                    <button wire:click="btnCloseProduct" class="rounded-full p-1 bg-red-500 hover:bg-red-700 text-white cursor-pointer">
                        <x-css-close class="w-4 h-4" />
                    </button>
                </div>

                <div class="p-4 overflow-y-auto custom-scrollbar">
                    <form action="{{ route('admin.product.store') }}" enctype="multipart/form-data" method="POST" class="flex flex-col gap-4">
                        @csrf
                        <div class="flex flex-col w-full gap-4">

                            <!-- NAMA PRODUK -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800">Nama</label>
                                <input type="text" name="nama_produk" required placeholder="Masukkan Nama Produk" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500">
                            </div>

                            <!-- SELECT KATEGORI RELASI (DI PERBAIKI) -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800">Kategori</label>
                                <select name="kategori_usaha_id" required class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500">
                                    <option value="" disabled selected>--Pilih Kategori--</option>
                                    <!-- Foreach ada di dalam Select -->
                                    @foreach ($kategori as $ka)
                                        <option value="{{ $ka->id }}" class="text-black">{{ $ka->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- HARGA -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800">Harga</label>
                                <!-- Tambahkan min="0" step="1" -->
                                <input type="number" name="harga" min="0" step="1" required placeholder="Contoh: 50000" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500">
                            </div>

                            <!-- MULTIPLE IMAGE (TAMBAHKAN [] DAN multiple) -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-start gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800 pt-2">Gambar</label>
                                <div class="md:col-span-3">
                                    <input type="file" name="gambar[]" multiple required accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-50 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600">
                                    <p class="mt-1 text-xs text-gray-500">Bisa pilih lebih dari 1 gambar sekaligus. Format: JPG/PNG/WEBP. Maks 2MB/file.</p>
                                </div>
                            </div>

                            <!-- DESKRIPSI -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-start gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800 pt-2">Deskripsi</label>
                                <textarea rows="3" name="deskripsi" required placeholder="Masukkan Deskripsi" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 resize-none"></textarea>
                            </div>

                            <!-- LINK PEMBELIAN -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800">Link Pembelian</label>
                                <input type="url" name="link_pembelian" placeholder="https://..." class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500">
                            </div>

                        </div>
                        <div class="flex w-full justify-end mt-4 pt-4 border-t border-gray-200">
                            <button type="submit" class="px-6 py-2 rounded-md bg-green-500 hover:bg-green-700 text-white shadow-md cursor-pointer font-semibold">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </article>
    @endif
    {{-- overlay Add Product --}}

    {{-- overlay Edit Product --}}
    @if ($overlayEditProduct)
        <article class="fixed flex top-0 left-0 items-center justify-center w-full h-full bg-gray-900/60 z-50 p-4">
            <div class="flex flex-col w-full max-w-2xl max-h-[90vh] bg-white rounded-md shadow-xl overflow-hidden">
                
                <div class="flex w-full gap-1 justify-between items-center bg-gray-100 border-b border-gray-200 p-4">
                    <h1 class="font-semibold text-lg text-black capitalize">Edit Product</h1>
                    <button type="button" wire:click="btnCloseEditProduct" class="rounded-full p-1 bg-red-500 hover:bg-red-700 text-white cursor-pointer">
                        <x-css-close class="w-4 h-4" />
                    </button>
                </div>

                <div class="p-4 overflow-y-auto custom-scrollbar">
                    <form wire:submit.prevent="updateProduct" class="flex flex-col gap-4">
                        
                        <div class="flex flex-col w-full gap-4">

                            <!-- NAMA PRODUK -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800">Nama</label>
                                <input type="text" wire:model="nama_produk" required class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500">
                            </div>

                            <!-- KATEGORI -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800">Kategori</label>
                                <select wire:model="kategori_usaha_id" required class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500">
                                    <option value="" disabled>--Pilih Kategori--</option>
                                    @foreach ($kategori as $ka)
                                        <option value="{{ $ka->id }}">{{ $ka->nama_kategori }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- HARGA -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800">Harga</label>
                                <!-- Tambahkan min="0" step="1" -->
                                <input type="number" wire:model="harga" min="0" step="1" required class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500">
                            </div>

                            <!-- MULTIPLE GAMBAR (EDIT) -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-start gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800 pt-2">Gambar</label>
                                <div class="md:col-span-3">
                                    <input type="file" wire:model="gambar" multiple accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-50 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600">
                                    <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                                    
                                    <!-- Preview Gambar Lama -->
                                    @if(empty($gambar) && is_array($currentGambar))
                                        <div class="mt-2 flex gap-2 overflow-x-auto p-1 bg-gray-100 rounded-md">
                                            @foreach($currentGambar as $img)
                                                <img src="{{ asset('storage/' . $img) }}" class="w-16 h-16 object-cover rounded-md border border-gray-300 shrink-0">
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- Preview Gambar Baru yang dipilih -->
                                    @if(!empty($gambar))
                                        <div class="mt-2 flex gap-2 overflow-x-auto p-1 bg-green-50 rounded-md">
                                            @foreach($gambar as $newImg)
                                                <img src="{{ $newImg->temporaryUrl() }}" class="w-16 h-16 object-cover rounded-md border border-green-500 shrink-0">
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- DESKRIPSI -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-start gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800 pt-2">Deskripsi</label>
                                <textarea rows="3" wire:model="deskripsi" required class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 resize-none"></textarea>
                            </div>

                            <!-- LINK PEMBELIAN -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800">Link Pembelian</label>
                                <input type="url" wire:model="link_pembelian" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500">
                            </div>

                        </div>
                        <div class="flex w-full justify-end mt-4 pt-4 border-t border-gray-200">
                            <button type="submit" class="px-6 py-2 rounded-md bg-yellow-500 hover:bg-yellow-600 text-white shadow-md cursor-pointer font-semibold">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </article>
    @endif
    {{-- overlay Edit Product --}}

    {{-- notifikasi Add --}}
    @if (session('addSuccess'))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.duration.500ms class="absolute top-2 right-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            <span class="block sm:inline">{{ session('addSuccess') }}</span>
        </div>
    @endif

    @if (session('addGagal'))
        <div class="absolute top-2 right-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
            <span class="block sm:inline">{{ session('addGagal') }}</span>
        </div>
    @endif
    {{-- notifikasi Add --}}
    
    {{-- notifikasi delete --}}
    @if ($deleteSuccess)
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.duration.500ms class="absolute top-2 right-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            <span class="block sm:inline">{{ $deleteSuccess }}</span>
        </div>
    @endif

    @if ($deleteGagal)
        <div class="absolute top-2 right-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
            <span class="block sm:inline">{{ $deleteGagal }}</span>
        </div>
    @endif
    {{-- notifikasi delete --}}

    {{-- notifikasi Edit --}}
    @if ($editSuccess)
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show" x-transition.duration.500ms class="absolute top-2 right-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            <span class="block sm:inline">{{ $editSuccess }}</span>
        </div>
    @endif

    @if ($editGagal)
        <div class="absolute top-2 right-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
            <span class="block sm:inline">{{ $editGagal }}</span>
        </div>
    @endif
    {{-- notifikasi Edit --}}

</section>