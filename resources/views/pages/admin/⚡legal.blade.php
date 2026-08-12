<?php

use Livewire\Component;

new class extends Component
{
    
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
    <!-- Header Bagian Struktur -->
    <article class="flex flex-none gap-2 items-center">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Struktur</h1>
    </article>

    @for ($i = 1; $i <= 8; $i++)
        <article class="flex flex-none h-40 w-[49%] bg-amber-300 shadow-md rounded-lg"></article>
    @endfor
</section>