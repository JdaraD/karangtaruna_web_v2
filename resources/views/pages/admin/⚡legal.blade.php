<?php

use Livewire\Component;
use App\Models\legal;
use App\Models\pasal;

new class extends Component
{
    public $legal, $legalId, $name, $paragraf, $pasal, $isi_pasal;
    public $selectedPasalId = null; // Menggantikan $pasalId
    public $isSelectModePasal = false;
    public $actionTypePasal = '';

    public $overlayAddLegal = false;
    public $overlayEditLegal = false;
    public $overlayAddPasal = false;
    public $overlayEditPasal = false;

    public $deleteSuccess;
    public $deleteGagal;
    public $editSuccess;
    public $editGagal;

    // data set
    public function setSelectModePasal($action)
    {
        $this->isSelectModePasal = true;
        $this->actionTypePasal = $action;
    }

    public function cancelSelectModePasal()
    {
        $this->isSelectModePasal = false;
        $this->actionTypePasal = '';
        $this->selectedPasalId = null;
    }
    // data set

    // load data
    public function loadLegal()
    {
        $this->legal = legal::get();
    }

    public function loadPasal()
    {
        $this->pasal = pasal::get();
    }
    // load data

    // function mount
    public function mount()
    {
        $this->loadLegal();
        $this->loadPasal();
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

    public function btnOpenAddPasal()
    {
        $this->overlayAddPasal = true;
    }

    public function btnCloseAddPasal()
    {
        $this->overlayAddPasal = false;
    }

    public function btnOpenEditPasal()
    {
        if (!$this->selectedPasalId) {
            $this->editGagal = 'Pilih salah satu pasal terlebih dahulu!';
            return;
        }

        $pasal = Pasal::find($this->selectedPasalId);
        
        if ($pasal) {
            $this->isi_pasal = $pasal->isi_pasal;
            $this->overlayEditPasal = true;
            $this->isSelectModePasal = false; 
        }
    }

    public function btnCloseEditPasal()
    {
        $this->overlayEditPasal = false;
        $this->selectedPasalId = null;
        $this->actionTypePasal = '';
        $this->isi_pasal = '';
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

    public function updatePasal()
    {
        $this->validate([
            'isi_pasal' => 'required'
        ]);

        try {
            $pasal = Pasal::findOrFail($this->selectedPasalId);

            $pasal->update([
                'isi_pasal' => $this->isi_pasal
            ]);

            $this->editSuccess = 'Data Pasal Berhasil Diedit!';
            $this->editGagal = '';

            $this->overlayEditPasal = false;
            $this->isSelectModePasal = false;
            $this->selectedPasalId = null;
            $this->isi_pasal = '';
            $this->actionTypePasal = ''; 
            
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

    public function deletePasal()
    {
        if (!$this->selectedPasalId) {
            $this->editGagal = 'Pilih salah satu pasal terlebih dahulu untuk dihapus!';
            return; 
        }

        try {
            $pasal = Pasal::findOrFail($this->selectedPasalId);
            $pasal->delete();
            
            $this->isSelectModePasal = false;
            $this->selectedPasalId = null;
            $this->actionTypePasal = '';
            
            $this->editSuccess = 'Data Berhasil Dihapus!';
            $this->editGagal = '';
        } catch (\Throwable $th) {
            $this->editGagal = 'Data Gagal Dihapus!';
            $this->editSuccess = '';
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
                    
                    <!-- Jika tidak dalam mode pilih Pasal -->
                    @if(!$isSelectModePasal)
                        <button type="button" wire:click="btnOpenAddPasal" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah">
                            <x-bi-plus class="h-6 w-6 text-white"/>
                        </button>
                        <button type="button" wire:click="setSelectModePasal('edit')" class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Edit">
                            <x-bi-pencil class="h-4 w-4 text-white"/>
                        </button>
                        <button type="button" wire:click="setSelectModePasal('delete')" class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                            <x-bi-trash class="h-4 w-4 text-white"/>
                        </button>
                    @else
                        <!-- Tombol Batal -->
                        <button type="button" wire:click="cancelSelectModePasal" class="px-2 py-1 text-xs text-white bg-gray-500 hover:bg-gray-700 rounded-md shadow-md cursor-pointer">
                            Batal
                        </button>
                        
                        <!-- HANYA MUNCUL JIKA KLIK PENSIL -->
                        @if($actionTypePasal === 'edit')
                            <button type="button" wire:click="btnOpenEditPasal" class="px-2 py-1 text-xs text-white bg-yellow-500 hover:bg-yellow-700 rounded-md shadow-md cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed" @if(!$selectedPasalId) disabled @endif>
                                Pilih & Edit
                            </button>
                        @endif

                        <!-- HANYA MUNCUL JIKA KLIK SAMPAH -->
                        @if($actionTypePasal === 'delete')
                            <button type="button" wire:click="deletePasal" class="px-2 py-1 text-xs text-white bg-red-500 hover:bg-red-700 rounded-md shadow-md cursor-pointer disabled:opacity-50 disabled:cursor-not-allowed" @if(!$selectedPasalId) disabled @endif>
                                Pilih & Hapus
                            </button>
                        @endif
                    @endif

                </div>
            </div>
            
            <div class="flex w-full h-60 overflow-y-auto scrollbar-none">
                <ul class="flex flex-col gap-3 list-disc">
                    @foreach ($pasal as $p)
                    <li wire:poll.1s class="flex items-start gap-3"> 
                        
                        @if($isSelectModePasal)
                            <!-- Berubah menjadi Radio Button Pasal -->
                            <input type="radio" wire:model.live="selectedPasalId" value="{{ $p->id }}" class="mt-1 lg:w-4 w-3 lg:h-4 h-3 shrink-0 cursor-pointer accent-[#9CB080]">
                        @else
                            <!-- Buletan Hijau Default -->
                            <div class="mt-1.5 lg:w-4 w-2 lg:h-4 h-2 shrink-0 bg-[#9CB080] rounded-full"></div>
                        @endif

                        <span class="text-black lg:text-sm text-xs text-justify">{{ $p->isi_pasal }}</span>
                    </li>
                    @endforeach
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

    {{-- overlayAdd Pasal --}}
    @if ($overlayAddPasal)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Tambah Pasal</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button wire:click="btnCloseAddPasal" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form action="{{ route('admin.pasal.store') }}" method="POST" class="flex flex-col gap-4">
                    @csrf
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="isi_pasal" class="text-sm font-semibold text-gray-800 pt-2">
                                Pasal
                            </label>
    
                           <input type="text" name="isi_pasal" id="isi_pasal" placeholder="Masukkan Isi Pasal" class="md:col-span-3 w-80 rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
    {{-- overlayAdd Pasal --}}

    {{-- overlayEdit Pasal--}}
    @if ($overlayEditPasal)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Edit Pasal</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button type="button" wire:click="btnCloseEditPasal" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="updatePasal" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="isi_pasal" class="text-sm font-semibold text-gray-800 pt-2">
                                Pasal
                            </label>
    
                           <input type="text" name="isi_pasal" wire:model="isi_pasal" id="isi_pasal" placeholder="Masukkan Isi Pasal" class="md:col-span-3 w-80 rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
    {{-- overlayEdit Pasal--}}

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