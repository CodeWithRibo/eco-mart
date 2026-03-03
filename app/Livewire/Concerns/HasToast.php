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

    public  function successCheckout(string $content): void
    {
        $this->dispatch('notify',
            type: 'success',
            content: $content,
            duration: 4000
        );
    }

    public  function successRemoveCart(string $content): void
    {
        $this->dispatch('notify',
            type: 'success',
            content: $content,
            duration: 4000
        );
    }
    public  function checkOutFailed(string $content): void
    {
        $this->dispatch('notify',
            type: 'error',
            content: $content,
            duration: 4000
        );
    }

    public  function addAddressFailed(string $content)
    {
        return $this->dispatch('notify',
            type: 'error',
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
    public function noSelectedAddress(string $content)
    {
        return $this->dispatch('notify',
            type: 'error',
            content: $content,
            duration: 4000
        );
    }

    public function info(string $content)
    {
        return $this->dispatch('notify',
            type: 'info',
            content: $content,
            duration: 4000
        );
    }

    public function success(string $content)
    {
        return $this->dispatch('notify',
            type: 'success',
            content: $content,
            duration: 4000
        );
    }

    public function error(string $content)
    {
        return $this->dispatch('notify',
            type: 'error',
            content: $content,
            duration: 4000
        );
    }

}
