<?php

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

new class extends Component
{
    // Properties untuk Form Ganti Nama Pengguna
    public $name = '';

    // Properties untuk Form Ganti Password
    public $current_password = '';
    public $password = '';
    public $password_confirmation = '';

    // Properties untuk Form Email Penerima
    public $email = '';

    // Load data saat komponen pertama kali dimuat
    public function mount()
    {
        $user = Auth::user();
        
        $this->name = $user->name;
        $this->email = $user->email;
    }

    // Fungsi Update Nama Pengguna
    public function updateName()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $user = Auth::user();
        $user->update([
            'name' => $this->name,
        ]);

        session()->flash('addSuccess', 'Nama pengguna berhasil diperbarui.');
        $this->dispatch('notify');
    }

    // Fungsi Update Password
    public function updatePassword()
    {
        $this->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();
        $user->update([
            'password' => Hash::make($this->password),
        ]);

        // Reset field password setelah berhasil
        $this->reset(['current_password', 'password', 'password_confirmation']);

        session()->flash('addSuccess', 'Password berhasil diperbarui.');
        $this->dispatch('notify');
    }

    // Fungsi Update Email Penerima
    public function updateEmail()
    {
        $this->validate([
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
        ]);

        $user = Auth::user();
        $user->update([
            'email' => $this->email,
        ]);

        session()->flash('addSuccess', 'Email penerima berhasil diperbarui.');
        $this->dispatch('notify');
    }
    
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

    <!-- Form Ganti Nama Pengguna -->
    <div class="bg-white rounded-md p-4 shadow-sm text-gray-800 flex flex-col gap-4 w-full">
        <div class="bg-[#f4f5f7] p-3 rounded-md flex justify-between items-center">
            <h2 class="font-semibold text-sm">Ganti Nama Pengguna</h2>
        </div>
        <form wire:submit.prevent="updateName" class="flex flex-col gap-4 px-2">
            <div class="flex flex-col gap-1.5 w-full md:w-1/2">
                <label class="text-sm font-medium text-gray-700">Nama Pengguna Baru</label>
                <input type="text" wire:model="name" placeholder="Masukkan nama pengguna baru" class="border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#00c853] focus:border-transparent">
                @error('name') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            <div class="flex mt-2">
                <button type="submit" class="bg-[#00c853] hover:bg-green-600 text-white font-medium py-1.5 px-4 rounded-md text-sm transition-colors duration-200">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- Form Ganti Password -->
    <div class="bg-white rounded-md p-4 shadow-sm text-gray-800 flex flex-col gap-4 w-full">
        <div class="bg-[#f4f5f7] p-3 rounded-md flex justify-between items-center">
            <h2 class="font-semibold text-sm">Ganti Password</h2>
        </div>
        <form wire:submit.prevent="updatePassword" class="flex flex-col gap-4 px-2">
            <div class="flex flex-col gap-1.5 w-full md:w-1/2">
                <label class="text-sm font-medium text-gray-700">Password Lama</label>
                <input type="password" wire:model="current_password" placeholder="••••••••" class="border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#00c853] focus:border-transparent">
                @error('current_password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            <div class="flex flex-col gap-1.5 w-full md:w-1/2">
                <label class="text-sm font-medium text-gray-700">Password Baru</label>
                <input type="password" wire:model="password" placeholder="••••••••" class="border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#00c853] focus:border-transparent">
                @error('password') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            <div class="flex flex-col gap-1.5 w-full md:w-1/2">
                <label class="text-sm font-medium text-gray-700">Konfirmasi Password Baru</label>
                <input type="password" wire:model="password_confirmation" placeholder="••••••••" class="border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#00c853] focus:border-transparent">
            </div>
            <div class="flex mt-2">
                <button type="submit" class="bg-[#00c853] hover:bg-green-600 text-white font-medium py-1.5 px-4 rounded-md text-sm transition-colors duration-200">
                    Update Password
                </button>
            </div>
        </form>
    </div>

    <!-- Form Email Penerima -->
    <div class="bg-white rounded-md p-4 shadow-sm text-gray-800 flex flex-col gap-4 w-full">
        <div class="bg-[#f4f5f7] p-3 rounded-md flex justify-between items-center">
            <h2 class="font-semibold text-sm">Email Penerima (Notifikasi Sistem)</h2>
        </div>
        <form wire:submit.prevent="updateEmail" class="flex flex-col gap-4 px-2">
            <div class="flex flex-col gap-1.5 w-full md:w-1/2">
                <label class="text-sm font-medium text-gray-700">Alamat Email</label>
                <input type="email" wire:model="email" placeholder="admin@domain.com" class="border border-gray-300 rounded-md p-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#00c853] focus:border-transparent">
                <p class="text-xs text-gray-500 mt-1">Email ini digunakan sebagai tujuan masuknya pesan atau notifikasi dari *user*.</p>
                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            <div class="flex mt-2">
                <button type="submit" class="bg-[#00c853] hover:bg-green-600 text-white font-medium py-1.5 px-4 rounded-md text-sm transition-colors duration-200">
                    Simpan Email
                </button>
            </div>
        </form>
    </div>

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

</section>