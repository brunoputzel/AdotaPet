<?php

namespace App\Models;

use App\Enums\OngStatus;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['user_id', 'cnpj', 'status', 'chave_pix', 'endereco', 'foto_ong'])]
class Ong extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return ['status' => OngStatus::class];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function isPendente(): bool
    {
        return $this->status === OngStatus::Pendente;
    }

    public function isAprovada(): bool
    {
        return $this->status === OngStatus::Aprovada;
    }

    public function isRecusada(): bool
    {
        return $this->status === OngStatus::Recusada;
    }
}
