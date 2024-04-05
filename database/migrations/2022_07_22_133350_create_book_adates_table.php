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
        Schema::create('book_adates', function (Blueprint $table) {
            $table->id();
            // $table->integer('month');
            // $table->integer('Day');
            // $table->integer('hour');

            $table->date('date');
            $table->time('time');
            $table->foreignId('doctor_id')
                    ->references('id')
                    ->on('doctors')
                    ->cascadeOnDelete()
                    ->nullable()->unsigned();

            $table->foreignId('clinic_id')
                    ->references('id')
                    ->on('clinics')
                    ->cascadeOnDelete()
                    ->nullable()->unsigned();

            $table->foreignId('patiant_id')
                    ->references('id')
                    ->on('users')
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
        Schema::dropIfExists('book_adates');
    }
};
