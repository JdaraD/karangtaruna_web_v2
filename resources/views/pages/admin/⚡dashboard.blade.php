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

<div>
    <p>page admin dashboard</p>
</div>