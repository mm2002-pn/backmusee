<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->string('login')->unique();
            $table->foreignId("role_id")->nullable()->contrained()->onDelete('cascade');
            $table->string('password')->nullable();
            $table->integer("etat")->default('1')->nullable();
            $table->timestamps();
            $table->id();
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('last_login_ip')->nullable(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamp('last_login')->nullable(1);
            $table->string('profil')->nullable();
            $table->string('matricule')->nullable(true);
            $table->string('image')->nullable();
            $table->integer('active')->nullable();

            $table->unsignedBigInteger('profilable_id')->nullable();
            $table->string('profilable_type')->nullable();
            

            $table->rememberToken();
            $table->enum('type', ['client', 'personnel', 'tiers'])->nullable();
            \App\Models\Outil::statusOfObject($table);
            \App\Models\Outil::listenerUsers($table);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
