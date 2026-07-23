<?php

use Livewire\Component;

new class extends Component
{
    //
};
?>

    <aside class="w-64 bg-gray-800 p-6 flex flex-col space-y-4">
        <div class="font-bold text-2xl text-emerald-400 mb-6">AdminPanel</div>
        <a href="/admin/dashboard" class="hover:text-emerald-400">Dashboard</a>
        <a href="/admin/users" class="hover:text-emerald-400">Kelola User</a>
        <a href="/admin/settings" class="hover:text-emerald-400">Pengaturan</a>
    </aside>