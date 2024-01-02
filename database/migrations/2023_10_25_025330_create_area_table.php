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
        Schema::create('area', function (Blueprint $table) {
            $table->bigIncrements('areaID');
            $table->integer('customerID');
            $table->integer('cityID');
            $table->integer('areaCode');
            $table->string('areaName');
            $table->string('address');
            $table->string('postCode');
            $table->string('phone');
            $table->string('fax');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area');
    }
};
