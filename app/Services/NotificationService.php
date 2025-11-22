<?php

namespace App\Services;
use Sheaf\UI\Notifications\Toast;
class NotificationService
{
    public static function notifCreateProduct(): void
    {
        session()->flash('notify', [
            'content' => 'Added Product Successfully',
            'type' => 'success',
            'duration' => 3000
        ]);
    }

    public static function notifDeleteProduct(): void
    {
        session()->flash('notify', [
            'content' => 'Deleted Product Successfully',
            'type' => 'success',
            'duration' => 3000
        ]);
    }

    public static function notifEditSuccessProduct(): void
    {
        session()->flash('notify', [
            'content' => 'Edit Product Successfully',
            'type' => 'success',
            'duration' => 3000
        ]);
    }

    public static function notifNoChangeDetected(): void
    {
        session()->flash('notify', [
            'content' => 'No changes detected',
            'type' => 'info',
            'duration' => 3000
        ]);
    }

    public static function notifAddedCart(): void
    {
        session()->flash('notify', [
            'content' => 'Added cart successfully',
            'type' => 'success',
            'duration' => 3000
        ]);
    }
}
