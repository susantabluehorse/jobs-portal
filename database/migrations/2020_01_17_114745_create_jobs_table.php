<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id')->comment = 'Job Id';           
            $table->integer('user_id')->unsigned()->nullable()->comment = 'User Id';
            $table->integer('category_id')->unsigned()->nullable()->comment = 'Category Id';
            $table->string('title')->comment = 'Job Title';
            $table->text('body')->comment = 'Job Body';
            $table->string('budget',100)->comment = 'Job Budget';
            $table->string('position_type',191)->comment = 'Job Position Type';
            $table->string('qualification',191)->comment = 'Qualification for Job';            
            $table->string('sector',50)->comment = 'Sector for Job';            
            $table->string('age',30)->comment = 'Age';            
            $table->tinyInteger('status')->default(1)->comment = 'Job Status';
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment = 'Created At';
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment = 'Updated At';
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('job_categories')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
