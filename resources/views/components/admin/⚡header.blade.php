<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

<header class="flex flex-col min-w-0 overflow-hidden">
    
    {{-- mobile header --}}
    <div class="flex h-16 items-center justify-between border-b border-gray-800 bg-gray-800 px-4 lg:hidden cursor-pointer">
        <button @click="sidebarOpen = !sidebarOpen" class="text-gray-600 hover:text-gray-900 focus:outline-none">
            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
        </button>
        <span class="font-semibold text-white">Panel Admin</span>
        <div class="w-6"></div> <!-- Spacer -->
    </div>
    {{-- mobile header --}}

    {{-- windows header --}}
    <div class="hidden lg:flex bg-gray-800 p-4 shadow-md text-right">
        <h1 class="text-2xl font-bold text-white">Selamat Datang di Panel Admin</h1>
    </div>
    {{-- windows header --}}

</header>