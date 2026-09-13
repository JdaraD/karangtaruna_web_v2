<?php

use Livewire\Component;
use App\Models\legal;
use App\Models\pasal;
use App\Models\identity;

new class extends Component
{
    public $legal, $pasals, $identity;

    public function loadLegal()
    {
        $this->legal = legal::latest()->first();
    }

    public function loadPasal()
    {
        $this->pasals = pasal::all();
    }

    public function loadIdentity()
    {
        $this->identity = identity::latest()->first();
    }

    public function mount()
    {
        $this->loadLegal();
        $this->loadPasal();
        $this->loadIdentity();
    }
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.user', [
                'title' => 'Dasar Hukum'
            ]);
    }
};
?>

<section class="w-full px-4 sm:px-6 lg:px-8 my-6">
    <article class="w-full max-w-7xl mx-auto flex flex-col gap-6">
        <h1 class="text-xl sm:text-2xl font-bold">Tentang Kami</h1>
        <div class="flex flex-col md:flex-row w-full items-center md:items-start gap-5 md:gap-8">
            <div class="flex justify-center items-center shrink-0">
                @if ($identity)
                    <img src="{{ asset('storage/' . $identity->image) }}" alt="" class="w-24 h-24 sm:w-28 sm:h-28 md:w-32 md:h-32 object-cover rounded-full">
                @endif
            </div>
            <div class="flex flex-col w-full gap-2">
                @if ($legal)
                    <div>
                        <p class="font-semibold text-base sm:text-lg">{{ $legal->name }}</p>
                    </div>
                    <p class="text-justify text-sm sm:text-base leading-relaxed">
                        {{ $legal->paragraf }}
                    </p>
                @endif
            </div>
        </div>
        <div class="w-full flex justify-center">
            <div class="w-full md:w-[90%] lg:w-[80%] flex flex-col border border-[#618764] bg-[#9CB080] shadow-md rounded-md px-4 sm:px-6 md:px-8 py-6 sm:py-8">
                <p class="font-semibold text-base sm:text-lg text-center">Pasal Tentang Hukum Berdirinya Karang Taruna</p>
                <ul class="mt-5 flex flex-col gap-4">
                    @foreach ($pasals as $pasal)
                    <li class="flex items-center gap-3">
                            
                        <div class="w-3 h-3 sm:w-4 sm:h-4 shrink-0 bg-white rounded-full"></div>
                        <span class="text-white lg:text-base text-sm text-justify">{{ $pasal->isi_pasal }}.</span>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </article>
</section>