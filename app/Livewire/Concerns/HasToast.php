<?php

namespace App\Livewire\Concerns;

trait HasToast
{
    public function addedCart(string $content): void
    {
        $this->dispatch('notify',
            type: 'success',
            content: $content,
            duration: 4000
        );
    }

    public function existingAddedCart(string $content): void
    {
        $this->dispatch('notify',
            type: 'success',
            content: $content,
            duration: 4000
        );
    }
}
