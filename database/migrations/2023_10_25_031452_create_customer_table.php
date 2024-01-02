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
        Schema::create('customer', function (Blueprint $table) {
            $table->bigIncrements('customerID');
            $table->integer('cityID');
            $table->integer('industryID');
            $table->integer('salesID');
            $table->integer('supportID');
            $table->integer('officeID');
            $table->string('customerCode');
            $table->string('customerName');
            $table->string('address');
            $table->string('postCode');
            $table->string('phone');
            $table->string('fax');
            $table->string('email');
            $table->string('logo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer');
    }
};
