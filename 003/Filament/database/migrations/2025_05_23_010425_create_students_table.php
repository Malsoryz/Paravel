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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('gender', ['L', 'P']);
            $table->enum('grade', ['X', 'XI', 'XII']);
            $table->enum('major', [
                'RPL',
                'Boga',
                'Busana',
                'Perhotelan',
                'Pariwisata',
                'Kesenian',
                'Kecantikan',
            ]);
            $table->string('address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
