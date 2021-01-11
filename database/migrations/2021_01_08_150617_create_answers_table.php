<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('work_id');
            $table->unsignedBigInteger('question_id');
            $table->integer('answer')->default(0);
            $table->integer('time_in_sec')->default(0);
            $table->boolean('is_correct')->default(false);
            $table->timestamps();

            $table->foreign('work_id')
                ->references('id')->on('works')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answers');
    }
}
