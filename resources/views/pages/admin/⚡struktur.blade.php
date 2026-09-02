<?php

use Livewire\Component;
use App\Models\strukturOrg;
use App\Models\anggota;
use Livewire\WithFileUploads;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;

new class extends Component
{
    use WithFileUploads;

    public $name, $image, $currentImage, $strukturId, $struktur;

    public $overlayAddStruktur = false;
    public $overlayEditStruktur = false;
    public $overlayAddPengurus = false;
    public $overlayEditPengurus = false;

    public $deleteSuccess;
    public $deleteGagal;
    public $editSuccess;
    public $editGagal;

    // load data
    public function loadStruktur()
    {
        $this->struktur = strukturOrg::latest()
            ->take(1)
            ->get();
    }
    // load data

    // function mount
    public function mount()
    {
        $this->loadStruktur();
    }
    // function mount

    // function Button
    public function btnOpenAddStruktur()
    {
        $this->overlayAddStruktur = true;
    }

    public function btnCloseStruktur()
    {
        $this->overlayAddStruktur = false;
    }

    public function btnOpenEditStruktur($id)
    {
        $struktur = strukturOrg::findOrFail($id);
        
        $this->strukturId = $id;
        $this->name = $struktur->name;
        $this->currentImage = $struktur->image;
        $this->overlayEditStruktur = true;
    }

    public function btnCloseEditStruktur()
    {
        $this->overlayEditStruktur = false;
        $this->reset([
            'name',
            'image',
            'currentImage',
            'strukturId',
        ]);
    }

    public function btnOpenAddPengurus()
    {
        $this->overlayAddPengurus = true;
    }

    public function btnClosePengurus()
    {
        $this->overlayAddPengurus = false;
    }
    // function Button

    // add function
    // add function

    // update function
    public function updateStruktur()
    {
        $rules = [
            'name' => 'required|string|max:255',
        ];

        // Gambar hanya divalidasi jika ada file baru yang diunggah
        if ($this->image instanceof UploadedFile) {
            $rules['image'] = 'image|mimes:png,jpg,jpeg,webp|max:2048';
        }

        $this->validate($rules);

        try {
            $struktur = strukturOrg::findOrFail($this->strukturId);

            $dataToUpdate = [
                'name' => $this->name,
            ];

            // Jika ada pengunggahan gambar baru
            if ($this->image instanceof UploadedFile) {
                $filename = time() . '_' . uniqid() . '.webp';

                // Kompresi & enkode ke format WebP menggunakan Intervention Image v3
                $manager = ImageManager::usingDriver(Driver::class);
                $img = $manager->decode(file_get_contents($this->image->getRealPath()));
                $img->scaleDown(width: 2800, height: 900);
                $encoded = $img->encode(new WebpEncoder(quality: 80));

                $path = "uploads/struktur/{$filename}";
                Storage::disk('public')->put($path, (string) $encoded);

                // Hapus gambar lama jika ada di storage
                if ($struktur->image && Storage::disk('public')->exists($struktur->image)) {
                    Storage::disk('public')->delete($struktur->image);
                }

                $dataToUpdate['image'] = $path;
            }

            $struktur->update($dataToUpdate);

            // Menutup modal dan reset input
            $this->btnCloseEditStruktur();

            // Refresh data yang dikirim ke view
            $this->loadStruktur(); 
            
            $this->editSuccess = 'Data Berhasil Diedit!';
            $this->editGagal = '';
        } catch (\Throwable $th) {
            $this->editSuccess = '';
            $this->editGagal = 'Gagal memperbarui struktur organisasi!';
        }
    }
    // update function

    // delete function
    public function btnDeleteStruktur($id)
    {
        try {
            $struktur = strukturOrg::findOrFail($id);

            // Hapus file gambar dari disk storage terlebih dahulu
            if ($struktur->image && Storage::disk('public')->exists($struktur->image)) {
                Storage::disk('public')->delete($struktur->image);
            }

            $struktur->delete();

            // Refresh data setelah penghapusan
            $this->loadStruktur();

            $this->deleteSuccess = 'Data Berhasil Dihapus!';
            $this->deleteGagal = '';
        } catch (\Throwable $th) {
            $this->deleteSuccess = '';
            $this->deleteGagal = 'Gagal menghapus struktur organisasi!';
        }
    }
    // delete function
    public function render()
    {
        // 1. Cek apakah di database sudah ada yang jabatannya 'ketua'
        $hasKetua = anggota::where('jabatan', 'ketua')->exists();

        // 2. Kirim data $hasKetua ke view
        // Ganti 'livewire.nama-view-anda' dengan nama file view Livewire Anda yang sebenarnya
    return $this->view()
            ->with('hasKetua', $hasKetua)
            ->layout('layouts.admin', [
                'title' => 'struktur'
            ]);
        }
    };
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    <!-- Header Bagian Struktur -->
    <article class="flex flex-none gap-2 items-center">
        <x-css-stack class="h-5 w-5"/>
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Struktur</h1>
    </article>
    
    <!-- 1. Bagian Gambar Bagan Struktur Organisasi -->
    <article class="flex flex-wrap w-full gap-4 items-center">
        <div class="flex flex-col justify-stretch items-center w-full gap-2 p-4 lg:h-76 h-auto bg-white rounded-md shadow-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Bagan Struktur Organisasi</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    @if ($struktur->isEmpty())
                        <button type="button" wire:click="btnOpenAddStruktur" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah">
                            <x-bi-plus class="h-6 w-6 text-white"/>
                        </button>
                    @else
                        @foreach ($struktur as $st)
                            <button type="button" wire:click="btnOpenEditStruktur({{ $st->id }})" class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Edit">
                                <x-bi-pencil class="h-4 w-4 text-white"/>
                            </button>
                            
                            <!-- Ditambahkan wire:click untuk aksi Delete -->
                            <button type="button" wire:click="btnDeleteStruktur({{ $st->id }})" class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                                <x-bi-trash class="h-4 w-4 text-white"/>
                            </button>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="flex justify-center items-center p-2 border border-gray-200 rounded-md w-full bg-gray-50">
                <!-- Menampilkan gambar dinamis dari DB jika ada, fallback ke static jika kosong -->
                @if(isset($st) && $st->image)
                    <img src="{{ asset('storage/' . $st->image) }}" alt="Struktur Organisasi" class="h-54 w-auto object-contain rounded-md shadow-sm">
                @else
                    <div class="h-54 w-auto bg-gray-200 animate-pulse object-contain rounded-md shadow-sm">
                @endif
            </div>
        </div>
    </article>

    <!-- 2. Bagian Informasi Pengurus & Kartu Ketua -->
    <article class="flex flex-wrap w-full gap-4 items-center">
        <div class="flex flex-col justify-stretch items-center w-full gap-4 p-4 lg:h-76 h-full bg-white rounded-md shadow-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <h1 class="font-semibold text-base text-black capitalize">Daftar Anggota / Pengurus Lainnya</h1>
                <div class="flex w-auto gap-1 justify-end items-center">
                    <button type="button" wire:click="btnOpenAddPengurus" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </button>
                    <div class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                        <x-bi-pencil class="h-4 w-4 text-white"/>
                    </div>
                    <div class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer">
                        <x-bi-trash class="h-4 w-4 text-white"/>
                    </div>
                </div>
            </div>
            
            <div class="flex w-full h-full overflow-hidden">
                <div class="flex xl:w-240 lg:w-183.75 md:w-screen w-74 h-full justify-start items-center gap-4 scrollbar-thin overflow-x-auto p-2 rounded-md">
                    @for ($i = 1; $i <= 8; $i++)
                    <div class="relative flex flex-none flex-col lg:w-38 md:w-32 w-22 lg:h-47 md:h-42 h-42 rounded-md shadow-md hover:scale-105 duration-150 transition-transform ease-in-out bg-white border border-gray-200">
                        <div class="w-full h-[90%] flex items-center justify-center p-2">
                            <img src="{{ asset('img/foto.jpg') }}" alt="Pengurus" class="w-full h-full object-contain rounded-md">
                        </div>
                        <div class="w-full h-[10%] flex flex-col justify-center items-center bg-gray-200 rounded-b-md">
                            <p class="text-black font-semibold text-sm normal-case">Sekretaris</p>
                        </div>
                        <div class="absolute top-0 left-0 w-full h-full bg-gray-400 bg-opacity-90 opacity-0 hover:opacity-90 duration-150 transition-opacity ease-in-out rounded-md z-10">
                            <div class="flex flex-col w-full h-full justify-center items-center gap-2 p-2 whitespace-normal">
                                <p class="font-semibold lg:text-base text-xs text-black normal-case justify-center">Nama Pengurus</p>
                                <p class="text-black font-normal text-xs text-center normal-case">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>

            </div>
        </div>

    </article>

    {{-- overlay Add Struktur --}}
    @if ($overlayAddStruktur)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Tambah Struktur</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button wire:click="btnCloseStruktur" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form action="{{ route('admin.struktur.store') }}" enctype="multipart/form-data" method="POST" class="flex flex-col gap-4">
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
    {{-- overlay Add Struktur --}}

    {{-- overlay Edit Struktur --}}
    @if ($overlayEditStruktur)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Edit Struktur</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button type="button" wire:click="btnCloseEditStruktur" class="top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer text-white">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="updateStruktur" class="flex flex-col gap-4">
                    @csrf
                    <div class="flex flex-col w-full gap-5 pt-2">

                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="name" class="text-sm font-semibold text-gray-800">
                                Nama
                            </label>
                            <!-- Ditambahkan wire:model="name" -->
                            <input type="text" name="name" id="name" wire:model="name" placeholder="Masukkan Nama Struktur" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                            @error('name')
                                <span class="text-sm text-red-500 col-span-4">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="image" class="text-sm font-semibold text-gray-800 pt-2">
                                Image
                            </label>

                            <div class="md:col-span-3">
                                <!-- Ditambahkan wire:model="image" dan hapus atribut required agar opsional saat edit -->
                                <input type="file" name="image" id="image" wire:model="image" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                @error('image')
                                    <span class="text-sm text-red-500 block">{{ $message }}</span>
                                @enderror

                                <!-- Preview gambar yang sedang di-upload atau gambar lama -->
                                @if ($image && !$errors->has('image'))
                                    <img src="{{ $image->temporaryUrl() }}" class="w-28 h-20 object-cover rounded-md mt-2">
                                @elseif ($currentImage)
                                    <img src="{{ asset('storage/' . $currentImage) }}" class="w-28 h-20 object-cover rounded-md mt-2">
                                @endif

                                <p class="mt-1 text-xs text-gray-500">
                                    Format: JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                                </p>
                            </div>
                        </div>

                    </div>

                    <div class="flex w-full h-full justify-end items-end">
                        <button type="submit" class="flex justify-center items-center p-2 rounded-md bg-green-500 hover:bg-green-700 text-white font-semibold text-sm shadow-md cursor-pointer">
                            Edit
                        </button>
                    </div>
                </form>
            </div>
        </article>
    @endif
    {{-- overlay Edit Struktur --}}

    {{-- overlay Add Pengurus --}}
    @if ($overlayAddPengurus)
        <article class="fixed flex top-0 left-0 items-center justify-center w-full h-full bg-gray-900/60 z-50 p-4">
            <div class="flex flex-col w-full max-w-2xl max-h-[90vh] bg-white rounded-md shadow-xl overflow-hidden">
                
                <!-- Header -->
                <div class="flex w-full gap-1 justify-between items-center bg-gray-100 border-b border-gray-200 p-4">
                    <h1 class="font-semibold text-lg text-black capitalize">Tambah Pengurus / Anggota</h1>
                    <button wire:click="btnClosePengurus" class="rounded-full p-1 bg-red-500 hover:bg-red-700 text-white transition-colors cursor-pointer">
                        <x-css-close class="w-4 h-4" />
                    </button>
                </div>

                <!-- Form Container (Scrollable) -->
                <div class="p-4 overflow-y-auto custom-scrollbar">
                    <form action="{{ route('admin.anggota.store') }}" enctype="multipart/form-data" method="POST" class="flex flex-col gap-4">
                        @csrf
                        
                        <div class="flex flex-col w-full gap-4">
                            
                            <!-- Nama -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label for="nama" class="text-sm font-semibold text-gray-800">Nama</label>
                                <input type="text" name="nama" id="nama" required placeholder="Masukkan Nama Lengkap" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                            </div>

                            <!-- Image -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-start gap-1 md:gap-2">
                                <label for="image" class="text-sm font-semibold text-gray-800 pt-2">Image (Opsional)</label>
                                <div class="md:col-span-3">
                                    <input type="file" name="image" id="image" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-50 file:mr-4 file:py-2 file:px-4 file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                    @error('image') <span class="text-sm text-red-500">{{ $message }}</span> @enderror
                                    <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                                </div>
                            </div>

                            <!-- Jabatan (Select) -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label for="jabatan" class="text-sm font-semibold text-gray-800">Jabatan</label>
                                <select name="jabatan" id="jabatan" required class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                    <option value="" disabled selected>-- Pilih Jabatan --</option>
                                    <!-- Jika ketua sudah ada, option didisable -->
                                    <option value="ketua" {{ $hasKetua ? 'disabled' : '' }} class="{{ $hasKetua ? 'bg-gray-200 text-gray-400' : '' }}">
                                        Ketua {{ $hasKetua ? '(Sudah Terisi)' : '' }}
                                    </option>
                                    <option value="wakil ketua">Wakil Ketua</option>
                                    <option value="sekertaris">Sekertaris</option>
                                    <option value="wakil sekertaris">Wakil Sekertaris</option>
                                    <option value="bendahara">Bendahara</option>
                                    <option value="wakil bendahara">Wakil Bendahara</option>
                                    <option value="anggota">Anggota</option>
                                </select>
                            </div>

                            <!-- Tempat Lahir -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label for="tempat_lahir" class="text-sm font-semibold text-gray-800">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" id="tempat_lahir" required placeholder="Masukkan Tempat Lahir" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                            </div>

                            <!-- Alamat -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-start gap-1 md:gap-2">
                                <label for="alamat" class="text-sm font-semibold text-gray-800 pt-2">Alamat</label>
                                <textarea name="alamat" id="alamat" rows="2" required placeholder="Masukkan Alamat Lengkap" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 resize-none"></textarea>
                            </div>

                            <!-- No Telp -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label for="no_telp" class="text-sm font-semibold text-gray-800">No. Telp</label>
                                <input type="text" name="no_telp" id="no_telp" required placeholder="08xxxxxxxxxx" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                            </div>

                            <!-- Email -->
                            <div class="grid grid-cols-1 md:grid-cols-4 md:items-center gap-1 md:gap-2">
                                <label for="email" class="text-sm font-semibold text-gray-800">Email</label>
                                <input type="email" name="email" id="email" required placeholder="email@contoh.com" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                            </div>

                        </div>
        
                        <!-- Footer / Submit -->
                        <div class="flex w-full justify-end mt-4 pt-4 border-t border-gray-200">
                            <button type="submit" class="px-6 py-2 rounded-md bg-green-500 text-white font-semibold hover:bg-green-600 transition-colors shadow-md cursor-pointer">
                                Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </article>
    @endif
    {{-- overlay Add Pengurus --}}

    {{-- overlay Edit Pengurus --}}
    @if ($overlayEditPengurus)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Edit Pengurus</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button type="button" wire:click="btnCloseEditPengurus" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="updatePengurus" class="flex flex-col gap-4">
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
                                <input type="file" name="image" wire:model="image" id="image" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                @error('image')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror

                                @if ($currentImage)
                                    <img src="{{ asset('storage/' . $currentImage) }}" class="w-28 h-20 object-cover rounded-md">
                                @endif

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
    {{-- overlay Edit Pengurus --}}

    {{-- overlay Add Banner --}}
    {{-- @if ($overlayAddBanner)
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
        
    @endif --}}
    {{-- overlay Add Banner --}}

    {{-- overlay Edit Banner --}}
    {{-- @if ($overlayEditBanner)
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
                                <input type="file" name="image" wire:model="image" id="image" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                @error('image')
                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                @enderror

                                @if ($currentImage)
                                    <img src="{{ asset('storage/' . $currentImage) }}" class="w-28 h-20 object-cover rounded-md">
                                @endif

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
        
    @endif --}}
    {{-- overlay Edit Banner --}}

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