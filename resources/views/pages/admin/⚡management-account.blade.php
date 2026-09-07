<?php

use Livewire\Component;

new class extends Component
{
    // load data
    // load data

    // function mount
    // function mount

    // function Button
    // function Button

    // add function
    // add function

    // update function
    // update function

    // delete function
    // delete function
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.admin', [
                'title' => 'Manajemen Account'
            ]);
    }
};
?>

<section class="flex flex-col gap-6 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">

    <article class="flex flex-none gap-2 items-center text-white">
        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
        </svg>
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Manajemen Account</h1>
    </article>

    <div class="bg-white rounded-md p-4 shadow-sm text-gray-800 flex flex-col gap-4 w-full">
        <div class="bg-[#f4f5f7] p-3 rounded-md flex justify-between items-center">
            <h2 class="font-semibold text-sm">Ganti Nama Pengguna</h2>
        </div>
        <form class="flex flex-col gap-4 px-2">
            <div class="flex flex-col gap-1.5 w-full md:w-1/2">
                <label class="text-sm font-medium text-gray-700">Nama Pengguna Baru</label>
                <input type="text" placeholder="Masukkan nama pengguna baru" class="border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#00c853] focus:border-transparent">
            </div>
            <div class="flex mt-2">
                <button type="button" class="bg-[#00c853] hover:bg-green-600 text-white font-medium py-1.5 px-4 rounded-md text-sm transition-colors duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-md p-4 shadow-sm text-gray-800 flex flex-col gap-4 w-full">
        <div class="bg-[#f4f5f7] p-3 rounded-md flex justify-between items-center">
            <h2 class="font-semibold text-sm">Ganti Password</h2>
        </div>
        <form class="flex flex-col gap-4 px-2">
            <div class="flex flex-col gap-1.5 w-full md:w-1/2">
                <label class="text-sm font-medium text-gray-700">Password Lama</label>
                <input type="password" placeholder="••••••••" class="border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#00c853] focus:border-transparent">
            </div>
            <div class="flex flex-col gap-1.5 w-full md:w-1/2">
                <label class="text-sm font-medium text-gray-700">Password Baru</label>
                <input type="password" placeholder="••••••••" class="border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#00c853] focus:border-transparent">
            </div>
            <div class="flex flex-col gap-1.5 w-full md:w-1/2">
                <label class="text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                <input type="password" placeholder="••••••••" class="border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#00c853] focus:border-transparent">
            </div>
            <div class="flex mt-2">
                <button type="button" class="bg-[#00c853] hover:bg-green-600 text-white font-medium py-1.5 px-4 rounded-md text-sm transition-colors duration-200">
                    Update Password
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-md p-4 shadow-sm text-gray-800 flex flex-col gap-4 w-full">
        <div class="bg-[#f4f5f7] p-3 rounded-md flex justify-between items-center">
            <h2 class="font-semibold text-sm">Email Penerima (Notifikasi Sistem)</h2>
        </div>
        <form class="flex flex-col gap-4 px-2">
            <div class="flex flex-col gap-1.5 w-full md:w-1/2">
                <label class="text-sm font-medium text-gray-700">Alamat Email</label>
                <input type="email" placeholder="admin@domain.com" class="border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#00c853] focus:border-transparent">
                <p class="text-xs text-gray-500 mt-1">Email ini digunakan sebagai tujuan masuknya pesan atau notifikasi dari *user*.</p>
            </div>
            <div class="flex mt-2">
                <button type="button" class="bg-[#00c853] hover:bg-green-600 text-white font-medium py-1.5 px-4 rounded-md text-sm transition-colors duration-200">
                    Simpan Email
                </button>
            </div>
        </form>
    </div>

</section>