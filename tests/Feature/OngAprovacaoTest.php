<?php

use App\Enums\OngStatus;
use App\Models\Ong;
use App\Models\User;
use Livewire\Volt\Volt;

test('admin vê apenas ONGs com status pendente no painel', function () {
    $admin    = User::factory()->create(['tipo_perfil' => 'administrador']);
    $pendente = Ong::factory()->pendente()->create();
    $aprovada = Ong::factory()->aprovada()->create();
    $recusada = Ong::factory()->recusada()->create();

    $this->actingAs($admin);

    Volt::test('admin.aprovacao-ongs')
        ->assertSee($pendente->user->name)
        ->assertDontSee($aprovada->user->name)
        ->assertDontSee($recusada->user->name);
});

test('admin pode aprovar uma ONG pendente', function () {
    $admin = User::factory()->create(['tipo_perfil' => 'administrador']);
    $ong   = Ong::factory()->pendente()->create();

    $this->actingAs($admin);

    Volt::test('admin.aprovacao-ongs')
        ->call('aprovar', $ong->id);

    expect($ong->fresh()->status)->toBe(OngStatus::Aprovada);
});

test('admin pode recusar uma ONG e o registro é preservado', function () {
    $admin  = User::factory()->create(['tipo_perfil' => 'administrador']);
    $ong    = Ong::factory()->pendente()->create();
    $userId = $ong->user_id;

    $this->actingAs($admin);

    Volt::test('admin.aprovacao-ongs')
        ->call('recusar', $ong->id);

    expect($ong->fresh()->status)->toBe(OngStatus::Recusada);

    $this->assertDatabaseHas('users', ['id' => $userId]);
    $this->assertDatabaseHas('ongs', ['id' => $ong->id, 'status' => OngStatus::Recusada->value]);
});

test('não-admin recebe 403 ao tentar acessar o painel de aprovação', function () {
    $adotante = User::factory()->create(['tipo_perfil' => 'adotante']);

    $this->actingAs($adotante)
        ->get(route('admin.ongs.pendentes'))
        ->assertForbidden();
});

test('ONG pendente é redirecionada para aguardando aprovação ao fazer login', function () {
    $ong = Ong::factory()->pendente()->create();

    Volt::test('pages.auth.login')
        ->set('form.email', $ong->user->email)
        ->set('form.password', 'password')
        ->call('login')
        ->assertRedirect(route('ong.aguardando-aprovacao', absolute: false));
});

test('ONG recusada é redirecionada para tela de recusada ao fazer login', function () {
    $ong = Ong::factory()->recusada()->create();

    Volt::test('pages.auth.login')
        ->set('form.email', $ong->user->email)
        ->set('form.password', 'password')
        ->call('login')
        ->assertRedirect(route('ong.recusada', absolute: false));
});

test('tela de recusada exibe mensagem correta', function () {
    $ong = Ong::factory()->recusada()->create();

    $this->actingAs($ong->user)
        ->get(route('ong.recusada'))
        ->assertOk()
        ->assertSee('Seu cadastro não foi aprovado pela nossa equipe');
});
