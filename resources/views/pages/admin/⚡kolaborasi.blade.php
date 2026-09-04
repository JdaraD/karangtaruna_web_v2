<?php

use Livewire\Component;
use App\Models\wilayahKolaborasi;

new class extends Component
{
    public $nama_wilayah, $wilayahKolaborasi, $wilayahKolaborasiId;

    public $overlayAddWilayahKolaborasi = false;
    public $overlayEditWilayahKolaborasi = false;

    public $deleteSuccess;
    public $deleteGagal;
    public $editSuccess;
    public $editGagal;

    // load data
    public function loadWilayahKolaborasi()
    {
        $this->wilayahKolaborasi = wilayahKolaborasi::all();
    }
    // load data

    // function mount
    public function mount()
    {
        $this->loadWilayahKolaborasi();
    }
    // function mount

    // function Button
    public function btnOpenAddWilayahKolaborasi()
    {
        $this->overlayAddWilayahKolaborasi = true;
    }

    public function btnCloseWilayahKolaborasi()
    {
        $this->overlayAddWilayahKolaborasi = false;
    }

    public function btnOpenEditWilayahKolaborasi($id)
    {
        $wilayah = wilayahKolaborasi::findOrFail($id);

        $this->wilayahKolaborasiId = $wilayah->id;
        $this->nama_wilayah = $wilayah->nama_wilayah;

        $this->overlayEditWilayahKolaborasi = true;
    }

    public function btnCloseEditWilayahKolaborasi()
    {
        $this->overlayEditWilayahKolaborasi = false;
        $this->reset('nama_wilayah');
    }
    // function Button

    // add function
    // add function

    // update function
    public function updateWilayahKolaborasi()
    {
        $this->validate([
            'nama_wilayah' => 'required|string|max:255',
        ]);

        try {
            $wilayah = wilayahKolaborasi::findOrFail($this->wilayahKolaborasiId);

            $wilayah->update([
                'nama_wilayah' => $this->nama_wilayah,
            ]);

            $this->loadWilayahKolaborasi();
            $this->overlayEditWilayahKolaborasi = false;

            $this->editSuccess = 'Data berhasil diubah!';
            $this->editGagal = '';
        } catch (\Throwable $th) {
            dd($th->getMessage());
            // $this->editGagal = 'Data gagal diubah!';
            // $this->editSuccess = '';
        }
    }
    // update function

    // delete function
    public function btndeleteWilayahKolaborasi($id)
    {
        try {
            $wilayah = wilayahKolaborasi::findOrFail($id);
            $wilayah->delete();

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
                'title' => 'Kolaborasi'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    <article class="flex flex-none gap-2 items-center">
        <x-iconpark-cooperativehandshake-o class="w-6 h-6"/>
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Kolaborasi</h1>
    </article>

    <article class="flex flex-wrap w-full gap-4 items-center">
        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-auto p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Kategori Wilayah Kolaborasi</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <button type="button" wire:click="btnOpenAddWilayahKolaborasi" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </button>
                </div>
            </div>

            <div wire:poll.1s class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 w-full max-h-18 gap-2 px-2 overflow-y-auto scrollbar-none">
                @foreach ($wilayahKolaborasi as $wilayah)
                    <div class="flex flex-col w-full h-auto gap-2 p-2 bg-[#9CB080] rounded-md shadow-md hover:scale-102 duration-120 ease-in-out transition-transform">
                        <div class="flex w-full h-full gap-1 p-1 justify-between items-center bg-[#618764]/40 rounded-md">
                            <p class="text-base font-semibold capitalize">{{ $wilayah->nama_wilayah }}</p>
                            <div class="flex gap-1">
                                <button type="button" wire:click="btnOpenEditWilayahKolaborasi({{ $wilayah->id }})" class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Edit">
                                    <x-bi-pencil class="h-4 w-4 text-white"/>
                                </button>
                                <button type="button" wire:click="btndeleteWilayahKolaborasi({{ $wilayah->id }})" class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
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
                    <h1 class="font-semibold text-base text-black capitalize">Kolaborasi</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <button type="button" wire:click="btnOpenAddKolaborasi" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </button>
                </div>
            </div>
            <div class="flex w-full h-auto gap-1 items-center">
                @for ($i = 1; $i <= 3; $i++)
                    <div class="flex w-auto h-auto gap-1 items-center bg-gray-100 hover:bg-gray-200 rounded-md p-2 cursor-pointer">
                        <h1 class="font-semibold text-base text-black capitalize">RW 01</h1>
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
                            <p class="text-base font-semibold capitalize">KKN UMJ</p>
                            <div class="flex gap-1">
                                <div class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                                    <x-bi-pencil class="h-4 w-4 text-white"/>
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

    
    {{-- overlay Add Wilayah Kolaborasi --}}
    @if ($overlayAddWilayahKolaborasi)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Tambah Wilayah Kolaborasi</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button wire:click="btnCloseWilayahKolaborasi" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form action="{{ route('admin.wilayah-kolaborasi.store') }}" enctype="multipart/form-data" method="POST" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="nama_wilayah" class="text-sm font-semibold text-gray-800">
                                Nama Wilayah
                            </label>
    
                            <input type="text" name="nama_wilayah" id="nama_wilayah" required placeholder="Masukkan Nama Wilayah" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
    {{-- overlay Add Wilayah Kolaborasi --}}

    {{-- overlay Edit Wilayah Kolaborasi --}}
    @if ($overlayEditWilayahKolaborasi)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Edit Wilayah Kolaborasi</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button type="button" wire:click="btnCloseEditWilayahKolaborasi" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="updateWilayahKolaborasi" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="nama_wilayah" class="text-sm font-semibold text-gray-800">
                                Nama Wilayah
                            </label>
    
                            <input type="text" wire:model="nama_wilayah" name="nama_wilayah" id="nama_wilayah" required placeholder="Masukkan Nama Wilayah" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
    {{-- overlay Edit Wilayah Kolaborasi --}}

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