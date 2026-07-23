<?php

use Livewire\Attributes\Layout;
use Livewire\Component;

new class extends Component
{

    public function render()
    {
        return $this->view()
            ->layout('Layouts.user');
    }
}
?>

<div class="flex justify-center items-center align-content-center w-full h-200">
    <p>page home user</p>
</div>