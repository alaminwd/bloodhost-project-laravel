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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title1');
            $table->longText('desp1');
            $table->string('title2');
            $table->longText('desp2');
            $table->string('title3');
            $table->longText('desp3');
            $table->string('title4');
            $table->longText('desp4');
            $table->string('address')->nullable();
            $table->string('about_img');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
