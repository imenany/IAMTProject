<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFindingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('findings', function(Blueprint $table){
            $table->increments('id');
            $table->text('finding');
            $table->string('cycle');
            $table->integer('document_id');
            $table->integer('project_id');
            $table->longText('description');
            $table->longText('recommendation');
            $table->longText('response');
            $table->integer('responsable');
            $table->integer('user_id');
            $table->char('status',1);
            $table->enum('severity', ['MIN', 'NA', 'MAX', 'CRIT']);
            $table->integer('valid');
            $table->integer('accessibility');
            //$table->integer('stdReq');

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
        Schema::dropIfExists('findings');
    }
}


