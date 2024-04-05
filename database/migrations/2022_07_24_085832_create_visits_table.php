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
        Schema::create('visits', function (Blueprint $table) {
            $table->id();
            $table->String('Day');
            $table->Date("Date");
            $table->Time('time');
            $table->text('notes');

            $table->foreignId('clinic_id')
                    ->references('id')
                    ->on('clinics')
                    ->cascadeOnDelete()
                    ->nullable()->unsigned();

            $table->foreignId('doctor_id')
                    ->references('id')
                    ->on('doctors')
                    ->cascadeOnDelete()
                    ->nullable()->unsigned();

            $table->foreignId('patiant_id')
                    ->references('id')
                    ->on('patiants')
                    ->cascadeOnDelete()
                    ->nullable()->unsigned();

            $table->foreignId('treatment_id')
                    ->references('id')
                    ->on('treatments')
                    ->cascadeOnDelete()
                    ->nullable()->unsigned();


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
        Schema::dropIfExists('visits');
    }
};
