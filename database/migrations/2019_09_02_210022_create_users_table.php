<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->bigIncrements('id');
            $table->string("email",50)->unique();
            $table->string("password",64);
            $table->string("token", 120);
            $table->boolean("active")->default(0);
            $table->boolean("is_deleted")->default(0);
            $table->bigInteger('role_id')->unsigned()->default(3);
            $table->foreign('role_id')->references('id')->on("roles");
            $table->timestamps();
            $table->softDeletes();
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
