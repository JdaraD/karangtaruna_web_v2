<?php

use Livewire\Component;
use App\Models\sponsor;

new class extends Component
{
    public $sponsor, $sponsorId, $name, $image, $currentImage;

    public $overlayAddSponsor = false;
    public $overlayEditSponsor = false;

    public $deleteSuccess;
    public $deleteGagal;
    public $editSuccess;
    public $editGagal;
    
    // function Load Data
    public function loadSponsor()
    {
        $this->sponsor = sponsor::all();
    }
    // function Load Data
    
    // function Mount
    public function mount()
    {
        $this->loadSponsor();
    }
    // function Mount

    // function Button
    public function btnOpenAddSponsor()
    {
        $this->overlayAddSponsor = true;
    }

    public function btnCloseAddSponsor()
    {
        $this->overlayAddSponsor = false;
    }

    public function btnOpenEditSponsor($id)
    {
        $sponsor = sponsor::findOrFail($id);
        $this->sponsorId = $sponsor->id;
        $this->name = $sponsor->name;
        $this->currentImage = $sponsor->image;
        $this->image = null;

        $this->overlayEditSponsor = true;
    }

    public function btnCloseEditSponsor()
    {
        $this->overlayEditSponsor = false;
        $this->reset([
            'sponsrId',
            'name',
            'currenImage',
            'image'
        ]);
    }
    // function Button

    // add function
    // add function

    // update function
    public function updateSponsor()
    {
        $rules = [
            'name' => 'required'
        ];

        $isNewImageUploaded = $this->image instanceof UploadedFile;

        if ($isNewImageUploaded) {
            $rules['image'] = 'image|mimes:png,jpg,jpeg,webp|max:2048';
        }

        $this->validate($rules);

        try {
            $sponsor = Sponsor::findOrFail($this->sponsorId);

            $dataToUpdate = [
                'name' => $this->name,
            ];

            if ($this->image instanceof UploadedFile) {
                $filename = time() . '_' . uniqid() . '.webp';

                $manager = ImageManager::usingDriver(Driver::class);
                $image = $manager->decode(file_get_contents($this->image->getRealPath()));
                $image->scaleDown(width: 2800, height: 900);
                $encoded = $image->encodeUsingFormat(Format::WEBP, quality: 80);

                $path = "uploads/sponsors/{$filename}";
                Storage::disk('public')->put($path, (string) $encoded);

                if ($sponsor->image && Storage::disk('public')->exists($sponsor->image)) {
                    Storage::disk('public')->delete($sponsor->image);
                }

                $dataToUpdate['image'] = $path;
            }

            $sponsor->update($dataToUpdate); 

            $this->overlayEditSponsor = false;
            $this->image = null;
            $this->currentImage = null;

            $thia->loadSponsor();
            
            $this->editSuccess = 'Data Berhasil Diedit!';
            $this->editGagal = '';
        } catch (\Throwable $th) {
            $this->editGagal = 'Data Gagal Diedit!';
            $this->editSuccess = '';
        }
    }
    // update function

    // delete function
    public function btnDeleteSponsor($id)
    {
        try {
            $sponsor = Sponsor::findOrFail($id);
            
            if ($sponsor->image && Storage::disk('public')->exists($sponsor->image)) {
                Storage::disk('public')->delete($sponsor->image);
            }

            $sponsor->delete();

            $this->loadSponsor();

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
                'title' => 'Sponsor'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    
    <article class="flex flex-none gap-2 items-center">
        <x-si-githubsponsors class="h-5 w-5"/>
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Sponsor</h1>
    </article>

    <article class="flex flex-col justify-stretch items-center w-full gap-4 h-auto p-4 bg-white rounded-md shadow-md overflow-hidden">
        <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
            <div class="flex w-full h-auto gap-1 items-center">
                <h1 class="font-semibold text-base text-black capitalize">Sponsor</h1>
            </div>
            <div class="flex w-full h-auto gap-1 justify-end items-center">
                <button type="button" wire:click="btnOpenAddSponsor" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah Sponsor">
                    <x-bi-plus class="h-6 w-6 text-white"/>
                </button>
            </div>
        </div>

        <div wire.poll.1s class="flex gap-4 justify-start w-full max-w-300 scrollbar-none overflow-x-auto p-2">
            @forelse ($sponsor as $sp)
                <div class="flex flex-none flex-col gap-2 justify-center items-center rounded-md w-44 p-4 h-auto shadow-md bg-gray-200">
                    <div class="flex w-full h-auto justify-between items-center bg-gray-100 rounded-md px-2 py-1">
                        <p class="text-sm font-semibold capitalize text-black truncate" title="{{ $sp->name }}">{{ $sp->name }}</p>
                    </div>
                    
                    @if ($sp->image)
                        <img src="{{ asset('storage/' . $sp->image) }}" alt="{{ $sp->name }}" class="h-24 w-28 object-cover rounded-md">
                    @else
                        <img src="{{ asset('img/logo.png') }}" alt="Default Logo" class="h-24 w-28 object-cover rounded-md">
                    @endif

                    <div class="flex w-full h-auto gap-2 justify-end items-center">
                        <button type="button" wire:click="btnOpenEditSponsor({{ $sp->id }})" class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Edit">
                            <x-bi-pencil class="h-4 w-4 text-white"/>
                        </button>
                        <button type="button" wire:click="btnDeleteSponsor({{ $sp->id }})" class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                            <x-bi-trash class="h-4 w-4 text-white"/>
                        </button>
                    </div>
                </div>
            @empty
                <p class="text-sm text-gray-500 py-4">Belum ada data sponsor.</p>
            @endforelse
        </div>
    </article>

    {{-- overlay Add Sponsor --}}
    @if ($overlayAddSponsor)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Tambah Sponsor</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button type="button" wire:click="btnCloseSponsor" class="rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3 text-white" />
                        </button>
                    </div>
                </div>

                <form action="{{ route('admin.sponsor.store') }}" method="POST" class="flex flex-col gap-4" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="name" class="text-sm font-semibold text-gray-800">Nama</label>
                            <input type="text" name="name" required id="name" placeholder="Masukkan Nama Sponsor" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
        
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="image" class="text-sm font-semibold text-gray-800 pt-2">Image</label>
                            <div class="md:col-span-3">
                                <input type="file" name="image" required id="image" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                @error('image')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror
                                <p class="mt-1 text-xs text-gray-500">
                                    Format: JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                                </p>
                            </div>
                        </div>
                    </div>
        
                    <div class="flex w-full h-full justify-end items-end">
                        <button type="submit" class="flex justify-center items-center px-4 py-2 rounded-md bg-green-500 hover:bg-green-700 text-white shadow-md cursor-pointer">
                            Tambah
                        </button>
                    </div>
                </form>
            </div>
        </article>
    @endif
    {{-- overlay Add Sponsor --}}

    {{-- overlay Edit Sponsor --}}
    @if ($overlayEditSponsor)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Edit Sponsor</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button type="button" wire:click="btnCloseEditSponsor" class="rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3 text-white" />
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="updateSponsor" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="edit_name" class="text-sm font-semibold text-gray-800">Nama</label>
                            <input type="text" wire:model="name" id="edit_name" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
        
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="edit_image" class="text-sm font-semibold text-gray-800 pt-2">Image</label>
                            <div class="md:col-span-3">
                                <input type="file" wire:model="image" id="edit_image" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600">

                                @error('image')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror

                                @if ($currentImage)
                                    <div class="mt-2">
                                        <p class="text-xs text-gray-500 mb-1">Gambar Saat Ini:</p>
                                        <img src="{{ asset('storage/' . $currentImage) }}" class="w-28 h-20 object-cover rounded-md">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
        
                    <div class="flex w-full h-full justify-end items-end">
                        <button type="submit" class="flex justify-center items-center px-4 py-2 rounded-md bg-green-500 hover:bg-green-700 text-white shadow-md cursor-pointer">
                            Edit
                        </button>
                    </div>
                </form>
            </div>
        </article>
    @endif
    {{-- overlay Edit Sponsor --}}

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