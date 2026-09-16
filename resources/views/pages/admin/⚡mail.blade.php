<?php

use Livewire\Component;
use App\Models\mail;

new class extends Component
{
    // Mengubah status pesan menjadi sudah dibaca
    public function markAsRead($id)
    {
        $mail = mail::find($id);
        if ($mail && $mail->status === 'unread') {
            $mail->update(['status' => 'read']);
        }
    }

    // Menghapus pesan dari database
    public function deleteMail($id)
    {
        $mail = mail::find($id);
        if ($mail) {
            $mail->delete();
        }
    }

    public function render()
    {
        // Mengambil data dan mengirimkannya langsung ke view inline ini
        return $this->view([
                'mails' => mail::latest()->get(),
                'unreadCount' => mail::where('status', 'unread')->count(),
            ])
            ->layout('layouts.admin', [
                'title' => 'Kotak Masuk'
            ]);
    }
};
?>

<section class="flex flex-col gap-4 w-full h-full overflow-y-auto px-2 sm:px-4 md:px-0">

    <!-- Header Title -->
    <article class="flex flex-none gap-2 items-center">
        <x-gmdi-mail class="w-7 h-5 sm:w-8 sm:h-6 shrink-0" />
        <h1 class="font-semibold capitalize text-lg sm:text-xl lg:text-2xl">Mail</h1>
    </article>

    <!-- Container Utama -->
    <div class="bg-white rounded-md shadow-sm w-full border border-gray-100 flex flex-col mt-2">
        
        <!-- Toolbar / Header Box -->
        <div class="p-3 sm:p-4 border-b border-gray-100 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-2 bg-gray-50/50 rounded-t-md">
            <h2 class="font-semibold text-sm sm:text-base text-gray-700">Kotak Masuk (Inbox)</h2>
            @if($unreadCount > 0)
                <span class="text-xs bg-[#00c853] text-white px-2.5 py-1 rounded-full font-medium">{{ $unreadCount }} Pesan Baru</span>
            @else
                <span class="text-xs bg-gray-400 text-white px-2.5 py-1 rounded-full font-medium">Tidak ada pesan baru</span>
            @endif
        </div>

        <!-- ================= RESPONSIVE VIEW ================= -->

        @forelse ($mails as $mail)
            <!-- TAMPILAN MOBILE & TABLET KECIL (Card Layout - Muncul di bawah MD) -->
            <div class="block md:hidden p-4 border-b border-gray-100 {{ $mail->status === 'unread' ? 'bg-blue-50/30' : 'bg-white' }}">
                <div class="flex justify-between items-start gap-2 mb-2">
                    <div>
                        <div class="font-bold text-gray-900 text-sm {{ $mail->status === 'unread' ? 'font-extrabold' : '' }}">
                            {{ $mail->nama }}
                        </div>
                        <div class="text-xs text-gray-500">{{ $mail->email }}</div>
                    </div>
                    <div>
                        @if ($mail->status === 'unread')
                            <span class="inline-flex items-center gap-1 text-[10px] font-semibold text-blue-600 bg-blue-100 px-2 py-0.5 rounded-full">
                                <span class="w-1.5 h-1.5 rounded-full bg-blue-600"></span> Baru
                            </span>
                        @else
                            <span class="text-[10px] font-medium text-gray-500 bg-gray-100 px-2 py-0.5 rounded-full">
                                Dibaca
                            </span>
                        @endif
                    </div>
                </div>

                <div class="text-xs text-gray-800 font-medium mb-1">
                    <span class="text-gray-400 font-normal">Subjek:</span> {{ $mail->keperluan }}
                </div>
                <div class="text-xs text-gray-600 mb-1">
                    <span class="text-gray-400">Alamat:</span> {{ $mail->alamat }}
                </div>
                <div class="text-xs text-gray-600 mb-1">
                    <span class="text-gray-400">No. HP:</span> {{ $mail->no_telp }}
                </div>
                <div class="text-xs text-gray-400 mb-3">
                    <span class="text-gray-400">Tanggal:</span> {{ \Carbon\Carbon::parse($mail->tanggal)->format('d M Y') }}
                </div>

                <!-- Tombol Aksi Mobile -->
                <div class="flex items-center justify-end gap-2 pt-2 border-t border-gray-100">
                    @if ($mail->file_pdf)
                        <a href="{{ asset('storage/' . $mail->file_pdf) }}" target="_blank" download class="p-1.5 text-orange-500 bg-orange-50 rounded-md" title="Unduh PDF">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </a>
                    @endif

                    <a href="mailto:{{ $mail->email }}?subject=Balasan: {{ $mail->keperluan }}" class="p-1.5 text-green-500 bg-green-50 rounded-md" title="Balas Email">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                    </a>

                    @if ($mail->status === 'unread')
                        <button wire:click="markAsRead({{ $mail->id }})" class="p-1.5 text-blue-600 bg-blue-50 rounded-md" title="Tandai Dibaca">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </button>
                    @endif

                    <button wire:click="deleteMail({{ $mail->id }})" wire:confirm="Yakin ingin menghapus pesan dari {{ $mail->nama }}?" class="p-1.5 text-red-500 bg-red-50 rounded-md" title="Hapus">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                    </button>
                </div>
            </div>
        @empty
            <!-- Kosong untuk Mobile -->
            <div class="block md:hidden p-8 text-center text-gray-400 font-medium text-sm">
                Belum ada pesan masuk saat ini.
            </div>
        @endforelse


        <!-- TAMPILAN DESKTOP (Table Layout - Muncul mulai dari ukuran MD ke atas) -->
        <div class="hidden md:block overflow-x-auto w-full">
            <table class="w-full text-left text-sm text-gray-700 whitespace-nowrap">
                <thead class="bg-[#f4f5f7] border-b border-gray-200">
                    <tr>
                        <th class="p-4 font-semibold w-1/4">Pengirim</th>
                        <th class="p-4 font-semibold w-1/4">Keperluan / Subjek</th>
                        <th class="p-4 font-semibold">Alamat</th>
                        <th class="p-4 font-semibold">No. HP</th>
                        <th class="p-4 font-semibold">Tanggal</th>
                        <th class="p-4 font-semibold">Status</th>
                        <th class="p-4 font-semibold text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($mails as $mail)
                        <tr class="hover:bg-gray-50 transition-colors {{ $mail->status === 'unread' ? 'bg-blue-50/20' : '' }}">
                            <td class="p-4">
                                <div class="{{ $mail->status === 'unread' ? 'font-bold text-gray-900' : 'font-medium text-gray-800' }}">
                                    {{ $mail->nama }}
                                </div>
                                <div class="text-xs text-gray-500 mt-0.5">{{ $mail->email }}</div>
                            </td>
                            <td class="p-4 {{ $mail->status === 'unread' ? 'font-semibold text-gray-800' : 'text-gray-600' }}">
                                {{ $mail->keperluan }}
                            </td>
                            <td class="p-4 text-gray-600 truncate max-w-37.5" title="{{ $mail->alamat }}">
                                {{ $mail->alamat }}
                            </td>
                            <td class="p-4 text-gray-600">{{ $mail->no_telp }}</td>
                            <td class="p-4 text-gray-600">{{ \Carbon\Carbon::parse($mail->tanggal)->format('d M Y') }}</td>
                            <td class="p-4">
                                @if ($mail->status === 'unread')
                                    <span class="flex items-center gap-1.5 text-xs font-medium text-blue-600">
                                        <span class="w-2 h-2 rounded-full bg-blue-600"></span> Baru
                                    </span>
                                @else
                                    <span class="text-xs font-medium text-gray-500">
                                        Sudah dibaca
                                    </span>
                                @endif
                            </td>
                            <td class="p-4">
                                <div class="flex items-center justify-center gap-2">
                                    <!-- Btn: Unduh PDF -->
                                    @if ($mail->file_pdf)
                                        <a href="{{ asset('storage/' . $mail->file_pdf) }}" target="_blank" download class="p-1.5 text-orange-500 hover:bg-orange-100 rounded-md transition-colors" title="Unduh Lampiran PDF">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        </a>
                                    @endif

                                    <!-- Btn: Balas -->
                                    <a href="mailto:{{ $mail->email }}?subject=Balasan: {{ $mail->keperluan }}" class="p-1.5 text-green-500 hover:bg-green-100 rounded-md transition-colors" title="Balas Email">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path></svg>
                                    </a>

                                    <!-- Btn: Tandai Dibaca -->
                                    @if ($mail->status === 'unread')
                                        <button wire:click="markAsRead({{ $mail->id }})" class="p-1.5 text-gray-500 hover:bg-gray-200 rounded-md transition-colors" title="Tandai Telah Dibaca">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </button>
                                    @else
                                        <button class="p-1.5 text-gray-300 cursor-not-allowed rounded-md" disabled>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </button>
                                    @endif

                                    <!-- Btn: Hapus -->
                                    <button wire:click="deleteMail({{ $mail->id }})" wire:confirm="Yakin ingin menghapus pesan dari {{ $mail->nama }}?" class="p-1.5 text-red-500 hover:bg-red-100 rounded-md transition-colors" title="Hapus">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="p-8 text-center text-gray-400 font-medium">
                                Belum ada pesan masuk saat ini.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</section>