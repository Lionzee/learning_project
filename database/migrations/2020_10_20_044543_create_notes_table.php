<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('topic_id');
            $table->string('title');
            $table->string('description');
            $table->string('url');
            $table->unsignedBigInteger('origin_id')->nullable();
            $table->boolean('is_public')->default(1);
            $table->timestamps();

            //Relation
            $table->foreign('topic_id')
                ->references('id')->on('topics')
                ->onDelete('cascade');
        });

        DB::statement('ALTER TABLE notes ADD FULLTEXT fulltext_index (title, description)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
}
