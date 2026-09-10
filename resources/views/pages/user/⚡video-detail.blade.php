<?php

use Livewire\Component;
use App\Models\albumVideo;

new class extends Component
{
    public $albumVideo, $videos;

    public function loadAlbumVideo($id)
    {
        $this->albumVideo = albumVideo::with('video')
            ->findOrFail($id);

        $this->videos = $this->albumVideo->video;
    }

    public function mount($id)
    {
        $this->loadAlbumVideo($id);
    }
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Video Detail'
            ]);
    }
};
?>

<section class="flex flex-col gap-6 w-full h-full justify-center items-center">

    <article class="flex flex-col lg:w-[90%] md:w-[90%] w-[90%] h-full py-6 gap-6">
        <div class="flex w-full h-full gap-2">
            <a href="{{ route('video') }}" class="font-[poppins] font-semibold lg:text-2xl md:text-lg text-base normal-case">Video :</a>
            <p class="font-[poppins] font-normal lg:text-2xl md:text-lg text-base normal-case">{{ $albumVideo->nama_album }}</p>
        </div>

        <div class="flex flex-wrap w-full h-full justify-center items-center lg:gap-4 md:gap-4 gap-2">
            @foreach ($videos as $video)
                <div class="flex relative flex-col lg:w-82 md:w-80 w-30 lg:h-60 md:h-58 h-28 bg-gray-300 rounded-lg shadow-md hover:scale-102 transition-transform duration-120 ease-in-out">
                    <div class="flex w-full h-full rounded-lg">
                        {!! $video->link_video !!}
                    </div>
                </div>
            @endforeach
        </div>

    </article>
</section>