<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();

            $table->string('description');
            $table->string('work_day');
            $table->time('start_time');
            $table->time('end_time');

            $table->string('experiance');
            $table->string('specialize');
            $table->integer('previewDuration(Minutes)');
            $table->integer('evalution');



            $table->foreignId('employee_id')
                          ->references('id')
                          ->on('employees')
                          ->cascadeOnDelete()
                          ->nullable()->unsigned();

            $table->foreignId('Clinic_id')
                          ->references('id')
                          ->on('clinics')
                          ->cascadeOnDelete()
                          ->nullable()->unsigned();


        //    $table->foreignId('patiant_id')
        //                ->constrained('patiants')
         //               ->cascadeOnDelete()
         //               ->nullable()->unsigned();
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
        Schema::dropIfExists('doctors');
    }
};
