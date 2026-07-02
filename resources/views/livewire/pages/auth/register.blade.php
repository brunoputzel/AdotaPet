<?php

use App\Models\Ong;
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
    public string $tipo_perfil = 'adotante';
    public string $cnpj = '';

    public function register(): void
    {
        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'tipo_perfil' => ['required', 'string', 'in:adotante,ong_protetor'],
        ];

        if ($this->tipo_perfil === 'ong_protetor') {
            $rules['cnpj'] = ['required', 'string', 'min:14', 'max:18', 'unique:'.Ong::class.',cnpj'];
        }

        $validated = $this->validate($rules);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        if ($user->isOng()) {
            Ong::create(['user_id' => $user->id, 'cnpj' => $this->cnpj]);
            Auth::login($user);
            $this->redirect(route('ong.aguardando-aprovacao', absolute: false), navigate: true);
            return;
        }

        Auth::login($user);
        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('E-mail')" />
            <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Tipo de Perfil -->
        <div class="mt-4">
            <x-input-label for="tipo_perfil" :value="__('Tipo de Perfil')" />
            <select wire:model.live="tipo_perfil" id="tipo_perfil" name="tipo_perfil" required
                class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                <option value="adotante">Adotante</option>
                <option value="ong_protetor">ONG / Protetor</option>
            </select>
            <x-input-error :messages="$errors->get('tipo_perfil')" class="mt-2" />
        </div>

        <!-- CNPJ (apenas ONG) -->
        @if ($tipo_perfil === 'ong_protetor')
        <div class="mt-4">
            <x-input-label for="cnpj" :value="__('CNPJ')" />
            <x-text-input wire:model="cnpj" id="cnpj" class="block mt-1 w-full"
                type="text" name="cnpj" placeholder="00.000.000/0000-00" />
            <x-input-error :messages="$errors->get('cnpj')" class="mt-2" />
        </div>
        @endif

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirmar Senha')" />
            <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                {{ __('Já tem conta?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Cadastrar') }}
            </x-primary-button>
        </div>
    </form>
</div>
