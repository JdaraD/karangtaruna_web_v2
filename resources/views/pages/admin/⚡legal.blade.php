<?php

use Livewire\Component;
use App\Models\legal;

new class extends Component
{
    public $legal, $legalId, $name, $paragraf;

    public $overlayAddLegal = false;
    public $overlayEditLegal = false;

    public $deleteSuccess;
    public $deleteGagal;
    public $editSuccess;
    public $editGagal;

    // load data
    public function loadLegal()
    {
        $this->legal = legal::get();
    }
    // load data

    // function mount
    public function mount()
    {
        $this->loadLegal();
    }
    // function mount

    // function Button
    public function btnOpenAddLegal()
    {
        $this->overlayAddLegal = true;
    }

    public function btnCloseAddLegal()
    {
        $this->overlayAddLegal = false;
    }

    public function btnOpenEditLegal($id)
    {
        $legal = legal::findOrFail($id);

        $this->legalId = $legal->id;
        $this->name = $legal->name;
        $this->paragraf = $legal->paragraf;

        $this->overlayEditLegal = true;

    }

    public function btnCloseEditLegal()
    {
        $this->overlayEditLegal = false;
        $this->reset([
            'legalId',
            'name',
            'paragraf'
        ]);
    }
    // function Button

    // add function
    // add function

    // update function
    public function updateLegal()
    {
        $this->validate([
            'name' => 'required',
            'paragraf' => 'required'
        ]);

        try {
            $legal = legal::findOrfail($this->legalId);
            
            $legal->update([
                'name' => $this->name,
                'paragarf' => $this->paragraf
            ]);

            $this->editSuccess = 'Data Berhasil Diedit!';
            $this->editGagal = '';
        } catch (\Throwable $th) {
            $this->editGagal = 'Data Gagal Diedit!';
            $this->editSuccess = '';
        }

    }
    // update function

    // delete function
    public function btnDeleteLegal()
    {
        try {
            $legal = legal::latest()->first();
            $legal->delete();

            $this->loadLegal();

            $this->deleteSuccess = 'Data Berhasil Dihapus!';
            $this->deleteGagal = '';

            $this->overlayEditLegal = false;
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
                'title' => 'legal'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    <article class="flex flex-none gap-2 items-center">
        <x-bi-book class="h-5 w-5"/>
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Legal</h1>
    </article>

    <article class="flex flex-wrap w-full gap-4 items-center">
        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-auto p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    @foreach ($legal as $l )
                        <h1 class="font-semibold text-base text-black capitalize">{{$l->name}}</h1>
                    @endforeach
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    @if ($legal->isEmpty())
                        <button type="button" wire:click="btnOpenAddLegal" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                            <x-bi-plus class="h-6 w-6 text-white"/>
                        </button>
                    @else
                        @foreach ($legal as $l)
                            <button type="button" wire:click="btnOpenEditLegal({{ $l->id }})" class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                                <x-bi-pencil class="h-4 w-4 text-white"/>
                            </button>
                            <button type="button" wire:click="btnDeleteLegal" class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                                <x-bi-trash class="h-4 w-4 text-white"/>
                            </button>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="flex flex-wrap" wire:poll.1s>
                @foreach ($legal as $l)
                    <p class="lg:text-base text-sm lg:line-clamp-9 md:line-clamp-8 line-clamp-5 text-black text-justify">{{ $l->paragraf }}</p>
                    
                @endforeach
            </div>
        </div>

        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-auto p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Pasal Tentang Berdirinya Karang Taruna</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <div class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                        <x-css-eye class="h-4 w-4 text-white"/>
                    </div>
                    <div class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </div>
                    <div class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                        <x-bi-trash class="h-4 w-4 text-white"/>
                    </div>
                </div>
            </div>
            <div class="flex w-full h-60 overflow-y-auto scrollbar-none">
                    
                <ul class="flex flex-col gap-3 list-disc">
                    @for ($i = 1; $i <= 8; $i++)
                    <li class="flex items-center gap-3">
                        <div class="lg:w-4 w-2 lg:h-4 h-2 shrink-0 bg-[#9CB080] rounded-full"></div>
                        <span class="text-black lg:text-sm text-xs text-justify">Menjadikan pemuda desa Waru sebagai generasi yang berkualitas, berdaya saing, dan berkontribusi positif dalam pembangunan desa.</span>
                    </li>
                    @endfor
                </ul>
            </div>
        </div>
    </article>

    {{-- overlayAdd Legal --}}
    @if ($overlayAddLegal)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Tambah Dasar Hukum</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button wire:click="btnCloseAddLegal" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form action="{{ route('admin.legal.store') }}" method="POST" class="flex flex-col gap-4">
                    @csrf
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="name" class="text-sm font-semibold text-gray-800 pt-2">
                                Judul
                            </label>
    
                           <input type="text" name="name" id="name" placeholder="Masukkan Nama" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="paragraf" class="text-sm font-semibold text-gray-800">
                                Isi Dasar Hukum
                            </label>
    
                            <textarea cols="4" rows="2" name="paragraf" required id="paragraf" placeholder="Masukkan Isi Dasar Hukum" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"></textarea>
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
    {{-- overlayAdd Legal --}}

    {{-- overlayEdit Legal--}}
    @if ($overlayEditLegal)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Edit Dasar Hukum</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button type="button" wire:click="btnCloseEditLegal" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="updateLegal" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="name" class="text-sm font-semibold text-gray-800 pt-2">
                                Judul
                            </label>
    
                           <input type="text" name="name" wire:model="name" id="name" placeholder="Masukkan Nama" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="paragraf" class="text-sm font-semibold text-gray-800">
                                Isi Dasar Hukum
                            </label>
    
                            <textarea cols="4" rows="2" wire:model="paragraf" name="paragraf" required id="paragraf" placeholder="Masukkan Isi Dasar Hukum" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"></textarea>
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
    {{-- overlayEdit Legal --}}

    {{-- overlayAdd Legal --}}
    {{-- @if ($overlayAddLegal)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Tambah Kontak Bantuan</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button wire:click="btnCloseBantuan" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form action="{{ route('kontakBantuan.store') }}" method="POST" class="flex flex-col gap-4">
                    @csrf
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="wilayah" class="text-sm font-semibold text-gray-800">
                                Wilayah
                            </label>
    
                            <input type="text" name="wilayah" id="wilayah" placeholder="Masukkan Nama Wilayah (RW 01)" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="name" class="text-sm font-semibold text-gray-800 pt-2">
                                Nama
                            </label>
    
                           <input type="text" name="name" id="name" placeholder="Masukkan Nama" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="no_hp" class="text-sm font-semibold text-gray-800 pt-2">
                                Nomor Hp
                            </label>
    
                           <input type="text" name="no_hp" id="no_hp" placeholder="Masukkan Nomor Hp (08xxxxxxxx)" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="20" inputmode="numeric" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
        
    @endif --}}
    {{-- overlayAdd Legal --}}

    {{-- overlayEdit Legal--}}
    {{-- @if ($overlayEditLegal)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Edit Kontak Bantuan</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button type="button" wire:click="btnCloseEditBantuan" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="updateBantuan" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="wilayah" class="text-sm font-semibold text-gray-800">
                                Wilayah
                            </label>
    
                            <input type="text" wire:model="wilayah" name="wilayah" id="wilayah" placeholder="Masukkan Nama Wilayah (RW 01)" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="name" class="text-sm font-semibold text-gray-800 pt-2">
                                Nama
                            </label>
    
                           <input type="text" wire:model="name" name="name" id="name" placeholder="Masukkan Nama" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="no_hp" class="text-sm font-semibold text-gray-800 pt-2">
                                Nomor Hp
                            </label>
    
                           <input type="text" wire:model="no_hp" name="no_hp" id="no_hp" placeholder="Masukkan Nomor Hp (08xxxxxxxx)" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="20" inputmode="numeric" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
        
    @endif --}}

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