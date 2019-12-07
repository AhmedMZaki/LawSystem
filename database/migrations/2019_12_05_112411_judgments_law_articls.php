<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class JudgmentsLawArticls extends Migration
{

    public function up()
    {
        Schema::create('judgments_lawarticles', function (Blueprint $table)
        {
            $table->bigIncrements('id');
            $table->unsignedInteger('judgments_id');
            $table->unsignedInteger('law_articls_id');
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
        Schema::dropIfExists('judgments_lawarticles');
    }
}
