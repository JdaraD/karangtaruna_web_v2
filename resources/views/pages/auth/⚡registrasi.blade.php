<?php

use Livewire\Component;

new class extends Component
{
    
    public function render()
    {
        return $this->view()
            ->layout('layouts.admin', [
                'title' => 'Silakan Daftar Akun Anda'
            ]);
    }
};
?>

<section class="min-h-screen w-full flex items-center justify-center relative overflow-hidden bg-slate-900 py-10 px-4">
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-20 -right-20 w-96 h-96 bg-linear-to-br from-purple-600/30 to-indigo-600/30 rounded-full blur-3xl animate-pulse"></div>
        <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-linear-to-tr from-blue-600/30 to-cyan-500/30 rounded-full blur-3xl animate-pulse delay-1000"></div>
        
        <div class="absolute inset-0 bg-[linear-gradient(to_right,#1f293712_1px,transparent_1px),linear-gradient(to_bottom,#1f293712_1px,transparent_1px)] bg-size[32px_32px]"></div>

        <div class="absolute top-1/3 right-10 w-24 h-24 border border-purple-500/20 rounded-full animate-[bounce_5s_infinite]"></div>
        <div class="absolute bottom-1/3 left-12 w-40 h-40 border border-indigo-500/20 rounded-3xl rotate-12 animate-[spin_15s_linear_infinite]"></div>
    </div>

    <div class="relative z-10 w-full max-w-5xl bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
        
        <div class="w-full md:w-5/12 p-8 md:p-12 bg-linear-to-br from-indigo-900/80 via-slate-900/90 to-indigo-950/80 text-white flex flex-col justify-between border-b md:border-b-0 md:border-r border-white/10">
            <div class="relative z-10">
                <div class="flex items-center space-x-3 mb-10">
                    <div class="w-12 h-12 rounded-2xl bg-linear-to-tr from-cyan-400 to-indigo-500 flex items-center justify-center shadow-lg shadow-cyan-500/30">
                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold tracking-wider bg-clip-text text-transparent bg-linear-to-r from-white to-slate-300">
                        SYNERGY INC.
                    </span>
                </div>

                <h2 class="text-3xl font-extrabold leading-tight mb-6">
                    Mulai Perjalanan<br/>Digital Anda<br/>Bersama Kami.
                </h2>
                
                <ul class="space-y-4 text-slate-300 text-sm">
                    <li class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-cyan-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                        <span>Akses dashboard analitik real-time.</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-cyan-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                        <span>Kolaborasi tim tanpa batas.</span>
                    </li>
                    <li class="flex items-center space-x-3">
                        <svg class="w-5 h-5 text-cyan-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"></path></svg>
                        <span>Keamanan data tingkat enterprise.</span>
                    </li>
                </ul>
            </div>

            <div class="mt-8 pt-6 border-t border-white/10 text-xs text-slate-400">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-cyan-400 hover:text-cyan-300 font-semibold underline decoration-2">Masuk di sini</a>
            </div>
        </div>

        <div class="w-full md:w-7/12 p-8 md:p-12 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md flex flex-col justify-center">
            <div class="mb-8 text-center md:text-left">
                <h3 class="text-2xl font-bold text-slate-800 dark:text-white">Buat Akun Baru</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Lengkapi data di bawah untuk mendaftar</p>
            </div>

            <form wire:submit.prevent="register" class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider mb-2">Nama Lengkap</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        <input type="text" wire:model="name" class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:text-white transition" placeholder="Contoh: John Doe">
                    </div>
                    @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider mb-2">Alamat Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                        </span>
                        <input type="email" wire:model="email" class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:text-white transition" placeholder="john@example.com">
                    </div>
                    @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider mb-2">Kata Sandi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                            </svg>
                        </span>
                        <input type="password" wire:model="password" class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:text-white transition" placeholder="••••••••">
                    </div>
                    @error('password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider mb-2">Konfirmasi Sandi</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                            </svg>
                        </span>
                        <input type="password" wire:model="password_confirmation" class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:text-white transition" placeholder="••••••••">
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="flex items-start text-xs text-slate-600 dark:text-slate-400 cursor-pointer group">
                        <input type="checkbox" wire:model="terms" class="mt-1 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 mr-2">
                        <span>Saya menyetujui <a href="#" class="text-indigo-600 dark:text-indigo-400 font-medium hover:underline">Syarat & Ketentuan</a> serta <a href="#" class="text-indigo-600 dark:text-indigo-400 font-medium hover:underline">Kebijakan Privasi</a> yang berlaku.</span>
                    </label>
                    @error('terms') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div class="md:col-span-2">
                    <button type="submit" class="w-full py-3.5 px-4 bg-linear-to-r from-indigo-600 to-cyan-500 hover:from-indigo-700 hover:to-cyan-600 text-white font-semibold rounded-xl shadow-lg shadow-indigo-500/20 transform active:scale-95 transition duration-150">
                        <span wire:loading.remove wire:target="register">Daftar Sekarang</span>
                        <span wire:loading wire:target="register" class="flex items-center justify-center">
                            <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                            </svg>
                            Mendaftarkan...
                        </span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>