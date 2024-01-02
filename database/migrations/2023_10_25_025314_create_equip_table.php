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
        Schema::create('equip', function (Blueprint $table) {
            $table->bigIncrements('equipID');
            $table->integer('customerID');
            $table->integer('areaID');
            $table->integer('modelID');
            $table->integer('lubeID');
            $table->integer('equipCode');
            $table->string('description');
            $table->string('engineNumber');
            $table->string('sumpTank');
            $table->string('power');
            $table->string('samplingPoint');
            $table->string('coolant');
            $table->string('oilFilter');
            $table->string('filterRating');
            $table->string('lubeSystem');
            $table->string('shaftSpeed');
            $table->string('shaftMotion');
            $table->string('service');
            $table->string('oilInterval');
            $table->string('oilTemp');
            $table->string('loads');
            $table->string('environment');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equip');
    }
};
