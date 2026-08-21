<?php

use Livewire\Component;
use App\Models\News;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Format;
use Illuminate\Http\UploadedFile;

new class extends Component
{
    use WithFileUploads;

    public $news, $newsId, $name, $image, $tanggal_publish, $isi_berita, $currentImage;
    
    public $overlayAdd = false;
    public $overlayEdit = false;

    public $addSuccess;
    public $addGagal;
    public $editSuccess;
    public $editGagal;
    public $deleteSuccess;
    public $deleteGagal;

    // load data
    public function loadNews()
    {
        $this->news = News::get();
    }
    // load data

    // function mount
    public function mount()
    {
        $this->loadNews();
    }
    // function mount

    // function Button
    // function Button

    // add function
    public function btnOpenAdd()
    {
        $this->overlayAdd = true;
    }

    public function btnCloseAdd()
    {
        $this->overlayAdd = false;
    }

    public function btnOpenEdit($id)
    {
        $news = News::findOrFail($id);

        $this->newsId = $news->id;
        $this->name = $news->name;
        $this->currentImage = $news->image;
        $this->isi_berita = $news->isi_berita;
        $this->tanggal_publish = $news->tanggal_publish;

        $this->image = null;
        $this->overlayEdit = true;
    }

    public function btnCloseEdit()
    {
        $this->overlayEdit = false;
        $this->reset([
            'newsId',
            'name',
            'image',
            'isi_berita',
            'tanggal_publish'
        ]);
    }
    // add function

    // update function
    public function updateNews()
    {
        $rules = [
            'name' => 'required',
            'isi_berita' => 'required',
            'tanggal_publish' => 'required'
        ];

        $isNewImageUploaded = $this->image instanceof UploadedFile;

        if ($isNewImageUploaded) {
            $rules['image'] = 'image|mimes:png,jpg,jpeg,webp|max:2048';
        }

        $this->validate($rules);

        try {
            $news = News::findOrFail($this->newsId);

            $dataToUpdate = [
                'name' => $this->name,
                'isi_berita' => $this->isi_berita,
                'tanggal_publish' => $this->tanggal_publish,
            ];

            if ($this->image instanceof UploadedFile) {
                $filename = time() . '_' . uniqid() . '.webp';

                $manager = ImageManager::usingDriver(Driver::class);
                $image = $manager->decode(file_get_contents($this->image->getRealPath()));
                $image->scaleDown(width: 520, height: 320);
                $encoded = $image->encodeUsingFormat(Format::WEBP, quality: 80);

                $path = "uploads/news/{$filename}";
                Storage::disk('public')->put($path, (string) $encoded);

                if ($news->image && Storage::disk('public')->exists($news->image)) {
                    Storage::disk('public')->delete($news->image);
                }

                $dataToUpdate['image'] = $path;
            }

            $news->update($dataToUpdate);

            $this->loadNews();

            $this->editSuccess = 'Data Berhasil Diedit!';
            $this->editGagal = '';
            $this->overlayEdit = false;

            $this->image = null;
            $this->currentImage = null;
        } catch (\Throwable $th) {
            $this->editGagal = 'Data Gagal Diedit!';
            $this->editSuccess = '';
        }
    }
    // update function

    // delete function
    public function btnDelete($id)
    {
        try {
            $news = News::findOrFail($id);
            $news->delete();

            $this->loadNews();

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
                'title' => 'News'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    <article class="flex flex-none gap-2 items-center">
        <x-bi-newspaper class="h-6 w-6" />
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Berita</h1>
    </article>

    <article class="flex flex-wrap w-full gap-4 items-center">

        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-fit p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Berita</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <div class="flex w-29 h-6">
                        <input type="date" name="tanggal" id="tanggal" class="w-full h-full text-black">
                    </div>
                    <button wire:click="btnOpenAdd" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </button>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 md:grid-cols-2 grid-cols-1 w-full 3xl:max-h-210 3xl:h-full lg:mx-h-124 lg:h-full md:max-h-124 md:h-full h-64 gap-2 p-2 overflow-y-auto scrollbar-none">
                @foreach ($news as $n)
                    <div class="flex w-full h-36.75 gap-2 p-2 bg-[#9CB080] rounded-md shadow-md hover:scale-102 duration-120 ease-in-out transition-transform">
                        <div class="flex w-[46%] h-full">
                            <img src="{{ asset('storage/'. $n->image) }}?t={{ time() }}" alt="" class="w-full h-32 object-cover rounded-md">
                        </div>
                        <div class="flex w-full h-full flex-col gap-1">
                            <div class="flex gap-1 p-1 justify-between items-center bg-[#618764]/40 rounded-md">
                                <p class="text-base font-semibold capitalize">{{ $n->name }}</p>
                                <div class="flex gap-1">
                                    <button wire:click="btnOpenEdit({{ $n->id }})" class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                                        <x-bi-pencil class="h-4 w-4 text-white"/>
                                    </button>
                                    <button wire:click="btnDelete({{ $n->id }})" class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                                        <x-bi-trash class="h-4 w-4 text-white"/>
                                    </button>
                                </div>
                            </div>
                            <p class="text-base font-semibold text-justify line-clamp-4">{{ $n->isi_berita }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </article>

    {{-- overlay Add --}}
    @if ($overlayAdd)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Tambah Berita</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button wire:click="btnCloseAdd" class="top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form action="{{ route('admin.news.store') }}" method="POST" class="flex flex-col gap-4" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="name" class="text-sm font-semibold text-gray-800">
                                Nama
                            </label>
    
                            <input type="text" name="name" required id="name" placeholder="Masukkan Nama Admin" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="image" class="text-sm font-semibold text-gray-800 pt-2">
                                Image
                            </label>
    
                               <div class="md:col-span-3">
                                    <input type="file" name="image" required id="image" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                    @error('image')
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror

                                    <p class="mt-1 text-xs text-gray-500">
                                        Format: JPG, JPEG, PNG, atau WEBP. Ukuran 520x320. Maksimal 2 MB.
                                    </p>
                                </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="isi_berita" class="text-sm font-semibold text-gray-800">
                                Isi Berita
                            </label>
    
                            <textarea cols="4" rows="2" name="isi_berita" required id="isi_berita" placeholder="Masukkan Isi berita" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"></textarea>
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
        
    @endif
    {{-- overlay Add --}}

    {{-- overlay Edit --}}
    @if ($overlayEdit)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Edit Berita</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button type="button" wire:click="btnCloseEdit" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="updateNews" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="name" class="text-sm font-semibold text-gray-800">
                                Nama
                            </label>
    
                            <input type="text" wire:model="name" name="name" required id="name" placeholder="Masukkan Nama Admin" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="image" class="text-sm font-semibold text-gray-800 pt-2">
                                Image
                            </label>
    
                               <div class="md:col-span-3">
                                    <input type="file" name="image" wire:model="image" required id="image" accept="image/png,image/jpeg,image/jpg,image/webp" class="w-full rounded-md text-sm text-gray-700 border border-gray-300 bg-gray-100 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-500 file:text-white hover:file:bg-blue-600 focus:border-blue-500 focus:ring-2 focus:ring-blue-200">

                                    @error('image')
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
                            <label for="isi_berita" class="text-sm font-semibold text-gray-800">
                                Isi Berita
                            </label>
    
                            <textarea cols="4" rows="2" wire:model="isi_berita" name="isi_berita" required id="isi_berita" placeholder="Masukkan Isi berita" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200"></textarea>
                        </div>
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-start gap-2">
                            <label for="tanggal_publish" class="text-sm font-semibold text-gray-800 pt-2">
                                Tanggal
                            </label>
    
                           <input type="date" wire:model="tanggal_publish" name="tanggal_publish" required id="tanggal_publish" placeholder="Masukkan Nomor Hp (08xxxxxxxx)" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
    {{-- overlay Edit--}}

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

<script>
    const hariIni = new Date();

    const tahun = hariIni.getFullYear();
    const bulan = String(hariIni.getMonth() + 1).padStart(2, '0');
    const tanggal = String(hariIni.getDate()).padStart(2, '0');

    const formatTanggal = `${tahun}-${bulan}-${tanggal}`;
    document.getElementById('tanggal').value = formatTanggal;
</script>