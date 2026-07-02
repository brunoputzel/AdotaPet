<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Adiciona a coluna nova e os campos extras — aprovada ainda existe aqui
        Schema::table('ongs', function (Blueprint $table) {
            $table->enum('status', ['pendente', 'aprovada', 'recusada'])
                  ->default('pendente')
                  ->after('cnpj');
            $table->string('chave_pix')->nullable()->after('status');
            $table->string('endereco')->nullable()->after('chave_pix');
            $table->string('foto_ong')->nullable()->after('endereco');
        });

        // 2. Migra dados existentes antes de dropar a coluna antiga
        DB::table('ongs')->where('aprovada', true)->update(['status' => 'aprovada']);
        // aprovada = false já é coberto pelo default 'pendente'

        // 3. Remove a coluna antiga
        Schema::table('ongs', function (Blueprint $table) {
            $table->dropColumn('aprovada');
        });
    }

    public function down(): void
    {
        Schema::table('ongs', function (Blueprint $table) {
            $table->boolean('aprovada')->default(false)->after('cnpj');
        });

        DB::table('ongs')->where('status', 'aprovada')->update(['aprovada' => true]);
        DB::table('ongs')->whereIn('status', ['pendente', 'recusada'])->update(['aprovada' => false]);

        Schema::table('ongs', function (Blueprint $table) {
            $table->dropColumn(['status', 'chave_pix', 'endereco', 'foto_ong']);
        });
    }
};
