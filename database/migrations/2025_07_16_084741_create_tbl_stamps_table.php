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
        Schema::create('tbl_stamps', function (Blueprint $table) {
            $table->id('stp_id');
            $table->string('stp_to', 100);
            $table->string('stp_from', 100);
            $table->text('stp_message');
            $table->string('stp_color', 20)->default('blue');
            $table->string('stp_edit_code', 10)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_stamps');
    }
};
