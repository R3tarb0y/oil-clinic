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
        Schema::create('manufacture', function (Blueprint $table) {
            $table->bigIncrements('manufacID');
            // $table->integer('oil')
            $table->string('manufac');
            $table->text('address');
            $table->text('phone');
            $table->string('fax');
            $table->string('pCode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manufacture');
    }
};
