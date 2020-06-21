<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluationDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('evaluation_details', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('is_valid')->comment('0 = FALSE, 1 = TRUE');
            $table->foreignId('answer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('evaluation_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('evaluation_details');
    }
}
