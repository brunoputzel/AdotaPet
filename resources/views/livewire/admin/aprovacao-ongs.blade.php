<?php

use App\Enums\OngStatus;
use App\Models\Ong;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    public function aprovar(int $id): void
    {
        Ong::findOrFail($id)->update(['status' => OngStatus::Aprovada]);
    }

    public function recusar(int $id): void
    {
        Ong::findOrFail($id)->update(['status' => OngStatus::Recusada]);
    }

    public function with(): array
    {
        return [
            'ongs' => Ong::with('user')
                ->where('status', OngStatus::Pendente)
                ->latest()
                ->get(),
        ];
    }
}; ?>

<div>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6">ONGs Aguardando Aprovação</h2>

                    @if ($ongs->isEmpty())
                        <p class="text-sm text-gray-500">Nenhuma ONG pendente de aprovação.</p>
                    @else
                        <div class="space-y-6">
                            @foreach ($ongs as $ong)
                            <div class="border rounded-lg p-4">
                                <div class="flex items-start gap-4">

                                    @if ($ong->foto_ong)
                                    <img src="{{ $ong->foto_ong }}" alt="Foto da ONG"
                                        class="w-16 h-16 rounded object-cover shrink-0">
                                    @else
                                    <div class="w-16 h-16 rounded bg-gray-100 flex items-center justify-center shrink-0">
                                        <span class="text-xs text-gray-400">Sem foto</span>
                                    </div>
                                    @endif

                                    <div class="flex-1 grid grid-cols-2 gap-x-8 gap-y-2 text-sm">
                                        <div>
                                            <span class="text-gray-500">Nome</span>
                                            <p class="font-medium text-gray-900">{{ $ong->user->name }}</p>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">CNPJ</span>
                                            <p class="font-medium text-gray-900">{{ $ong->cnpj }}</p>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">E-mail</span>
                                            <p class="text-gray-900">{{ $ong->user->email }}</p>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Cadastro</span>
                                            <p class="text-gray-900">{{ $ong->user->created_at->format('d/m/Y') }}</p>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Chave Pix</span>
                                            <p class="text-gray-900">{{ $ong->chave_pix ?? '—' }}</p>
                                        </div>
                                        <div>
                                            <span class="text-gray-500">Endereço</span>
                                            <p class="text-gray-900">{{ $ong->endereco ?? '—' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex gap-2 mt-4 justify-end">
                                    <button wire:click="aprovar({{ $ong->id }})"
                                        class="px-4 py-1.5 text-xs font-medium bg-green-600 text-white rounded hover:bg-green-700 focus:outline-none">
                                        Aprovar
                                    </button>
                                    <button wire:click="recusar({{ $ong->id }})"
                                        wire:confirm="Tem certeza que deseja recusar esta ONG? O status será alterado para 'recusada' e a ONG será notificada."
                                        class="px-4 py-1.5 text-xs font-medium bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none">
                                        Recusar
                                    </button>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
