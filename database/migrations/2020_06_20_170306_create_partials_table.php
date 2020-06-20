<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partials', function (Blueprint $table) {
            $table->id();
            $table->enum('activity', array('partial', 'questionnaire', 'homework', 'exercise'));
            $table->tinyInteger('is_evaluated')->default(0)->comment('0 will not be evaluated');
            $table->tinyInteger('opportunities')->default(0)->comment('0 equals free');
            $table->tinyInteger('attempt')->nullable();
            $table->time('attempt_time', 0)->nullable();
            $table->foreignId('temary_id')->constrained()->cascadeOnDelete();
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
        Schema::dropIfExists('partials');
    }
}
