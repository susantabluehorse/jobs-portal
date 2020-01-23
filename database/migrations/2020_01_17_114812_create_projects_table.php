<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->increments('id')->comment = 'Project Id';
            $table->integer('user_id')->unsigned()->nullable()->comment = 'User Id';
            $table->string('name')->comment = 'Project Name';
            $table->string('duration')->comment = 'Project Duration';
            $table->string('role')->comment = 'Project Role';
            $table->string('company_name')->comment = 'Company Name';
            $table->text('description')->comment = 'Project Description';
            $table->tinyInteger('status')->default(1)->comment = 'Project Status';
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
        Schema::dropIfExists('projects');
    }
}
