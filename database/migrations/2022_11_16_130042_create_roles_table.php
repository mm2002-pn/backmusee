<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string("designation")->nullable();
            $table->text("description")->nullable();
            $table->integer('iscommercial')->nullable(true);
            $table->integer('isplanning')->nullable(true);
            $table->integer('ischauffeur')->nullable(true);
            // name
            $table->string("name")->nullable();
            // isadmin
            $table->integer('isadmin')->nullable(true);
            // estautoriser
            $table->integer('estautoriser')->nullable(true);
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
        Schema::dropIfExists('roles');
    }
}
