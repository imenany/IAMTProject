<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocumentsAITable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentsAI', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('title');
            $table->integer('baseline_id');
            $table->string('phase');
            $table->float('version',3,1);
            $table->string('url');
            $table->boolean('valid')->default(false);
            $table->boolean('accessibility')->default(false);
            $table->integer('leadassessor')->default(0);
            $table->integer('assessor')->default(0);
            $table->integer('qa')->default(0);
            $table->integer('approver')->default(0);
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
        Schema::dropIfExists('documentsAI');
    }
}
