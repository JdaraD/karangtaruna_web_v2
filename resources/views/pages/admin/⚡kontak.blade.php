<?php

use Livewire\Component;
use App\Models\kontakAdmin;
use App\Models\KontakBantuan;

new class extends Component
{
    public $name, $gmail, $no_hp, $wilayah;

    public $kontakAdmin;
    public $kontakAdminId;

    public $KontakBantuan;
    public $KontakBantuanId;

    public $overlayAdmin = false;
    public $overlayEditAdmin = false;
    public $overlayBantuan = false;
    public $overlayEditBantuan = false;

    public $deleteSuccess;
    public $deleteGagal;
    public $editSuccess;
    public $editGagal;

    // laod data
    public function loadKontakAdmin()
    {
        $this->kontakAdmin = kontakAdmin::get();
    }
    
    public function loadKontakBantuan()
    {
        $this->KontakBantuan = KontakBantuan::get();

    }
    // laod data

    public function mount()
    {
        $this->loadKontakAdmin();
        $this->loadKontakBantuan();
    }

    // function button
    public function btnOpenAdmin()
    {
        $this->overlayAdmin = true;
    }

    public function btnCloseAdmin()
    {
        $this->overlayAdmin = false;
    }

    public function btnOpenBantuan()
    {
        $this->overlayBantuan = true;
    }

    public function btnCloseBantuan()
    {
        $this->overlayBantuan = false;
    }

    public function btnOpenEditAdmin($id)
    {
        $kontakAdmin = kontakAdmin::findOrFail($id);

        $this->kontakAdminId = $kontakAdmin->id;
        $this->name = $kontakAdmin->name;
        $this->gmail = $kontakAdmin->gmail;
        $this->no_hp = $kontakAdmin->no_hp;

        $this->overlayEditAdmin = true;
    }

    public function btnCloseEditAdmin()
    {
        $this->overlayEditAdmin = false;
        $this->reset([
            'kontakAdminId',
            'name',
            'gmail',
            'no_hp',
        ]);
    }

    public function btnOpenEditBantuan($id)
    {
        $KontakBantuan = KontakBantuan::findOrFail($id);

        $this->KontakBantuanId = $KontakBantuan->id;
        $this->wilayah = $KontakBantuan->wilayah;
        $this->name = $KontakBantuan->name;
        $this->no_hp = $KontakBantuan->no_hp;

        $this->overlayEditBantuan = true;
    }

    public function btnCloseEditBantuan()
    {
        $this->overlayEditBantuan = false;
        $this->reset([
            'KontakBantuanId',
            'wilayah',
            'name',
            'no_hp'
        ]);
    }
    // function button

    // function Update
    public function updateAdmin()
    {
        $this->validate([
            'name' => 'required',
            'gmail' => 'required',
            'no_hp' => 'required'
        ]);

        try {
            $kontakAdmin = kontakAdmin::findOrFail(
                $this->kontakAdminId
            );

            $kontakAdmin->update([
                'name' => $this->name,
                'gmail' => $this->gmail,
                'no_hp' => $this->no_hp
            ]);

            $this->loadKontakAdmin();

            $this->editSuccess = 'Data Berhasil Diedit!';
            $this->editGagal = '';
            $this->overlayEditAdmin = false;
        } catch (\Throwable $th) {
            $this->editGagal = 'Data Gagal Diedit!';
            $this->editSuccess = '';
            
        }
    }

    public function updateBantuan()
    {
        $this->validate([
            'wilayah' => 'required',
            'name' => 'required',
            'no_hp' => 'required'
        ]);

        try {
            $KontakBantuan = KontakBantuan::findOrFail(
                $this->KontakBantuanId
            );

            $KontakBantuan->update([
                'wilayah' => $this->wilayah,
                'name' => $this->name,
                'no_hp' => $this->no_hp
            ]);

            $this->loadKontakBantuan();

            $this->editSuccess = 'Data Berhasil Diedit!';
            $this->editGagal = '';
            $this->overlayEditBantuan = false;
        } catch (\Throwable $th) {
            // $this->editGagal = 'Data Gagal Diedit!';
            // $this->editSuccess = '';
            dd($th->getMessage());

        }
    }
    // function Update

    // function Delete
    public function btndeleteAdmin($id)
    {
        try {
            $kontakAdmin = kontakAdmin::findOrFail($id);
            $kontakAdmin->delete();

            $this->loadKontakAdmin();

            $this->deleteSuccess = 'Data Berhasil Dihapus!';
            $this->deleteGagal = '';
        } catch (\Throwable $th) {
            $this->deleteGagal = 'Data Gagal Dihapus!';
            $this->deleteSuccess = '';
        }
    }

    public function btnDeleteBantuan($id)
    {
        try {
            $KontakBantuan = KontakBantuan::findOrFail($id);
            $KontakBantuan->delete();

            $this->loadKontakBantuan();

            $this->deleteSuccess = 'Data Berhasil Dihapus!';
            $this->deleteGagal = '';
        } catch (\Throwable $th) {
            $this->deleteGagal = 'Data Gagal Dihapus!';
            $this->deleteSuccess = '';
        }
    }
    // function Delete
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.admin', [
                'title' => 'Kontak'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    <article class="flex flex-none gap-2 items-center">
        <x-gmdi-contact-phone class="h-6 w-6" />
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Kontak</h1>
    </article>

    <article class="grid md:grid-cols-1 grid-cols-1 w-full gap-4 items-center">

        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-fit p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">kontak admin</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <button type="button" wire:click="btnOpenAdmin" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </button>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 md:grid-cols-3 grid-cols-1 w-full 3xl:h-70 lg:h-40 md:h-40 h-56 gap-2 p-2 overflow-y-auto scrollbar-none">
                @foreach ($kontakAdmin as $ka)
                    <div class="flex w-full max-h-26 h-full gap-2 p-2 bg-[#9CB080] rounded-md shadow-md hover:scale-102 duration-120 ease-in-out transition-transform">
                        <div class="flex w-full h-full flex-col gap-1">
                            <div class="flex gap-1 p-1 justify-between items-center bg-[#618764]/40 rounded-md">
                                <p class="text-base font-semibold capitalize">{{ $ka->name }}</p>
                                <div class="flex gap-1">
                                    <button wire:click="btnOpenEditAdmin({{ $ka->id }})" class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                                        <x-bi-pencil class="h-4 w-4 text-white"/>
                                    </button>
                                    <button wire:click="btndeleteAdmin({{ $ka->id }})" class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                                        <x-bi-trash class="h-4 w-4 text-white"/>
                                    </button>
                                </div>
                            </div>
                            <div class="flex gap-2 items-center">
                                <p class="text-base font-semibold text-justify line-clamp-4">Gmail :</p>
                                <p class="text-base font-semibold text-justify line-clamp-4">{{ $ka->gmail }}</p>
                            </div>
                            <div class="flex gap-2 items-center">
                                <p class="text-base font-semibold text-justify line-clamp-4">Nomor Hp :</p>
                                <p class="text-base font-semibold text-justify line-clamp-4">{{ $ka->no_hp }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-fit p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">kontak Bantuan</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <button type="button" wire:click="btnOpenBantuan" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </button>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 md:grid-cols-3 grid-cols-1 w-full 3xl:h-70 lg:h-40 md:h-40 h-56 gap-2 p-2 overflow-y-auto scrollbar-none">
                @foreach ($KontakBantuan as $kb)
                    <div class="flex w-full max-h-26 h-full gap-2 p-2 bg-[#9CB080] rounded-md shadow-md hover:scale-102 duration-120 ease-in-out transition-transform">
                        <div class="flex w-full h-full flex-col gap-1">
                            <div class="flex gap-1 p-1 justify-between items-center bg-[#618764]/40 rounded-md">
                                <p class="text-base font-semibold capitalize">{{ $kb->wilayah }}</p>
                                <div class="flex gap-1">
                                    <button wire:click="btnOpenEditBantuan({{ $kb->id }})" class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                                        <x-bi-pencil class="h-4 w-4 text-white"/>
                                    </button>
                                    <button wire:click="btnDeleteBantuan({{ $kb->id }})" class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                                        <x-bi-trash class="h-4 w-4 text-white"/>
                                    </button>
                                </div>
                            </div>
                            <div class="flex gap-2 items-center">
                                <p class="text-base font-semibold text-justify line-clamp-4">{{ $kb->name }} :</p>
                                <p class="text-base font-semibold text-justify line-clamp-4">{{ $kb->no_hp }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </article>

    {{-- overlayAdd Admin --}}
    @if ($overlayAdmin)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Tambah Kontak Admin</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button wire:click="btnCloseAdmin" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form action="{{ route('kontakAdmin.store') }}" method="POST" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="name" class="text-sm font-semibold text-gray-800">
                                Nama admin
                            </label>
    
                            <input type="text" name="name" id="name" placeholder="Masukkan Nama Admin" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="gmail" class="text-sm font-semibold text-gray-800 pt-2">
                                Gmail
                            </label>
    
                           <input type="text" name="gmail" id="gmail" placeholder="Masukkan Gmail" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
        
    @endif
    {{-- overlayAdd Admin --}}

    {{-- overlayEdit Admin --}}
    @if ($overlayEditAdmin)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Edit Kontak Admin</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button type="button" wire:click="btnCloseEditAdmin" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="updateAdmin" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="name" class="text-sm font-semibold text-gray-800">
                                Nama admin
                            </label>
    
                            <input type="text" wire:model="name" name="name" id="name" placeholder="Masukkan Nama Admin" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="gmail" class="text-sm font-semibold text-gray-800 pt-2">
                                Gmail
                            </label>
    
                           <input type="text" name="gmail" wire:model="gmail" id="gmail" placeholder="Masukkan Gmail" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="no_hp" class="text-sm font-semibold text-gray-800 pt-2">
                                Nomor Hp
                            </label>
    
                           <input type="text" name="no_hp" id="no_hp" wire:model="no_hp" placeholder="Masukkan Nomor Hp (08xxxxxxxx)" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="20" inputmode="numeric" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
    {{-- overlayEdit Admin --}}

    {{-- overlayAdd Bantuan --}}
    @if ($overlayBantuan)
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
        
    @endif
    {{-- overlayAdd Bantuan --}}

    {{-- overlayEdit Bantuan--}}
    @if ($overlayEditBantuan)
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
        
    @endif
    {{-- overlayEdit Bantuan --}}

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