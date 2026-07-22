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
        Schema::create('organizations', function (Blueprint $table) {

            $table->id();

            // Nama organisasi / HIMA
            $table->string('name');

            // Singkatan (opsional)
            $table->string('code')->unique();

            // Deskripsi
            $table->text('description')->nullable();

            // Logo organisasi
            $table->string('logo')->nullable();

            // Status organisasi
            $table->enum('status', [
                'active',
                'inactive'
            ])->default('active');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizations');
    }
};