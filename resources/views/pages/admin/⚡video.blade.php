<?php

use Livewire\Component;
use App\Models\albumVideo;
use App\Models\video;

new class extends Component
{
    public $nama_album, $albumVideoId, $albumVideos;
    public $videoId, $videos;
    public $judul_video, $album_video_id, $link_video, $deskripsi_video;

    public $overlayAddAlbumVideo = false;
    public $overlayEditAlbumVideo = false;
    public $overlayAddVideo = false;
    public $overlayEditVideo = false;

    public $editSuccess;
    public $editGagal;
    public $deleteSuccess;
    public $deleteGagal;

    public $selectedAlbum = null;

    // FUNGSI FILTER ALBUM
    public function setFilterAlbum($id)
    {
        $this->selectedAlbum = ($this->selectedAlbum == $id) ? null : $id;
    }

    // load data
    public function loadAlbumVideo()
    {
        $this->albumVideos = albumVideo::all();
    }

    public function loadVideo()
    {
        $this->videos = video::all();
    }
    // load data

    // function mount
    public function mount()
    {
        $this->loadAlbumVideo();
        $this->loadVideo();
    }
    // function mount

    // function Button
    public function btnOpenAddAlbumVideo()
    {
        $this->overlayAddAlbumVideo = true;
    }

    public function btnCloseAlbumVideo()
    {
        $this->overlayAddAlbumVideo = false;
    }

    public function btnOpenEditAlbumVideo($id)
    {
        $albumVideo = albumVideo::findOrFail($id);
        
        $this->albumVideoId = $albumVideo->id;
        $this->nama_album = $albumVideo->nama_album;
        
        $this->overlayEditAlbumVideo = true;
    }

    public function btnCloseEditAlbumVideo()
    {
        $this->overlayEditAlbumVideo = false;
        $this->reset(['nama_album', 'albumVideoId']);
    }

    public function btnOpenAddVideo()
    {
        $this->overlayAddVideo = true;
    }
    
    public function btnCloseVideo()
    {
        $this->overlayAddVideo = false;
    }

    public function btnOpenEditVideo($id)
    {
        $video = video::findOrFail($id);
        
        $this->videoId = $video->id;
        $this->judul_video = $video->judul_video;
        $this->link_video = $video->link_video;
        $this->album_video_id = $video->album_video_id;
        $this->deskripsi_video = $video->deskripsi_video;
        
        $this->overlayEditVideo = true;
    }

    public function btnCloseEditVideo()
    {
        $this->overlayEditVideo = false;
        $this->reset([
            'judul_video', 
            'link_video', 
            'album_video_id', 
            'deskripsi_video', 
            'videoId'
            ]);
    }
    // function Button

    // add function
    // add function

    // update function
    public function updateAlbumVideo()
    {
        $this->validate([
            'nama_album' => 'required|string|max:255',
        ]);

        try {
            $albumVideo = albumVideo::findOrFail($this->albumVideoId);
            $albumVideo->update([
                'nama_album' => $this->nama_album,
            ]);

            $this->loadAlbumVideo();

            $this->overlayEditAlbumVideo = false;
            $this->editSuccess = 'Data berhasil diubah!';
            $this->editGagal = '';
        } catch (\Throwable $th) {
            $this->editGagal = 'Data gagal diubah!';
            $this->editSuccess = '';

        }
    }

    public function updateVideo()
    {
        $this->validate([
            'judul_video'     => 'required|string|max:255',
            'album_video_id'  => 'required',
            'link_video'      => 'required|url',
            'deskripsi_video' => 'required|string',
        ]);

        try {
            $video = Video::findOrFail($this->videoId);
            $video->update([
                'judul_video'     => $this->judul_video,
                'album_video_id'  => $this->album_video_id,
                'link_video'      => $this->link_video,
                'deskripsi_video' => $this->deskripsi_video,
            ]);

            $this->overlayEditVideo = false;

            $this->loadVideo();

            $this->editSuccess = 'Data berhasil diperbarui!';
            $this->editGagal = '';
        } catch (\Throwable $th) {
            $this->editGagal = 'Data gagal diperbarui!';
            $this->editSuccess = '';
        }
    }
    // update function

    // delete function
    public function btnDeleteAlbumVideo($id)
    {
        try {
            $albumVideo = albumVideo::findOrFail($id);
            $albumVideo->delete();

            $this->loadAlbumVideo();

            $this->deleteSuccess = 'Data berhasil dihapus!';
            $this->deleteGagal = '';
        } catch (\Throwable $th) {
            $this->deleteGagal = 'Data gagal dihapus!';
            $this->deleteSuccess = '';
        }
    }

    public function btnDeleteVideo($id)
    {
        try {
            Video::findOrFail($id)->delete();
            $this->loadVideo();
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
        $album = AlbumVideo::all(); // Model relasi untuk kategori album

        if ($this->selectedAlbum) {
            $videos = Video::where('album_video_id', $this->selectedAlbum)->get();
        } else {
            $videos = Video::all();
        }

        return $this->view()
            ->with([
                'album' => $album,
                'videos' => $videos
            ])
            ->layout('layouts.admin', [
                'title' => 'Video',
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">
    <article class="flex flex-none gap-2 items-center">
        <x-heroicon-s-video-camera class="h-6 w-6" />
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Video</h1>
    </article>

    <article class="flex flex-wrap w-full gap-4 items-center">
        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-auto p-4 bg-white shadow-md rounded-md">
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <div class="flex w-full h-auto gap-1 items-center">
                    <h1 class="font-semibold text-base text-black capitalize">Album Video</h1>
                </div>
                <div class="flex w-full h-auto gap-1 justify-end items-center">
                    <button type="button" wire:click="btnOpenAddAlbumVideo" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah/Edit">
                        <x-bi-plus class="h-6 w-6 text-white"/>
                    </button>
                </div>
            </div>

            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 w-full max-h-18 gap-2 px-2 overflow-y-auto scrollbar-none">
                @foreach ($albumVideos as $av)
                    <div class="flex flex-col w-full h-auto gap-2 p-2 bg-[#9CB080] rounded-md shadow-md hover:scale-102 duration-120 ease-in-out transition-transform">
                        <div class="flex w-full h-full gap-1 p-1 justify-between items-center bg-[#618764]/40 rounded-md">
                            <p class="text-base font-semibold capitalize">{{ $av->nama_album }}</p>
                            <div class="flex gap-1">
                                <button type="button" wire:click="btnOpenEditAlbumVideo({{ $av->id }})" class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Lihat">
                                    <x-bi-pencil class="h-4 w-4 text-white"/>
                                </button>
                                <button type="button" wire:click="btnDeleteAlbumVideo({{ $av->id }})" class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Hapus">
                                    <x-bi-trash class="h-4 w-4 text-white"/>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="flex flex-col justify-stretch gap-4 items-center w-full h-auto p-4 bg-white shadow-md rounded-md">
    
            <!-- HEADER -->
            <div class="flex w-full h-auto gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                <h1 class="font-semibold text-base text-black capitalize">Video</h1>
                <button type="button" wire:click="btnOpenAddVideo" class="flex bg-green-500 hover:bg-green-700 justify-center items-center w-6 h-6 rounded-md shadow-md cursor-pointer" title="Tambah">
                    <x-bi-plus class="h-6 w-6 text-white"/>
                </button>
            </div>

            <!-- FILTER ALBUM -->
            <div class="flex w-full h-auto gap-2 items-center overflow-x-auto scrollbar-none py-2">
                <div wire:click="setFilterAlbum(null)" class="flex w-auto h-auto gap-1 items-center rounded-md p-2 cursor-pointer transition-colors {{ $selectedAlbum === null ? 'bg-[#618764] text-white shadow-md' : 'bg-gray-100 hover:bg-gray-200 text-black' }}">
                    <h1 class="font-semibold text-base capitalize whitespace-nowrap">Semua</h1>
                </div>
                @foreach ($album as $al)
                    <div wire:key="album-{{ $al->id }}" wire:click="setFilterAlbum({{ $al->id }})" class="flex w-auto h-auto gap-1 items-center rounded-md p-2 cursor-pointer transition-colors {{ $selectedAlbum == $al->id ? 'bg-[#618764] text-white shadow-md' : 'bg-gray-100 hover:bg-gray-200 text-black' }}">
                        <h1 class="font-semibold text-base capitalize whitespace-nowrap">{{ $al->nama_album }}</h1>
                    </div>
                @endforeach
            </div>

            <!-- LIST VIDEO CARD -->
            <div class="grid lg:grid-cols-3 md:grid-cols-2 grid-cols-1 w-full gap-4 p-2 overflow-y-auto scrollbar-none">
                @foreach ($videos as $vid)
                    <div wire:key="video-{{ $vid->id }}" class="flex flex-col w-full h-auto gap-2 p-2 bg-[#9CB080] rounded-md shadow-md">
                        
                        <!-- IFRAME VIDEO YOUTUBE -->
                        <div class="w-full aspect-video rounded-md overflow-hidden bg-black">
                            @php
                                $url = $vid->link_video;
                                if (str_contains($url, 'watch?v=')) {
                                    $embedUrl = explode('&', str_replace('watch?v=', 'embed/', $url))[0]; 
                                } elseif (str_contains($url, 'youtu.be/')) {
                                    $embedUrl = str_replace('youtu.be/', 'www.youtube.com/embed/', $url);
                                } else {
                                    $embedUrl = $url; 
                                }
                            @endphp
                            <iframe class="w-full h-full" src="{{ $embedUrl }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        </div>

                        <div class="flex w-full h-auto gap-1 p-2 justify-between items-center bg-[#618764]/40 rounded-md mt-1">
                            <p class="text-base font-semibold capitalize text-white truncate max-w-[70%]">{{ $vid->judul_video }}</p>
                            <div class="flex gap-1 shrink-0">
                                <button type="button" wire:click="btnOpenEditVideo({{ $vid->id }})" class="flex bg-yellow-500 hover:bg-yellow-700 justify-center items-center w-7 h-7 rounded-md shadow-md cursor-pointer" title="Edit">
                                    <x-bi-pencil class="h-4 w-4 text-white"/>
                                </button>
                                <button type="button" wire:click="btnDeleteVideo({{ $vid->id }})" class="flex bg-red-500 hover:bg-red-700 justify-center items-center w-7 h-7 rounded-md shadow-md cursor-pointer" title="Hapus">
                                    <x-bi-trash class="h-4 w-4 text-white"/>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </article>

    {{-- overlay Add Album Video --}}
    @if ($overlayAddAlbumVideo)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Tambah Album Video</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button wire:click="btnCloseAlbumVideo" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form action="{{ route('admin.album-video.store') }}" enctype="multipart/form-data" method="POST" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="nama_album" class="text-sm font-semibold text-gray-800">
                                Nama Album
                            </label>
    
                            <input type="text" name="nama_album" id="nama_album" required placeholder="Masukkan Nama Album" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
    {{-- overlay Add Album Video --}}

    {{-- overlay Edit Album Video --}}
    @if ($overlayEditAlbumVideo)
        <article class="absolute flex top-0 left-0 items-center justify-center w-full h-full bg-gray-400/60 z-50">
            <div class="flex flex-col w-fit h-fit gap-4 p-4 bg-white rounded-md">
                
                <div class="flex w-full h-fit gap-1 justify-between items-center bg-gray-100 rounded-md p-2">
                    <div class="flex w-full h-auto gap-1 items-center">
                        <h1 class="font-semibold text-base text-black capitalize">Edit Album Video</h1>
                    </div>
                    <div class="flex w-[30%] h-auto gap-1 justify-end items-center">
                        <button type="button" wire:click="btnCloseEditAlbumVideo" class=" top-4 right-4 rounded-full p-1 bg-red-500 hover:bg-red-700 cursor-pointer">
                            <x-css-close class="w-3 h-3" />
                        </button>
                    </div>
                </div>

                <form wire:submit.prevent="updateAlbumVideo" class="flex flex-col gap-4">
                    @csrf
                    
                    <div class="flex flex-col w-full gap-5 pt-2">
    
                        <div class="grid grid-cols-1 md:grid-cols-4 items-center gap-2">
                            <label for="nama_album" class="text-sm font-semibold text-gray-800">
                                Nama Album
                            </label>
    
                            <input type="text" wire:model="nama_album" name="nama_album" id="nama_album" required placeholder="Masukkan Nama Album" class="md:col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-100 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
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
    {{-- overlay Edit Album Video --}}

    {{-- overlay Add Video --}}
    @if ($overlayAddVideo)
        <article class="fixed flex top-0 left-0 items-center justify-center w-full h-full bg-gray-900/60 z-50 p-4">
            <div class="flex flex-col w-full max-w-2xl bg-white rounded-md shadow-xl overflow-hidden">
                <div class="flex w-full justify-between items-center bg-gray-100 p-4 border-b">
                    <h1 class="font-semibold text-lg text-black">Tambah Video</h1>
                    <button wire:click="btnCloseVideo" class="rounded-full p-1 bg-red-500 hover:bg-red-700 text-white"><x-css-close class="w-4 h-4" /></button>
                </div>
                <div class="p-4 overflow-y-auto max-h-[80vh]">
                    <form action="{{ route('admin.video.store') }}" method="POST" class="flex flex-col gap-4">
                        @csrf
                        
                        <!-- JUDUL VIDEO -->
                        <div class="grid grid-cols-4 items-center gap-2">
                            <label class="text-sm font-semibold text-gray-800">Judul Video</label>
                            <input type="text" name="judul_video" required class="col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>

                        <!-- ALBUM -->
                        <div class="grid grid-cols-4 items-center gap-2">
                            <label class="text-sm font-semibold text-gray-800">Album</label>
                            <select name="album_video_id" required class="col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                <option value="" disabled selected>-- Pilih Album --</option>
                                @foreach ($album as $al)
                                    <option value="{{ $al->id }}">{{ $al->nama_album }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- LINK YOUTUBE -->
                        <div class="grid grid-cols-4 items-center gap-2">
                            <label class="text-sm font-semibold text-gray-800">Link YouTube</label>
                            <input type="url" name="link_video" required placeholder="https://www.youtube.com/..." class="col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="grid grid-cols-4 items-start gap-2">
                            <label class="text-sm font-semibold text-gray-800 pt-2">Deskripsi</label>
                            <textarea name="deskripsi_video" rows="3" required class="col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 resize-none"></textarea>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-md hover:bg-green-600 shadow-md cursor-pointer font-semibold">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </article>
    @endif
    {{-- overlay Add Video --}}

    {{-- overlay Edit Video --}}
    @if ($overlayEditVideo)
        <article class="fixed flex top-0 left-0 items-center justify-center w-full h-full bg-gray-900/60 z-50 p-4">
            <div class="flex flex-col w-full max-w-2xl bg-white rounded-md shadow-xl overflow-hidden">
                <div class="flex w-full justify-between items-center bg-gray-100 p-4 border-b">
                    <h1 class="font-semibold text-lg text-black">Edit Video</h1>
                    <button type="button" wire:click="btnCloseEditVideo" class="rounded-full p-1 bg-red-500 hover:bg-red-700 text-white"><x-css-close class="w-4 h-4" /></button>
                </div>
                <div class="p-4 overflow-y-auto max-h-[80vh]">
                    <form wire:submit.prevent="updateVideo" class="flex flex-col gap-4">
    
                        <!-- JUDUL VIDEO -->
                        <div class="grid grid-cols-4 items-center gap-2">
                            <label class="text-sm font-semibold text-gray-800">Judul Video</label>
                            <input type="text" wire:model="judul_video" required class="col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>

                        <!-- ALBUM -->
                        <div class="grid grid-cols-4 items-center gap-2">
                            <label class="text-sm font-semibold text-gray-800">Album</label>
                            <select wire:model="album_video_id" required class="col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                                <option value="" disabled>-- Pilih Album --</option>
                                @foreach ($album as $al)
                                    <option value="{{ $al->id }}">{{ $al->nama_album }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- LINK YOUTUBE -->
                        <div class="grid grid-cols-4 items-center gap-2">
                            <label class="text-sm font-semibold text-gray-800">Link YouTube</label>
                            <input type="url" wire:model="link_video" required class="col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                        </div>

                        <!-- DESKRIPSI -->
                        <div class="grid grid-cols-4 items-start gap-2">
                            <label class="text-sm font-semibold text-gray-800 pt-2">Deskripsi</label>
                            <textarea wire:model="deskripsi_video" rows="3" required class="col-span-3 w-full rounded-md text-black border border-gray-300 bg-gray-50 px-3 py-2 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 resize-none"></textarea>
                        </div>

                        <div class="flex justify-end mt-4">
                            <button type="submit" class="bg-yellow-500 text-white px-6 py-2 rounded-md hover:bg-yellow-600 shadow-md cursor-pointer font-semibold">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </article>
    @endif
    {{-- overlay Edit Video --}}

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