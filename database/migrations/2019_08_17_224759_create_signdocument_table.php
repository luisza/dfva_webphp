<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSigndocumentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('signdocuments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();
            $table->text('file_uploaded');
            $table->text('file_name');
            $table->text('file_signed')->nullable(); 
            $table->text('file_signed_hash')->nullable();               
            $table->char('identificacion', 20);   
            $table->char('resumen', 250);   
            $table->char('doc_format', 10); 
            $table->char('razon', 150)->nullable(); 
            $table->char('lugar', 125)->nullable();
            $table->integer('id_transaction')->nullable();  
            $table->boolean('signed')->default(false);  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('signdocument');
    }
}
