<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')]
class extends Component {
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login()
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        return redirect()->route( match (auth()->user()->role) {
            'customer' => 'dashboard',
            'admin' => 'admin.dashboard',
            'rider' => 'rider.dashboard',
        });
    }
}; ?>

<div class="grid grid-cols-1 2xl:grid-cols-2 relative">
        <div class=" hidden 2xl:block bg-gradient-to-br from-[#2E7D32] to-[#66BB6A] min-h-screen">
            <div class="p-32 flex flex-col items-center justify-center space-y-5">
                 <span class=" rounded-xl p-[10px] bg-[#2E7D32]">
                      <x-ui.icon name="ps:leaf" variant="bold" class="size-6   "/>
                 </span>
                <h1 class="text-white mb-6 text-5xl font-bold">Welcome to EcoMart</h1>
                <p class="text-white text-xl">Your destination for fresh, organic groceries.</p>

                <img src="{{asset('login-fruit-img.jpg')}}"
                     alt="login-fruit"
                     class="w-full h-full object-cover object-center rounded-3xl">
            </div>
        </div>
    <div class="bg-white flex flex-col items-center min-h-screen justify-center ">
        <div class=" flex 2xl:hidden items-center gap-3 pb-2">
                       <span class="rounded-xl p-[10px] bg-[#2E7D32]">
                           <x-ui.icon name="ps:leaf" variant="bold" class="size-6 "/>
                       </span>
            <h1 class="text-2xl text-[#2E7D32]">EcoMart</h1>
        </div>
        <fieldset class="shadow-lg rounded-xl p-10">
            <h1 class="text-gray-900 text-2xl">Welcome Back</h1>
            <p class="text-gray-500 text-base">Sign in to your account to continue</p>
            <form wire:submit="login">
                <!-- Email Address -->
                <div class="pt-5">
                    <x-input-label for="email" :value="__('Email')"/>
                    <x-text-input wire:model="form.email" id="email"
                                  class="block mt-1 w-full rounded-full focus:border-green-500 focus:ring-green-500"
                                  type="email"
                                  name="email"
                                  placeholder="your.email@example.com"
                                  required autofocus autocomplete="username"/>
                    <x-input-error :messages="$errors->get('form.email')" class="mt-2"/>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')"/>

                    <x-text-input wire:model="form.password" id="password"
                                  class="block mt-1 w-full focus:border-green-500 focus:ring-green-500"
                                  type="password"
                                  name="password"
                                  placeholder="Enter your password"
                                  required autocomplete="current-password"/>

                    <x-input-error :messages="$errors->get('form.password')" class="mt-2"/>
                </div>

                <div class=" mt-4">
                    <x-ui.button type="submit" class="w-full bg-green-700 text-white py-3.5 rounded-xl hover:bg-green-600 focus:bg-green-600 transition-colors text-center">Sign In</x-ui.button>
                </div>

                <div class="mt-4 text-center">
                    <p class="text-gray-500 text-sm">
                        Don't have an account?
                        <a href="{{ route('register') }}"
                           class="text-[#2E7D32] hover:text-[#66BB6A] text-sm">Sign up for free</a>
                    </p>
                </div>
            </form>
        </fieldset>
    </div>

</div>
