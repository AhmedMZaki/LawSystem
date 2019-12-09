<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJudgmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('judgments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judgmentcategory');
            $table->dateTime('judgmentDate');
            $table->string('objectionNo');
            $table->string('year');
            $table->string('judgmentFile');
            $table->integer('notes');
            $table->integer('incompletednotes');
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
        Schema::dropIfExists('judgments');
    }
}
