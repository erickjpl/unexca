<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['save', 'create', 'read', 'update', 'delete', 'restore', 'login']);
            $table->string('ip');
            $table->string('user');
            $table->json('old');
            $table->json('new');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->morphs('actionable');
            $table->timestamp('create_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('audits');
    }
}
