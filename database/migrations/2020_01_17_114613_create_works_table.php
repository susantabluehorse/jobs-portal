<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('works', function (Blueprint $table) {
            $table->increments('id')->comment = 'Work Id';
            $table->integer('user_id')->unsigned()->nullable()->comment = 'User Id';
            $table->string('position',191)->comment = 'Work Position';
            $table->string('company',191)->unique()->comment = 'Work Company';
            $table->string('year',191)->unique()->comment = 'Work Year';
            $table->text('description')->comment = 'Work Description';
            $table->tinyInteger('status')->default(1)->comment = 'Work Status';
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment = 'Created At';
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment = 'Updated At';
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('works');
    }
}
