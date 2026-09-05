<?php

use Livewire\Component;
use App\Models\albumFoto;

new class extends Component
{
    public $albums, $judul, $albumId;

    public $overlayAddAlbumFoto = false;
    public $overlayEditAlbumFoto = false;

    public $editSuccess;
    public $editGagal;
    public $deleteSuccess;
    public $deleteGagal;

    // load data
    public function loadAlbumFoto()
    {
        $this->albums = albumFoto::all();
    }
    // load data

    // function mount
    public function mount()
    {
        $this->loadAlbumFoto();
    }
    // function mount

    // function Button
    public function btnOpenAddAlbumFoto()
    {
        $this->overlayAddAlbumFoto = true;
    }

    public function btnCloseAddAlbumFoto()
    {
        $this->overlayAddAlbumFoto = false;
    }

    public function btnOpenEditAlbumFoto($id)
    {
        $albums = albumFoto::findOrfail($id);
        $this->albumId = $albums->id;
        $this->judul = $albums->judul;

        $this->overlayEditAlbumFoto = true;
    }

    public function btnCloseEditAlbumFoto()
    {
        $this->overlayEditAlbumFoto = false;
        $this->reset(['albumId','judul']);
    }
    // function Button

    // add function
    // add function

    // update function
    public function updateAlbumFoto()
    {
        $this->validate([
            'judul' => 'required'
        ]);

        try {
            $album = albumFoto::findOrFail($this->albumId);

            $album->update([
                'judul' => $this->judul
            ]);

            $this->loadAlbumFoto();
            $this->btnCloseEditAlbumFoto();

            $this->editSuccess = 'Data Berhasil Diedit';
            $this->editGagal = '';
        } catch (\Throwable $th) {
            $this->editGagal = 'Data Gagal Diedit';
            $this->editSuccess = '';
        }
    }
    // update function

    // delete function
    public function btnDeleteAlbumFoto($id)
    {
        try {
            $album = albumFoto::findOrFail($id);
            $album->delete();

            $this->loadAlbumFoto();

            $this->deleteSuccess = 'Data berhasil dihapus!';
            $this->deleteGagal = '';
        } catch (\Throwable $th) {
            $this->deleteGagal = 'Data gagal dihapus!';
            $this->deleteSuccess = '';
        }
    }
    // delete function
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.admin', [
                'title' => 'Foto'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    <article class="flex flex-none gap-2 items-center">
        <x-bi-image class="h-5 w-5" />
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Foto</h1>
    </article>

    <article class="flex flex-wrap w-full gap-4 items-center">
        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-auto p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Album Foto</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <button type="button" wire:click="btnOpenAddAlbumFoto" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </button>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 w-full max-h-18 gap-2 px-2 overflow-y-auto scrollbar-none">
                @foreach ($albums as $album)
                    <div class="flex flex-col w-full h-auto gap-2 p-2 bg-[#9CB080] rounded-md shadow-md hover:scale-102 duration-120 ease-in-out transition-transform">
                        <div class="flex w-full h-full gap-1 p-1 justify-between items-center bg-[#618764]/40 rounded-md">
                            <p class="text-base font-semibold capitalize">{{$album->judul}}</p>
                            <div class="flex gap-1">
                                <button type="button" wire:click='btnOpenEditAlbumFoto({{ $album->id }})' class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                                    <x-bi-pencil class="h-4 w-4 text-white"/>
                                </button>
                                <button type="button" wire:click="btnDeleteAlbumFoto({{ $album->id }})" class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
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
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Foto</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <div class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </div>
                </div>
            </div>
            <div class="flex w-full h-auto gap-1 items-center">
                @for ($i = 1; $i <= 3; $i++)
                    <div class="flex w-auto h-auto gap-1 items-center bg-gray-100 hover:bg-gray-200 rounded-md p-2 cursor-pointer">
                        <h1 class="font-semibold text-base text-black capitalize">CFD</h1>
                    </div>
                @endfor
            </div>

            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 w-full 3xl:h-210 lg:h-68 md:h-66 h-64 gap-2 p-2 overflow-y-auto scrollbar-none">
                @for ($i = 1; $i <= 12; $i++)
                    <div class="flex flex-col w-full h-auto gap-2 p-2 bg-[#9CB080] rounded-md shadow-md hover:scale-102 duration-120 ease-in-out transition-transform">
                        <div class="flex w-full h-[80%]">
                            <img src="{{ asset('img/foto.jpg') }}" alt="" class="w-full h-46 object-cover rounded-md">
                        </div>
                        <div class="flex w-full h-full gap-1 p-1 justify-between items-center bg-[#618764]/40 rounded-md">
                            <p class="text-base font-semibold capitalize">Kegiatan CFD</p>
                            <div class="flex gap-1">
                                <div class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                                    <x-css-eye class="h-4 w-4 text-white"/>
                                </div>
                                <div class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                                    <x-bi-trash class="h-4 w-4 text-white"/>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </article>

    {{-- overlay Add Album Foto --}}
    @if ($overlayAddAlbumFoto)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Tambah Album Foto</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button wire:click="btnCloseAddAlbumFoto" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form action="{{ route('admin.album-foto.store') }}" enctype="multipart/form-data" method="POST" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="judul" class="text-sm font-semibold text-gray-800">
                                Judul Foto
                            </label>
    
                            <input type="text" name="judul" id="judul" required placeholder="Masukkan Nama Judul Foto" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
    {{-- overlay Add Album Foto --}}

    {{-- overlay Edit Album Foto --}}
    @if ($overlayEditAlbumFoto)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Edit Album Foto</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button type="button" wire:click="btnCloseEditAlbumFoto" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="updateAlbumFoto" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="judul" class="text-sm font-semibold text-gray-800">
                                Judul Foto
                            </label>
    
                            <input type="text" wire:model="judul" name="judul" id="judul" required placeholder="Masukkan Nama Judul Foto" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
    {{-- overlay Edit Album Foto --}}

    {{-- overlay Add Kolaborasi --}}
    {{-- @if ($overlayAddKolaborasi)
        <article class="fixed flex top-0 left-0 items-center justify-center w-full h-full bg-gray-900/60 z-50 p-4">
            <div class="flex flex-col w-full max-w-2xl max-h-[90vh] bg-white rounded-md shadow-xl overflow-hidden">
                
                <div class="flex w-full gap-1 justify-between items-center bg-gray-100 border-b border-gray-200 p-4">
                    <h1 class="font-semibold text-lg text-black capitalize">Tambah Kolaborasi</h1>
                    <button wire:click="btnCloseKolaborasi" class="rounded-full p-1 bg-red-500 hover:bg-red-700 text-white cursor-pointer">
                        <x-css-close class="w-4 h-4" />
                    </button>
                </div>

                <div class="p-4 overflow-y-auto custom-scrollbar">
                    <form action="{{ route('admin.kolaborasi.store') }}" enctype="multipart/form-data" method="POST" class="flex flex-col gap-4">
                        @csrf
                        <div class="flex flex-col w-full gap-4">

                            <!-- NAMA KOLABORASI -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800">Nama</label>
                                <input type="text" name="nama_kolaborasi" required placeholder="Masukkan Nama Kolaborasi" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500">
                            </div>

                            <!-- SELECT WILAYAH KOLABORASI (DI PERBAIKI) -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800">Wilayah</label>
                                <select name="wilayah_kolaborasi_id" required class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500">
                                    <option value="" disabled selected>--Pilih Wilayah--</option>
                                    <!-- Foreach ada di dalam Select -->
                                    @foreach ($AlbumFoto as $wk)
                                        <option value="{{ $wk->id }}" class="text-black">{{ $wk->nama_wilayah }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- MULTIPLE IMAGE (TAMBAHKAN [] DAN multiple) -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-start gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800 pt-2">Gambar</label>
                                <div class="md:col-span-3">
                                    <input type="file" name="image[]" multiple required accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-50 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600">
                                    <p class="mt-1 text-xs text-gray-500">Bisa pilih lebih dari 1 gambar sekaligus. Format: JPG/PNG/WEBP. Maks 2MB/file.</p>
                                </div>
                            </div>

                            <!-- DESKRIPSI -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-start gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800 pt-2">Deskripsi</label>
                                <textarea rows="3" name="deskripsi_kolaborasi" required placeholder="Masukkan Deskripsi" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 resize-none"></textarea>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                                <label for="tanggal_mulai" class="text-sm font-semibold text-gray-800 pt-2">
                                    Tanggal Mulai
                                </label>
        
                                <input type="date" name="tanggal_mulai" required id="tanggal_mulai" placeholder="Masukkan Nomor Hp (08xxxxxxxx)" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                                <label for="tanggal_selesai" class="text-sm font-semibold text-gray-800 pt-2">
                                    Tanggal Selesai
                                </label>
        
                                <input type="date" name="tanggal_selesai" required id="tanggal_selesai" placeholder="Masukkan Nomor Hp (08xxxxxxxx)" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                            </div>

                        </div>
                        <div class="flex w-full justify-end mt-4 pt-4 border-t border-gray-200">
                            <button type="submit" class="px-6 py-2 rounded-md bg-green-500 hover:bg-green-700 text-white shadow-md cursor-pointer font-semibold">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </article>
    @endif --}}
    {{-- overlay Add Kolaborasi --}}

    {{-- overlay Edit Kolaborasi --}}
    {{-- @if ($overlayEditKolaborasi)
        <article class="fixed flex top-0 left-0 items-center justify-center w-full h-full bg-gray-900/60 z-50 p-4">
            <div class="flex flex-col w-full max-w-2xl max-h-[90vh] bg-white rounded-md shadow-xl overflow-hidden">
                
                <div class="flex w-full gap-1 justify-between items-center bg-gray-100 border-b border-gray-200 p-4">
                    <h1 class="font-semibold text-lg text-black capitalize">Edit Kolaborasi</h1>
                    <button type="button" wire:click="btnCloseEditKolaborasi" class="rounded-full p-1 bg-red-500 hover:bg-red-700 text-white cursor-pointer">
                        <x-css-close class="w-4 h-4" />
                    </button>
                </div>

                <div class="p-4 overflow-y-auto custom-scrollbar">
                    <form wire:submit.prevent="updateKolaborasi" class="flex flex-col gap-4">
                        
                        <div class="flex flex-col w-full gap-4">

                            <!-- NAMA KOLABORASI -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800">Nama</label>
                                <input type="text" wire:model="nama_kolaborasi" required class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500">
                            </div>

                            <!-- WILAYAH -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800">Wilayah</label>
                                <select wire:model="wilayah_kolaborasi_id" required class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500">
                                    <option value="" disabled>--Pilih Wilayah--</option>
                                    @foreach ($AlbumFoto as $wk)
                                        <option value="{{ $wk->id }}">{{ $wk->nama_wilayah }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- MULTIPLE GAMBAR (EDIT) -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-start gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800 pt-2">Gambar</label>
                                <div class="md:col-span-3">
                                    <input type="file" wire:model="image" multiple accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-50 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600">
                                    <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                                    
                                    <!-- Preview Gambar Lama -->
                                    @if(empty($image) && is_array($currentImage))
                                        <div class="mt-2 flex gap-2 overflow-x-auto p-1 bg-gray-100 rounded-md">
                                            @foreach($currentImage as $img)
                                                <img src="{{ asset('storage/' . $img) }}" class="w-16 h-16 object-cover rounded-md border border-gray-300 shrink-0">
                                            @endforeach
                                        </div>
                                    @endif

                                    <!-- Preview Gambar Baru yang dipilih -->
                                    @if(!empty($image))
                                        <div class="mt-2 flex gap-2 overflow-x-auto p-1 bg-green-50 rounded-md">
                                            @foreach($image as $newImg)
                                                <img src="{{ $newImg->temporaryUrl() }}" class="w-16 h-16 object-cover rounded-md border border-green-500 shrink-0">
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- DESKRIPSI -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-start gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800 pt-2">Deskripsi</label>
                                <textarea rows="3" wire:model="deskripsi_kolaborasi" required class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 resize-none"></textarea>
                            </div>

                            <!-- TANGGAL MULAI (Tambahkan ini) -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800">Tanggal Mulai</label>
                                <input type="date" wire:model="tanggal_mulai" required class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500">
                            </div>

                            <!-- TANGGAL SELESAI (Tambahkan ini) -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label class="text-sm font-semibold text-gray-800">Tanggal Selesai</label>
                                <input type="date" wire:model="tanggal_selesai" required class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500">
                            </div>

                        </div>
                        <div class="flex w-full justify-end mt-4 pt-4 border-t border-gray-200">
                            <button type="submit" class="px-6 py-2 rounded-md bg-yellow-500 hover:bg-yellow-600 text-white shadow-md cursor-pointer font-semibold">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </article>
    @endif --}}
    {{-- overlay Edit Kolaborasi --}}

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