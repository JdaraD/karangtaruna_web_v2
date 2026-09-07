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
                'title' => 'mail'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full shrink-0 3xl:h-210 lg:h-157.5 h-full overflow-y-auto scrollbar-none">

    <article class="flex flex-none gap-2 items-center">
        <x-gmdi-mail class="w-8 h-6" />
        <h1 class="font-semibold capitalize lg:text-2xl md:text-base text-base">Mail</h1>
    </article>

    <!-- Table Container -->
    <div class="bg-white rounded-md shadow-sm w-full border border-gray-100 flex flex-col mt-2">
        
        <!-- Optional: Toolbar (Bisa untuk pencarian/filter kedepannya) -->
        <div class="p-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50 rounded-t-md">
            <h2 class="font-semibold text-sm text-gray-700">Kotak Masuk (Inbox)</h2>
            <span class="text-xs bg-[#00c853] text-white px-2.5 py-1 rounded-full">2 Pesan Baru</span>
        </div>

        <div class="overflow-x-auto w-full">
            <table class="w-full text-left text-sm text-gray-700 whitespace-nowrap">
                <thead class="bg-[#f4f5f7] border-b border-gray-200">
                    <tr>
                        <th class="p-4 font-semibold w-1/4">Pengirim</th>
                        <th class="p-4 font-semibold w-1/4">Subjek</th>
                        <th class="p-4 font-semibold">Kategori</th>
                        <th class="p-4 font-semibold">No. HP</th>
                        <th class="p-4 font-semibold">Tanggal</th>
                        <th class="p-4 font-semibold">Status</th>
                        <th class="p-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    
                    <!-- Row 1: Email Baru (Unread) -->
                    <tr class="hover:bg-gray-50 transition-colors bg-blue-50/20">
                        <td class="p-4">
                            <div class="font-bold text-gray-900">Budi Santoso</div>
                            <div class="text-xs text-gray-500 mt-0.5">budi.santoso@gmail.com</div>
                        </td>
                        <td class="p-4 font-semibold text-gray-800">
                            Proposal Kolaborasi Event 2026
                        </td>
                        <td class="p-4">
                            <span class="bg-purple-100 text-purple-700 px-2.5 py-1 rounded-md text-xs font-medium">Kerja Sama</span>
                        </td>
                        <td class="p-4 text-gray-600">0812-3456-7890</td>
                        <td class="p-4 text-gray-600">07 Sep 2026</td>
                        <td class="p-4">
                            <span class="flex items-center gap-1.5 text-xs font-medium text-blue-600">
                                <span class="w-2 h-2 rounded-full bg-blue-600"></span> Baru
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center justify-center gap-2">
                                <!-- Btn: View -->
                                <button class="p-1.5 text-blue-500 hover:bg-blue-100 rounded-md transition-colors" title="Lihat Email">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                <!-- Btn: Balas -->
                                <button class="p-1.5 text-green-500 hover:bg-green-100 rounded-md transition-colors" title="Balas Email">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                                </button>
                                <!-- Btn: Tandai Dibaca -->
                                <button class="p-1.5 text-gray-500 hover:bg-gray-200 rounded-md transition-colors" title="Tandai Telah Dibaca">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                                <!-- Btn: Hapus -->
                                <button class="p-1.5 text-red-500 hover:bg-red-100 rounded-md transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                    <!-- Row 2: Email Sudah Dibaca (Read) -->
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="p-4">
                            <div class="font-medium text-gray-800">Dinas Sosial Parung</div>
                            <div class="text-xs text-gray-500 mt-0.5">contact@dinsos.go.id</div>
                        </td>
                        <td class="p-4 text-gray-600">
                            Pengajuan Bantuan Sosial Anak Yatim
                        </td>
                        <td class="p-4">
                            <span class="bg-orange-100 text-orange-700 px-2.5 py-1 rounded-md text-xs font-medium">Permohonan</span>
                        </td>
                        <td class="p-4 text-gray-600">0856-1234-5678</td>
                        <td class="p-4 text-gray-600">05 Sep 2026</td>
                        <td class="p-4">
                            <span class="text-xs font-medium text-gray-500">
                                Sudah dibaca
                            </span>
                        </td>
                        <td class="p-4">
                            <div class="flex items-center justify-center gap-2">
                                <button class="p-1.5 text-blue-500 hover:bg-blue-100 rounded-md transition-colors" title="Lihat Email">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                </button>
                                <button class="p-1.5 text-green-500 hover:bg-green-100 rounded-md transition-colors" title="Balas Email">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                                </button>
                                <!-- Tombol Tandai Dibaca disembunyikan/dijadikan transparan karena sudah dibaca -->
                                <button class="p-1.5 text-gray-300 cursor-not-allowed rounded-md" disabled>
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                                <button class="p-1.5 text-red-500 hover:bg-red-100 rounded-md transition-colors" title="Hapus">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                            </div>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>

</section>