<?php

use Livewire\Component;
use App\Models\event;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

new class extends Component
{
    use WithFileUploads;

    public $judul, $deskripsi, $tanggal, $gambar, $currentImage, $eventId, $events;

    public $overlayAddEvent = false;
    public $overlayEditEvent = false;

    public $editSuccess;
    public $editGagal;
    public $deleteSuccess;
    public $deleteGagal;

    // load data
    public function loadEvent()
    {
        $this->events = event::all();
    }
    // load data

    // function mount
    public function mount()
    {
        $this->loadEvent();
    }
    // function mount

    // function Button
    public function btnAddEvent()
    {
        $this->overlayAddEvent = true;
    }

    public function btnCloseAddEvent()
    {
        $this->overlayAddEvent = false;
    }

    public function btnEditEvent($id)
    {
        $event = event::findOrFail($id);
        $this->eventId = $event->id;
        $this->judul = $event->judul;
        $this->deskripsi = $event->deskripsi;
        $this->tanggal = $event->tanggal;
        $this->currentImage = $event->gambar;

        $this->overlayEditEvent = true;
    }

    public function btnCloseEditEvent()
    {
        $this->overlayEditEvent = false;
        $this->reset([
            'judul', 
            'deskripsi', 
            'tanggal', 
            'gambar', 
            'currentImage', 
            'eventId'
            ]);
    }
    // function Button

    // add function
    // add function

    // update function
    public function updateEvent()
    {
        $rules = [
            'judul'     => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal'   => 'required|date',
        ];

        if ($this->gambar instanceof UploadedFile) {
            $rules['gambar'] = 'image|mimes:png,jpg,jpeg,webp|max:2048';
        }

        $this->validate($rules);

        try {
            $event = Event::findOrFail($this->eventId);

            $dataToUpdate = [
                'judul'     => $this->judul,
                'deskripsi' => $this->deskripsi,
                'tanggal'   => $this->tanggal,
            ];

            // Jika ada unggahan gambar baru
            if ($this->gambar instanceof UploadedFile) {
                $filename = time() . '_' . uniqid() . '.webp';

                $manager = ImageManager::usingDriver(Driver::class);
                $img = $manager->decode(file_get_contents($this->gambar->getRealPath()));
                $img->scaleDown(height: 320);
                $encoded = $img->encode(new WebpEncoder(quality: 80));

                $path = "uploads/events/{$filename}";
                Storage::disk('public')->put($path, (string) $encoded);

                // Hapus gambar lama
                if ($event->gambar && Storage::disk('public')->exists($event->gambar)) {
                    Storage::disk('public')->delete($event->gambar);
                }

                $dataToUpdate['gambar'] = $path;
            }

            $event->update($dataToUpdate);

            $this->btnCloseEditEvent();
            $this->loadEvent(); 
            
            $this->editSuccess = 'Data Berhasil Diedit!';
            $this->editGagal = '';
        } catch (\Throwable $th) {
            $this->editSuccess = '';
            $this->editGagal = 'Gagal memperbarui event!';
        }
    }
    // update function

    // delete function
    public function btnDeleteEvent($id)
    {
        try {
            $event = Event::findOrFail($id);

            // Hapus file gambar
            if ($event->gambar && Storage::disk('public')->exists($event->gambar)) {
                Storage::disk('public')->delete($event->gambar);
            }

            $event->delete();

            $this->loadEvent();

            $this->deleteSuccess = 'Data Berhasil Dihapus!';
            $this->deleteGagal = '';
        } catch (\Throwable $th) {
            $this->deleteSuccess = '';
            $this->deleteGagal = 'Gagal menghapus event!';
        }
    }
    // delete function
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.admin', [
                'title' => 'Event'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    <article class="flex flex-none gap-2 items-center">
        <x-bi-calendar-event-fill class="h-6 w-6" />
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Event</h1>
    </article>

    <article class="flex flex-wrap w-full gap-4 items-center">

        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-fit p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Event</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <button type="button" wire:click="btnAddEvent" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </button>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 w-full 3xl:max-h-210 3xl:h-full lg:mx-h-124 lg:h-full md:max-h-124 md:h-full h-64 gap-2 p-2 overflow-y-auto scrollbar-none">
                @foreach ($events as $event)
                    <div class="flex w-full h-36.75 gap-2 p-2 bg-[#9CB080] rounded-md shadow-md hover:scale-102 duration-120 ease-in-out transition-transform">
                        <div class="flex w-[46%] h-full">
                            <img src="{{ asset('storage/'. $event->gambar) }}" alt="" class="w-full h-32 object-cover rounded-md">
                        </div>
                        <div class="flex w-full h-full flex-col gap-1">
                            <div class="flex gap-1 p-1 justify-between items-center bg-[#618764]/40 rounded-md">
                                <p class="text-base font-semibold capitalize">{{ $event->judul }}</p>
                                <div class="flex gap-1">
                                    <button type="button" wire:click="btnEditEvent({{ $event->id }})" class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                                        <x-bi-pencil class="h-4 w-4 text-white"/>
                                    </button>
                                    <button type="button" wire:click="btnDeleteEvent({{ $event->id }})" class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                                        <x-bi-trash class="h-4 w-4 text-white"/>
                                    </button>
                                </div>
                            </div>
                            <p class="text-base font-semibold text-justify line-clamp-4">{{ $event->deskripsi }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </article>

    {{-- overlay Add Event--}}
    @if ($overlayAddEvent)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Tambah Event</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button wire:click="btnCloseAddEvent" class="top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form action="{{ route('admin.events.store') }}" method="POST" class="flex flex-col gap-4" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="judul" class="text-sm font-semibold text-gray-800">
                                Judul
                            </label>
    
                            <input type="text" name="judul" required id="judul" placeholder="Masukkan Judul Event" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="gambar" class="text-sm font-semibold text-gray-800 pt-2">
                                Image
                            </label>
    
                               <div class="md:col-span-3">
                                    <input type="file" name="gambar" required id="gambar" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                    @error('gambar')
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror

                                    <p class="mt-1 text-xs text-gray-500">
                                        Format: JPG, JPEG, PNG, atau WEBP. Ukuran 520x320. Maksimal 2 MB.
                                    </p>
                                </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="deskripsi" class="text-sm font-semibold text-gray-800">
                                Deskripsi
                            </label>
    
                            <textarea cols="4" rows="2" name="deskripsi" required id="deskripsi" placeholder="Masukkan Deskripsi Event" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"></textarea>
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="tanggal" class="text-sm font-semibold text-gray-800 pt-2">
                                Tanggal
                            </label>
    
                           <input type="date" name="tanggal" required id="tanggal" placeholder="Masukkan Tanggal Event" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
    {{-- overlay Add Event --}}

    {{-- overlay Edit Event --}}
    @if ($overlayEditEvent)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Edit Event</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button type="button" wire:click="btnCloseEdit" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="updateEvent" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="judul" class="text-sm font-semibold text-gray-800">
                                Judul
                            </label>
    
                            <input type="text" wire:model="judul" name="judul" required id="judul" placeholder="Masukkan Judul Event" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="gambar" class="text-sm font-semibold text-gray-800 pt-2">
                                Image
                            </label>
    
                               <div class="md:col-span-3">
                                    <input type="file" name="gambar" wire:model="gambar" id="gambar" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                    @error('gambar')
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror

                                    @if ($currentImage)
                                        <img src="{{ asset('storage/' . $currentImage) }}" class="w-28 h-20 object-cover rounded-md">
                                    @endif
                                    <p class="mt-1 text-xs text-gray-500">
                                        Format: JPG, JPEG, PNG, atau WEBP. Ukuran 520x320. Maksimal 2 MB.
                                    </p>
                                </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="deskripsi" class="text-sm font-semibold text-gray-800">
                                Deskripsi
                            </label>
    
                            <textarea cols="4" rows="2" wire:model="deskripsi" name="deskripsi" required id="deskripsi" placeholder="Masukkan Deskripsi Event" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"></textarea>
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="tanggal" class="text-sm font-semibold text-gray-800 pt-2">
                                Tanggal
                            </label>
    
                           <input type="date" wire:model="tanggal" name="tanggal" required id="tanggal" placeholder="Masukkan Tanggal Event" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
    {{-- overlay Edit Event --}}

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