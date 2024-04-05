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
        Schema::create('Internal_procedures', function (Blueprint $table) {
            $table->id();
            $table->String('name');
            $table->String('type');
            $table->String('place');

            $table->foreignId('examination_id')
                          ->references('id')
                          ->on('examinations')
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
        Schema::dropIfExists('Internal_procedures');
    }
};
