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
        Schema::create('donor_histories', function (Blueprint $table) {
            $table->id();
            $table->integer('donor_id');
            $table->string('reciever_name');
            $table->string('reciever_number');
            $table->string('hospital_name');
            $table->string('hospital_address');
            $table->date('donate_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('donor_histories');
    }
};
