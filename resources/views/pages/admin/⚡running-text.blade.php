<?php

use Livewire\Component;
use App\Models\runningText;

new class extends Component
{
    public $overlayAdd = false;
    public $runningText;
    public $deleteSuccess = '';
    public $deleteGagal = '';

    public function loadRunningText()
    {
        $this->runningText = runningText::get();
    }

    public function mount()
    {
        $this->loadRunningText();
    }

    // button function
    public function btnOpenAdd()
    {
        $this->overlayAdd = true;
    }

    public function btnCloseAdd()
    {
        $this->overlayAdd = false;
    }

    public function btnDelete($id)
    {
        
        try {
            $runningText = runningText::findOrFail($id);
            $runningText->delete();

            $this->loadRunningText();

            $this->deleteSuccess = 'Data berhasil dihapus!';
            $this->deleteGagal = '';

            // session()->flash('deleteSuccess', 'Data berhasil Dihapus!');
        } catch (\Throwable $th) {
            $this->deleteGagal = 'Data gagal dihapus!';
            $this->deleteSuccess = '';
            // session()->flash('deleteGagal', 'Data gagal Dihapus!');
        }

    }
    // button function


    
    public function render()
    {
        return $this->view()
            ->layout('layouts.admin', [
                'title' => 'Running Text'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    <article class="flex flex-none gap-2 items-center">
        <x-gmdi-info class="w-6 h-6"/>
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Running Text</h1>
    </article>

    <article class="flex flex-wrap w-full gap-4 items-center">

        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-auto p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Running Text</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <button wire:click="btnOpenAdd" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </button>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 w-full 3xl:h-210 lg:h-80 md:h-66 h-64 gap-2 p-2 overflow-y-auto scrollbar-none">
                @foreach ($runningText as $text)
                    <div class="flex flex-col w-full h-38 gap-2 p-2 bg-[#9CB080] rounded-md shadow-md hover:scale-102 duration-120 ease-in-out transition-transform">
                        <p class="flex h-full text-base font-semibold capitalize line-clamp-5">{{$text->text}}</p>
                        <div class="flex w-full h-8 gap-1 p-1 justify-between items-center bg-[#618764]/40 rounded-md">
                            <p class="text-base font-semibold capitalize">{{$text->judul}}</p>
                            <div class="flex gap-1">
                                <div class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                                    <x-bi-pencil class="h-4 w-4 text-white"/>
                                </div>
                                <button type="button" wire:click="btnDelete({{ $text->id }})" class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                                    <x-bi-trash class="h-4 w-4 text-white"/>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </article>

    {{-- overlay btn add --}}
    @if ($overlayAdd)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <form action="{{ route('runningTextController.store') }}" method="POST" class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Tambah Running Text</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button wire:click="btnCloseAdd" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <div class="flex flex-col w-full gap-5 pt-2">

                    <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                        <label for="judul" class="text-sm font-semibold text-gray-800">
                            Judul Berita
                        </label>

                        <input type="text" name="judul" id="judul" placeholder="Masukkan judul berita" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                        <label for="berita" class="text-sm font-semibold text-gray-800 pt-2">
                            Berita
                        </label>

                        <textarea name="text" id="text" rows="7" placeholder="Masukkan isi berita" class="md:col-span-3 w-full resize-none rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"></textarea>
                    </div>

                </div>

                <div class="flex w-full h-full justify-end items-end">
                    <button type="submit" class="flex justify-center items-center p-2 rounded-md bg-green-500 hover:bg-green-700 shadow-md cursor-pointer">
                        Tambah
                    </button>
                </div>
            </form>
            
        </article>
        
    @endif
    {{-- overlay btn add --}}

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
    
</section>