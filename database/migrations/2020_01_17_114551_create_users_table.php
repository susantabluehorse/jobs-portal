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
            $table->increments('id')->comment = 'User Id';
            $table->string('name',100)->comment = 'User Name';
            $table->string('email',191)->unique()->comment = 'User E-mail';
            $table->string('phone',100)->unique()->comment = 'User Phone Number';
            $table->string('password')->comment = 'User Password';
            $table->integer('role')->comment = 'User Role';            
            $table->rememberToken()->comment = 'User Token';
            $table->tinyInteger('status')->default(1)->comment = 'User Status';
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment = 'Created At';
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment = 'Updated At';
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
