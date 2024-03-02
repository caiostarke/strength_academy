<?php

use App\Models\Treino;
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
        Schema::create('exercicios', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Treino::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->integer('series');
            $table->string('repeticoes');
            $table->string('descanso');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercicios');
    }
};
