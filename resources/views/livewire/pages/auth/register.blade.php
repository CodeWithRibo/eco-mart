<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
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
            <p class="text-gray-500 text-base">Register in to your account to continue</p>
            <form wire:submit="register">
                <!-- Name -->
                <div class="mt-2">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />

                    <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                  type="password"
                                  name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mt-4 flex items-center justify-end">

                    <a class="text-sm text-[#2E7D32] hover:text-[#66BB6A]  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                        {{ __('Already registered?') }}
                    </a>
                </div>

                <div class=" mt-4">
                    <x-ui.button type="submit" class="w-full bg-green-700 text-white py-3.5 rounded-xl hover:bg-green-600 focus:bg-green-600 transition-colors text-center">Register</x-ui.button>
                </div>

            </form>
        </fieldset>
    </div>

</div>

