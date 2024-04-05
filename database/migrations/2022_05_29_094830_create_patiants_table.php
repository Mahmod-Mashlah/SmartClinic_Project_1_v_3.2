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
        Schema::create('patiants', function (Blueprint $table) {
            $table->id();


            $table->text('Careear');
            $table->integer('weigh');
            $table->text('description');


            $table->foreignId('user_id')
                    ->references('id')
                    ->on('users')
                    ->cascadeOnDelete()
                    ->nullable()->unsigned();

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
        Schema::dropIfExists('patiants');
    }
};
