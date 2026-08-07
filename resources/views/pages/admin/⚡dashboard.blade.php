<?php

use Livewire\Component;

new class extends Component
{
    public function render()
    {
        return $this->view()
            ->layout('layouts.admin');
    }
};
?>

<div class="flex w-full h-full bg-white shadow-md rounded-lg items-center justify-center ">
    <p class="text-gray-800">page admin dashboard</p>
</div>