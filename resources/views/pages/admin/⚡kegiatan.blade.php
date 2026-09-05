<?php

use Livewire\Component;
use App\Models\kegiatan;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

new class extends Component
{
    use WithFileUploads;

    public $kegiatan, $judul, $gambar, $deskripsi, $tanggal, $kegiatanId, $currentImage;

    public $overlayAddKegiatan = false;
    public $overlayEditKegiatan = false;

    public $editSuccess;
    public $editGagal;
    public $deleteSuccess;
    public $deleteGagal;

    // load data
    public function loadKegiatan()
    {
        $this->kegiatan = kegiatan::all();
    }
    // load data

    // function mount
    public function mount()
    {
        $this->loadKegiatan();
    }
    // function mount

    // function Button
    public function btnOpenAddKegiatan()
    {
        $this->overlayAddKegiatan = true;
    }

    public function btnCloseAddKegiatan()
    {
        $this->overlayAddKegiatan = false;
    }

    public function btnOpenEditKegiatan($id)
    {
        $kegiatan = kegiatan::findOrFail($id);
        $this->kegiatanId = $kegiatan->id;
        $this->judul = $kegiatan->judul;
        $this->currentImage = $kegiatan->gambar;
        $this->deskripsi = $kegiatan->deskripsi;
        $this->tanggal = $kegiatan->tanggal;
        $this->gambar = null;

        $this->overlayEditKegiatan = true;
    }

    public function btnCloseEditKegitan()
    {
        $this->overlayEditKegiatan = false;
        $this->reset([
            'kegiatanId',
            'judul',
            'gambar',
            'currentImage',
            'deskripsi',
            'tanggal'
        ]);
    }
    // function Button

    // add function
    // add function

    // update function
    public function updateKegiatan()
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
            // Cek nama model Anda, perhatikan huruf kapital (Kegiatan vs kegiatan)
            $kegiatan = Kegiatan::findOrFail($this->kegiatanId);

            $dataToUpdate = [
                'judul'     => $this->judul,
                'deskripsi' => $this->deskripsi,
                'tanggal'   => $this->tanggal,
            ];

            if ($this->gambar instanceof UploadedFile) {
                $filename = time() . '_' . uniqid() . '.webp';

                $manager = ImageManager::usingDriver(Driver::class);
                $img = $manager->decode(file_get_contents($this->gambar->getRealPath()));
                $img->scaleDown(height: 320);
                $encoded = $img->encode(new WebpEncoder(quality: 80));

                $path = "uploads/kegiatan/{$filename}";
                Storage::disk('public')->put($path, (string) $encoded);

                // Hapus gambar lama
                if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
                    Storage::disk('public')->delete($kegiatan->gambar);
                }

                $dataToUpdate['gambar'] = $path;
            }

            $kegiatan->update($dataToUpdate);

            // Tutup modal menggunakan fungsi yang benar
            $this->btnCloseEditKegitan(); 
            $this->loadKegiatan();
            
            $this->editSuccess = 'Data Berhasil Diedit!';
            $this->editGagal = '';
        } catch (\Throwable $th) {
            $this->editGagal = 'Data Gagal Diedit!';
            $this->editSuccess = '';
        }
    }
    // update function

    // delete function
    public function btnDeleteKegiatan($id)
    {
        try {
            $kegiatan = Kegiatan::findOrFail($id);

            if ($kegiatan->gambar && Storage::disk('public')->exists($kegiatan->gambar)) {
                Storage::disk('public')->delete($kegiatan->gambar);
            }

            $kegiatan->delete();

            $this->loadKegiatan();

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
                'title' => 'Kegiatan'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    <article class="flex flex-none gap-2 items-center">
        <x-bi-activity class="h-5 w-5"/>
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Kegiatan</h1>
    </article>

    <article class="flex flex-wrap w-full gap-4 items-center">
        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-auto p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Kegiatan Karang Taruna</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <button type="button" wire:click="btnOpenAddKegiatan" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </button>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 w-full h-auto gap-2">
                @foreach ($kegiatan as $ke)
                    <!-- WAJIB ADA WIRE:KEY -->
                    <div wire:key="kegiatan-{{ $ke->id }}" class="flex flex-col w-full h-auto gap-2 p-2 bg-[#9CB080] rounded-md shadow-md hover:scale-102 duration-120 ease-in-out transition-transform">
                        <div class="flex gap-2 h-[79%]">
                            <!-- Menampilkan gambar dinamis -->
                            <img src="{{ $ke->gambar ? asset('storage/' . $ke->gambar) : asset('img/foto.jpg') }}" class="w-44 h-28 rounded-md object-cover bg-white shrink-0">
                            <div class="flex flex-col gap-1 w-full">
                                <div class="flex flex-col gap-0.5">
                                    <p class="text-xs font-semibold text-gray-800">Program :</p>
                                    <p class="text-sm font-bold text-gray-800 leading-tight">{{ $ke->judul }}</p>
                                </div>
                                <p class="text-xs line-clamp-3 text-justify text-gray-800 mt-1">{{ $ke->deskripsi }}</p>
                            </div>
                        </div>
                        <div class="flex w-full p-1 justify-between items-center bg-[#618764]/40 rounded-md">
                            <p class="flex text-base font-semibold text-gray-800">{{ $ke->tanggal}}</p>
                            <div class="flex gap-1">
                                <button type="button" wire:click="btnOpenEditKegiatan({{ $ke->id }})" class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-7 h-7 rounded-md shadow-md cursor-pointer" title="Edit">
                                    <x-bi-pencil class="h-4 w-4 text-white"/>
                                </button>
                                <button type="button" wire:click="btnDeleteKegiatan({{ $ke->id }})" class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-7 h-7 rounded-md shadow-md cursor-pointer" title="Hapus">
                                    <x-bi-trash class="h-4 w-4 text-white"/>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </article>

    {{-- overlay Add Kegiatan--}}
    @if ($overlayAddKegiatan)
        <article class="fixed flex top-0 left-0 items-center justify-center w-full h-full bg-gray-900/60 z-50 p-4">
            <div class="flex flex-col w-full max-w-2xl bg-white rounded-md shadow-xl overflow-hidden">
                <div class="flex w-full justify-between items-center bg-gray-100 p-4 border-b">
                    <h1 class="font-semibold text-lg text-black capitalize">Tambah Kegiatan</h1>
                    <button wire:click="btnCloseAddKegiatan" class="rounded-full p-1 bg-red-500 hover:bg-red-700 text-white cursor-pointer"><x-css-close class="w-4 h-4" /></button>
                </div>

                <div class="p-4 overflow-y-auto max-h-[80vh]">
                    <form action="{{ route('admin.kegiatan.store') }}" method="POST" class="flex flex-col gap-4" enctype="multipart/form-data">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label class="text-sm font-semibold text-gray-800">Judul</label>
                            <input type="text" name="judul" required placeholder="Masukkan Judul Kegiatan" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label class="text-sm font-semibold text-gray-800 pt-2">Image</label>
                            <div class="md:col-span-3">
                                <input type="file" name="gambar" required accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                <p class="mt-1 text-xs text-gray-500">Format: JPG, JPEG, PNG, WEBP. Tinggi maks disarankan 320px. Maks 2 MB.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label class="text-sm font-semibold text-gray-800">Deskripsi</label>
                            <textarea rows="3" name="deskripsi" required placeholder="Masukkan Deskripsi Kegiatan" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 resize-none"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label class="text-sm font-semibold text-gray-800">Tanggal</label>
                            <input type="date" name="tanggal" required class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="submit" class="bg-green-500 hover:bg-green-700 text-white px-6 py-2 rounded-md shadow-md font-semibold">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </article>
    @endif
    {{-- overlay Add Kegiatan --}}

    {{-- overlay Edit Kegiatan --}}
    @if ($overlayEditKegiatan)
        <article class="fixed flex top-0 left-0 items-center justify-center w-full h-full bg-gray-900/60 z-50 p-4">
            <div class="flex flex-col w-full max-w-2xl bg-white rounded-md shadow-xl overflow-hidden">
                <div class="flex w-full justify-between items-center bg-gray-100 p-4 border-b">
                    <h1 class="font-semibold text-lg text-black capitalize">Edit Kegiatan</h1>
                    <button type="button" wire:click="btnCloseEdit" class="rounded-full p-1 bg-red-500 hover:bg-red-700 text-white cursor-pointer"><x-css-close class="w-4 h-4" /></button>
                </div>

                <div class="p-4 overflow-y-auto max-h-[80vh]">
                    <!-- PERBAIKAN TYPO wire:submit.prevent -->
                    <form wire:submit.prevent="updateKegiatan" class="flex flex-col gap-4">
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label class="text-sm font-semibold text-gray-800">Judul</label>
                            <input type="text" wire:model="judul" required class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label class="text-sm font-semibold text-gray-800 pt-2">Image</label>
                            <div class="md:col-span-3">
                                <input type="file" wire:model="gambar" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-50 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                @error('gambar') <span class="text-sm text-red-500 block mt-1">{{ $message }}</span> @enderror

                                <!-- Preview Logic -->
                                <div class="mt-2 flex gap-2">
                                    @if ($gambar)
                                        <img src="{{ $gambar->temporaryUrl() }}" class="w-28 h-20 object-cover rounded-md border border-green-500">
                                    @elseif ($currentImage)
                                        <img src="{{ asset('storage/' . $currentImage) }}" class="w-28 h-20 object-cover rounded-md border border-gray-300">
                                    @endif
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Biarkan kosong jika tidak ingin mengubah gambar.</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label class="text-sm font-semibold text-gray-800 pt-2">Deskripsi</label>
                            <textarea rows="3" wire:model="deskripsi" required class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 resize-none"></textarea>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label class="text-sm font-semibold text-gray-800">Tanggal</label>
                            <input type="date" wire:model="tanggal" required class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>

                        <div class="flex justify-end mt-4">
                            <!-- Perbaikan warna tombol menjadi kuning (Edit) -->
                            <button type="submit" class="bg-yellow-500 hover:bg-yellow-600 text-white px-6 py-2 rounded-md shadow-md font-semibold">Edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </article>
    @endif
    {{-- overlay Edit Kegiatan --}}

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