<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLawArticlsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('law_articls', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('laws_id');
            $table->string('subjectid')->nullable();
            $table->string('subjectitle')->nullable();
            $table->string('chaptertitle')->nullable();
            $table->string('chapterid')->nullable();
            $table->string('sectiontitle')->nullable();
            $table->string('sectionid')->nullable();
            $table->string('articletitle')->nullable();
            $table->string('articleno');
            $table->text('articlebody');
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
        Schema::dropIfExists('law_articls');
    }
}
