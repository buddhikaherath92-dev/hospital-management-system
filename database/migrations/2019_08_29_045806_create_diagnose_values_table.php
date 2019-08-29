<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiagnoseValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diagnose_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('diagnose_id');
            $table->decimal('hba1c')->nullable();
            $table->decimal('cholesterol')->nullable();
            $table->decimal('bp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('diagnose_values');
    }
}
