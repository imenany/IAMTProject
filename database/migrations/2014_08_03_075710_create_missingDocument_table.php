<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMissingDocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('missingdoc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('responsable');
            $table->string('title');
            $table->string('phase');
            $table->integer('project_id');
            $table->boolean('valid');
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
        Schema::dropIfExists('missingdoc');
    }
}
