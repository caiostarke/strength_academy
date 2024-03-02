<?php

use App\Models\ProgressaoRecord;
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
        Schema::create('progressaos', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(ProgressaoRecord::class)->constrained()->cascadeOnDelete();
            $table->integer('weight');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progressaos');
    }
};
