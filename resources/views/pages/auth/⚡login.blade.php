<?php

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\identity;
use App\Models\User;

new class extends Component
{
    public $email, $identity, $user;
    public $password;
    public $remember = false;

    public function loadIdentity()
    {
        $this->identity = identity::latest()->first();
    }

    public function loadUser()
    {
        $this->user = User::get();
    }

    public function mount()
    {
        $this->loadIdentity();
        $this->loadUser();
    }

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function login()
    {
        $this->validate();

        // Coba autentikasi menggunakan Auth Laravel
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();

            // Redirect ke halaman dashboard atau halaman setelah login sukses
            return redirect()->intended('/dashboard');
        }

        // Jika gagal, tambahkan error ke form
        $this->addError('email', 'Email atau kata sandi yang Anda masukkan salah.');
    }

    public function render()
    {
        return $this->view()
            ->layout('layouts.admin', [
                'title' => 'Selamat Datang'
            ]);
    }
};
?>

<section class="min-h-screen w-full flex items-center justify-center relative overflow-hidden bg-slate-900 py-10 px-4">
    <div class="absolute inset-0 z-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-20 -left-20 w-96 h-96 bg-linear-to-br from-indigo-600/30 to-purple-600/30 rounded-full blur-3xl animate-pulse"></div>
        
        <div class="absolute -bottom-20 -right-20 w-96 h-96 bg-linear-to-tr from-cyan-500/30 to-blue-600/30 rounded-full blur-3xl animate-pulse delay-1000"></div>

        <div class="absolute inset-0 bg-[linear-gradient(to_right,#1f293712_1px,transparent_1px),linear-gradient(to_bottom,#1f293712_1px,transparent_1px)] bg-size[32px_32px]"></div>

        <div class="absolute top-1/4 left-10 w-32 h-32 border border-indigo-500/20 rounded-3xl rotate-45 animate-[spin_20s_linear_infinite]"></div>
        <div class="absolute bottom-1/4 right-12 w-48 h-48 border border-cyan-500/20 rounded-full animate-[ping_4s_cubic-bezier(0,0,0.2,1)_infinite]"></div>
    </div>

    <div class="relative z-10 w-full max-w-4xl bg-white/10 backdrop-blur-xl border border-white/20 rounded-3xl shadow-2xl overflow-hidden flex flex-col md:flex-row">
        
        <div class="w-full md:w-1/2 p-8 md:p-12 bg-linear-to-br from-indigo-900/80 via-slate-900/90 to-indigo-950/80 text-white flex flex-col justify-between border-b md:border-b-0 md:border-r border-white/10 relative">
            @if ($identity)
            <div class="relative z-10">
                <div class="flex items-center space-x-3 mb-8">
                    <div class="rounded-2xl p-1 bg-linear-to-tr from-cyan-400 to-indigo-500 flex items-center justify-center shadow-lg shadow-cyan-500/30">
                        <img src="{{ asset('storage/' .$identity->image) }}" alt="" class="w-18 h-16 object-cover">
                    </div>
                    <span class="text-2xl font-bold tracking-wider bg-clip-text text-transparent bg-linear-to-r from-white to-slate-300">
                        {{ $identity->name }}
                    </span>
                </div>
                    
                    <h2 class="text-3xl font-extrabold leading-tight mb-4">
                        Innovate.<br/>Connect.<br/>Succeed.
                </h2>
                <p class="text-slate-300 text-sm leading-relaxed">
                    Selamat datang di platform terintegrasi kami. Akses seluruh kebutuhan manajemen dan analisis dalam satu tempat.
                </p>
            </div>

            <div class="mt-8 pt-6 border-t border-white/10 text-xs text-slate-400 relative z-10">
                &copy; {{ date('Y') }} {{ $identity->name }} All rights reserved.
            </div>
            @endif
        </div>

        <div class="w-full md:w-1/2 p-8 md:p-12 bg-white/80 dark:bg-slate-900/80 backdrop-blur-md flex flex-col justify-center">
            <div class="mb-8">
                <h3 class="text-2xl font-bold text-slate-800 dark:text-white">Selamat Datang Kembali</h3>
                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">Silakan masuk ke akun Anda</p>
            </div>

            <form wire:submit.prevent="login" class="space-y-5">
                <div>
                    <label class="block text-xs font-semibold text-slate-600 dark:text-slate-300 uppercase tracking-wider mb-2">Nama Pengguna / Email</label>
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 flex items-center pl-3.5 pointer-events-none text-slate-400">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                        </span>
                        <input type="text" wire:model="email" class="w-full pl-10 pr-4 py-3 bg-slate-50 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 dark:text-white transition" placeholder="Masukkan email atau username">
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

                <div class="flex items-center justify-between text-xs">
                    <label class="flex items-center text-slate-600 dark:text-slate-400 cursor-pointer">
                        <input type="checkbox" wire:model="remember" class="rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 mr-2">
                        Ingat saya
                    </label>
                    <a href="#" class="text-indigo-600 dark:text-indigo-400 hover:underline font-medium">Lupa Kata Sandi?</a>
                </div>

                <div class="flex flex-col gap-2 w-full h-full">
                    <button type="submit" class="w-full py-3.5 px-4 bg-linear-to-r from-indigo-600 to-cyan-500 hover:from-indigo-700 hover:to-cyan-600 text-white font-semibold rounded-xl shadow-lg shadow-indigo-500/20 transform active:scale-95 transition duration-150">
                        <span wire:loading.remove wire:target="login">Masuk</span>
                        <span wire:loading wire:target="login">Memproses...</span>
                    </button>
    
                    @if ($user->isEmpty())
                        <div class="flex w-full h-auto justify-end">
                            <a href="{{ route('registrasi') }}" class="text-xs font-semibold capitalize text-white hover:text-gray-100 hover:underline">Registrasi Akun</a>
                        </div>
                    @else
                        <div class="hidden w-full h-auto justify-end">
                            <a href="{{ route('registrasi') }}" class="text-xs font-semibold capitalize text-white hover:text-gray-100 hover:underline">Registrasi Akun</a>
                        </div>
                    @endif

                </div>
            </form>
        </div>
    </div>
</section>