<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {

            // Datos de la empresa
            $table->id();
            $table->string('razon_social');
            $table->string('ruc')->unique();
            $table->string('direccion');
            $table->string('telefono')->nullable();
            $table->string('email')->nullable();
            $table->string('logo_path')->nullable();

            // Emitir comprobantes electronicos Boletas Facturas
            $table->string('sol_user');
            $table->string('sol_pass');
            $table->string('cert_path');

            // Emitir notas de credito / debito
            $table->string('client_id')->nullable();
            $table->string('client_secret')->nullable();

            $table->boolean('production')->default(false);

            $table->foreignId('user_id')->constrained('users');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
