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
        Schema::create('movies_studios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('studios_id');
            $table->foreign('studios_id')->references('id')->on('studios');
            $table->unsignedBigInteger('movies_id');
            $table->foreign('movies_id')->references('id')->on('movies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies_studios');
    }
};
