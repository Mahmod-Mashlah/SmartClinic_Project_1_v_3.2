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
        Schema::create('secretaries', function (Blueprint $table) {
            $table->id();

            $table->foreignId('employee_id')->references('id')
                                                    ->on('employees')
                                                    ->cascadeOnDelete()
                                                    ->nullable()->unsigned();
            $table->string('expirance');
            $table->integer('TypingSpeed');

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
        Schema::dropIfExists('secretaries');
    }
};
