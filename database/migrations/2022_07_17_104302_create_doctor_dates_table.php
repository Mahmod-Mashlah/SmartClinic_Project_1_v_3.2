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
        Schema::create('doctor_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('clinic_date_id')
                    ->references('id')
                    ->on('clinic_dates')
                    ->cascadeOnDelete()
                    ->nullable()->unsigned();

            $table->foreignId('doctor_id')
                    ->references('id')
                    ->on('doctors')
                    ->cascadeOnDelete()
                    ->nullable()->unsigned();

            $table->date('startShafet');
            $table->date('endShafet');
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
        Schema::dropIfExists('doctor_dates');
    }
};
