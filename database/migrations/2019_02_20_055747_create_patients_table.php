<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('address');
            $table->string('tel_no', '15')->nullable();
            $table->string('blood_group', '6');
            $table->integer('patient_category');
            $table->longText('medical_condition')->nullable();
            $table->longText('allergies')->nullable();
            $table->float('weight');
            $table->float('height');
            $table->string('age', '5');
            $table->string('gender', '7');
            $table->integer('user_id');
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
        Schema::dropIfExists('patients');
    }
}
