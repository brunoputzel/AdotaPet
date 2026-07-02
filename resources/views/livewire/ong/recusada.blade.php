<?php

use App\Livewire\Actions\Logout;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div>
    <div class="mb-4 text-sm text-gray-600">
        <p class="font-semibold text-gray-800 text-base mb-2">Cadastro não aprovado</p>
        <p>
            Seu cadastro não foi aprovado pela nossa equipe.
            Entre em contato conosco caso queira mais informações ou solicitar uma nova análise.
        </p>
    </div>

    <div class="flex items-center justify-end">
        <button wire:click="logout"
            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Sair
        </button>
    </div>
</div>
