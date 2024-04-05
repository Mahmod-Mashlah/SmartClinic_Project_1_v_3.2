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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
             $table->String('name');
             $table->String('type_medicine');
             $table->String('type_give');
             $table->integer('number_give');



             $table->foreignId('prescription_id')
             ->references('id')
             ->on('prescriptions')
             ->cascadeOnDelete()
             ->nullable();

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
        Schema::dropIfExists('medicines');
    }
};
