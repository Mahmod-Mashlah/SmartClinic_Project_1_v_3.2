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
        Schema::create('likes', function (Blueprint $table) {
            $table->foreignId('patiant_id')
                    ->constrained('patiants')
                    ->cascadeOnDelete()
                    ->nullable()
                    ->unsigned();
            $table->foreignId('doctor_id')
                    ->constrained('doctors')
                    ->cascadeOnDelete()
                    ->nullable()
                    ->unsigned();

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
        Schema::dropIfExists('likes');
    }
};
