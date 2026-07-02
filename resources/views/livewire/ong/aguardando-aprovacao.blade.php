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
        <p class="font-semibold text-gray-800 text-base mb-2">Cadastro recebido com sucesso!</p>
        <p>
            Seu cadastro como ONG / Protetor está sendo analisado pela nossa equipe.
            Você receberá uma notificação assim que sua conta for aprovada e poderá
            acessar todas as funcionalidades da plataforma.
        </p>
    </div>

    <div class="flex items-center justify-end">
        <button wire:click="logout"
            class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Sair
        </button>
    </div>
</div>
