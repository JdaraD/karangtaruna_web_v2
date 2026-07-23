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

<div>
    <p>page home user</p>
</div>