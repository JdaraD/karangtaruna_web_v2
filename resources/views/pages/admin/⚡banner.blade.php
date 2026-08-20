<?php

use Livewire\Component;
use App\Models\Banner;
use App\Models\Slider;

new class extends Component
{
    public $name, $image, $tanggal_publish;

    public $banner;
    public $bannerId;
    public $slider;
    public $sliderId;

    public $overlayAddBanner = false;
    public $overlayEditBanner = false;
    public $overlayAddSlider = false;
    public $overlayEditSlider = false;

    public $deleteSuccess;
    public $deleteGagal;
    public $editSuccess;
    public $editGagal;

    // load data
    public function loadBanner()
    {
        $this->banner = Banner::get();
    }

    public function loadSlider()
    {
        $this->slider = Slider::get();
    }

    // load data

    // view data
    public function mount()
    {
        $this->loadBanner();
        $this->loadSlider();
    }
    // view data

    // button function
    public function btnAddBanner()
    {
        $this->overlayAddBanner = true;
    }

    public function btnCloseBanner()
    {
        $this->overlayAddBanner = false;
    }

    public function btnEditBanner($id)
    {
        $banner = Banner::findOrFail($id);

        $this->bannerId = $banner->id;
        $this->name = $banner->name;
        $this->image = $banner->image;
        $this->tanggal_publish = $banner->tanggal_publish;

        $this->currentImage = $banner->image;
        $this->image = null;

        $this->overlayEditBanner = true;
        
    }

    public function btnCloseEditBanner()
    {
        $this->overlayEditBanner = false;
        $this->reset([
            'bannerId',
            'name',
            'image',
            'tanggal_publish'
        ]);
    }

    public function btnAddSlider()
    {
        $this->overlayAddSlider = true;
    }

    public function btnCloseSlider()
    {
        $this->overlayAddSlider = false;
    }

    public function btnEditSlider($id)
    {
        $slider = Slider::findOrFail($id);

        $this->sliderId = $slider->id;
        $this->name = $slider->name;
        $this->image = $slider->image;
        $this->tanggal_publish = $slider->tanggal_publish;

        $this->currentImage = $slider->image;
        $this->image = null;

        $this->overlayEditSlider = true;
    }

    public function btnCloseEditSlider()
    {
        $this->overlayEditSlider = false;
        $this->reset([
            'sliderId',
            'name',
            'image',
            'tanggal_publish'
        ]);
    }
    // button function

    // update function
    public function updateBanner()
    {
        $rules = [
            'name' => 'required',
            'tanggal_publish' => 'required'
        ];

        if ($this->image) {
            $rules['image'] = 'image|mimes:png,jpg,jpeg,webp|max:2048';
        }

        $this->validate($rules);

        try {
            $banner = Banner::findOrFail($this->bannerId);

            // 2. Siapkan data dasar yang PASTI diubah (tanpa menyertakan image dulu)
            $dataToUpdate = [
                'name' => $this->name,
                'tanggal_publish' => $this->tanggal_publish,
            ];

            // 3. Cek apakah user mengupload file GAMBAR BARU
            // Kita pastikan $this->image berisi objek file, bukan string kosong/null
            if ($this->image && !is_string($this->image)) {
                
                // Masukkan kode pemrosesan gambar Anda di sini (misal upload biasa):
                $path = $this->image->store('uploads/banner', 'public');
                
                // Masukkan path baru ini ke dalam array yang akan diupdate
                $dataToUpdate['image'] = $path;

                // (Opsional) Hapus file gambar lama di folder storage agar hemat ruang
                if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                    Storage::disk('public')->delete($banner->image);
                }
            }

            // 4. Jalankan perintah update ke database
            // Jika tidak ada gambar baru, $dataToUpdate HANYA berisi 'name' dan 'tanggal_publish'
            // Sehingga database tidak akan protes soal kolom 'image' yang null
            $banner->update($dataToUpdate); 

            $this->loadBanner();

            $this->editSuccess = 'Data Berhasil Diedit!';
            $this->editGagal = '';
            $this->overlayEditBanner = false;
            
            // Reset input file gambar agar bersih kembali
            $this->image = null;
        } catch (\Throwable $th) {
            $this->editGagal = 'Data Gagal Diedit!';
            $this->editSuccess = '';
            // dd($th->getMessage());
        }
        
    }

    public function updateSlider()
        {
            $rules = [
                'name' => 'required',
                'tanggal_publish' => 'required'
            ];

            if ($this->image) {
                $rules[image] = 'image|mimes:png,jpg,jpeg,webp|max:2048';
            }

            $this->validate($rules);

            try {
                $slider = Slider::findOrFail($this->sliderId);

                $dataToUpdate = [
                    'name' => $this->name,
                    'tanggal_publish' => $this->tanggal_publish
                ];

                if ($this->image && !is_string($this->image)) {
                    
                    $path = $this->image->storage('uploads/slider'. 'public');

                    $dataToUpdate[image] = $path; 

                    if ($slider->image && Storage::disk('public')->exists($slider->image)) {
                        Storage::disk('public')->delete($slider->image);
                    }

                }
                    $slider->update($dataToUpdate);

                    $this->loadSlider();

                    $this->editSuccess = 'Data Berhasil Diedit!';
                    $this->editGagal = '';
                    $this->overlayEditSlider = false;

                    $this->image = null;
            } catch (\Throwable $th) {
                // $this->editGagal = 'Data Gagal Diedit!';
                // $this->editSuccess = '';
                dd($th->getMessage());
            }
        }
    // update function

    // delete function
    public function btnDeleteBanner($id)
    {
        try {
            $banner = Banner::findOrFail($id);
            $banner->delete();

            $this->loadBanner();

            $this->deleteSuccess = 'Data Berhasil Dihapus!';
            $this->deleteGagal = '';
        } catch (\Throwable $th) {
            $this->deleteGagal = 'Data Gagal Dihapus!';
            $this->deleteSuccess = '';
        }
        
    }

    public function btnDeleteSlider($id)
    {
        try {
            $slider = Slider::findOrFail($id);
            $slider->delete();

            $this->loadSlider();

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
                'title' => 'Banner & Slider'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    <article class="flex flex-none gap-2 items-center">
        <x-bi-image class="h-6 w-6" />
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Banner & Slider</h1>
    </article>

    <article class="flex flex-wrap w-full gap-4 items-center">

        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-fit p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Banner Usaha Mandiri</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <button wire:click="btnAddBanner" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </button>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 w-full 3xl:h-70 lg:h-40 md:h-40 h-64 gap-2 p-2 overflow-y-auto scrollbar-none">
                @foreach ($banner as $b)
                    <div class="flex w-full h-36.75 gap-2 p-2 bg-[#9CB080] rounded-md shadow-md hover:scale-102 duration-120 ease-in-out transition-transform">
                        <div class="flex w-[70%] h-full">
                            <img src="{{ asset('storage/'. $b->image) }}" alt="" class="w-full h-32 object-cover rounded-md">
                        </div>
                        <div class="flex w-[30%] h-full flex-col gap-1">
                            <div class="flex gap-1 p-1 justify-between items-center bg-[#618764]/40 rounded-md">
                                <p class="text-base font-semibold capitalize">{{ $b->name }}</p>
                                <div class="flex gap-1">
                                    <button wire:click="btnEditBanner({{ $b->id }})" class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                                        <x-bi-pencil class="h-4 w-4 text-white"/>
                                    </button>
                                    <button wire:click="btnDeleteBanner({{ $b->id }})" class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                                        <x-bi-trash class="h-4 w-4 text-white"/>
                                    </button>
                                </div>
                            </div>
                            <p class="text-base font-semibold text-justify line-clamp-4">{{ $b->tanggal_publish }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-fit p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Slider</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <button wire:click="btnAddSlider" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </button>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 w-full 3xl:h-70 lg:h-40 md:h-40 h-64 gap-2 p-2 overflow-y-auto scrollbar-none">
                @foreach ($slider as $s)
                    <div class="flex w-full h-36.75 gap-2 p-2 bg-[#9CB080] rounded-md shadow-md hover:scale-102 duration-120 ease-in-out transition-transform">
                        <div class="flex w-[70%] h-full">
                            <img src="{{ asset('storage/'. $s->image) }}" alt="" class="w-full h-32 object-cover rounded-md">
                        </div>
                        <div class="flex w-[30%] h-full flex-col gap-1">
                            <div class="flex gap-1 p-1 justify-between items-center bg-[#618764]/40 rounded-md">
                                <p class="text-base font-semibold capitalize">{{ $s->name }}</p>
                                <div class="flex gap-1">
                                    <button wire:click="btnEditSlider({{ $s->id }})" class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                                        <x-bi-pencil class="h-4 w-4 text-white"/>
                                    </button>
                                    <button wire:click="btnDeleteSlider({{ $s->id }})" class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                                        <x-bi-trash class="h-4 w-4 text-white"/>
                                    </button>
                                </div>
                            </div>
                            <p class="text-base font-semibold text-justify line-clamp-4">{{ $s->tanggal_publish }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


    </article>

    {{-- overlay Add Banner --}}
    @if ($overlayAddBanner)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Tambah Banner</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button wire:click="btnCloseBanner" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form action="{{ route('banner.store') }}" enctype="multipart/form-data" method="POST" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="name" class="text-sm font-semibold text-gray-800">
                                Nama
                            </label>
    
                            <input type="text" name="name" id="name" required placeholder="Masukkan Nama Admin" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="image" class="text-sm font-semibold text-gray-800 pt-2">
                                Image
                            </label>
    
                               <div class="md:col-span-3">
                                    <input type="file" name="image" id="image" required accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                    @error('image')
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror

                                    <p class="mt-1 text-xs text-gray-500">
                                        Format: JPG, JPEG, PNG, atau WEBP. Ukuran: 2900x900. Maksimal 2 MB.
                                    </p>
                                </div>
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="tanggal_publish" class="text-sm font-semibold text-gray-800 pt-2">
                                Tanggal
                            </label>
    
                           <input type="date" name="tanggal_publish" required id="tanggal_publish" placeholder="Masukkan Nomor Hp (08xxxxxxxx)" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
    {{-- overlay Add Banner --}}

    {{-- overlay Edit Banner --}}
    @if ($overlayEditBanner)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Edit Banner</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button type="button" wire:click="btnCloseEditBanner" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="updateBanner" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="name" class="text-sm font-semibold text-gray-800">
                                Nama
                            </label>
    
                            <input type="text" name="name" wire:model="name" id="name" placeholder="Masukkan Nama Admin" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="image" class="text-sm font-semibold text-gray-800 pt-2">
                                Image
                            </label>
    
                            <div class="md:col-span-3">
                                <input type="file" name="image" id="image" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                @error('image')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror

                                <p class="mt-1 text-xs text-gray-500">
                                    Format: JPG, JPEG, PNG, atau WEBP. Ukuran: 2900x900. Maksimal 2 MB.
                                </p>
                            </div>
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="tanggal_publish" class="text-sm font-semibold text-gray-800 pt-2">
                                Tanggal
                            </label>
    
                           <input type="date" wire:model="tanggal_publish" name="tanggal_publish" id="tanggal_publish" placeholder="Masukkan Nomor Hp (08xxxxxxxx)" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
    {{-- overlay Edit Banner --}}

    {{-- overlay Add Slider --}}
    @if ($overlayAddSlider)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Tambah Slider</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button wire:click="btnCloseSlider" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form action="{{ route('slider.store') }}" method="POST" class="flex flex-col gap-4" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="name" class="text-sm font-semibold text-gray-800">
                                Nama
                            </label>
    
                            <input type="text" name="name" required id="name" placeholder="Masukkan Nama Admin" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="image" class="text-sm font-semibold text-gray-800 pt-2">
                                Image
                            </label>
    
                               <div class="md:col-span-3">
                                    <input type="file" name="image" required id="image" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                    @error('image')
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror

                                    <p class="mt-1 text-xs text-gray-500">
                                        Format: JPG, JPEG, PNG, atau WEBP. Ukuran 1200x80. Maksimal 2 MB.
                                    </p>
                                </div>
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="tanggal_publish" class="text-sm font-semibold text-gray-800 pt-2">
                                Tanggal
                            </label>
    
                           <input type="date" name="tanggal_publish" required id="tanggal_publish" placeholder="Masukkan Nomor Hp (08xxxxxxxx)" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
    {{-- overlay Add Slider --}}

    {{-- overlay Edit Slider --}}
    @if ($overlayEditSlider)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Edit Slider</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button type="button" wire:click="btnCloseEditSlider" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="updateSlider " class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="name" class="text-sm font-semibold text-gray-800">
                                Nama
                            </label>
    
                            <input type="text" name="name" wire:model="name" id="name" placeholder="Masukkan Nama Admin" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="image" class="text-sm font-semibold text-gray-800 pt-2">
                                Image
                            </label>
    
                            <div class="md:col-span-3">
                                <input type="file" name="image" id="image" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                @error('image')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror

                                <p class="mt-1 text-xs text-gray-500">
                                    Format: JPG, JPEG, PNG, atau WEBP. Ukuran: 2900x900. Maksimal 2 MB.
                                </p>
                            </div>
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="tanggal_publish" class="text-sm font-semibold text-gray-800 pt-2">
                                Tanggal
                            </label>
    
                           <input type="date" wire:model="tanggal_publish" name="tanggal_publish" id="tanggal_publish" placeholder="Masukkan Nomor Hp (08xxxxxxxx)" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
    {{-- overlay Edit Slider --}}


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