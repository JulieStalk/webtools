<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganisationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   //would add more detail in a real system depending on the requirements
        Schema::create('organisations', function (Blueprint $table) {
            $table->id();  
            $table->string('name', 250)->nullable();
			$table->string('website')->nullable();
            $table->string('address', 250)->nullable();
            $table->string('country', 250)->nullable(); //this should come from a table 
            $table->string('phone', 250)->nullable();
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
        Schema::dropIfExists('organisations');
    }
}
