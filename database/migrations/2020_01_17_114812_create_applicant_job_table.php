<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantJobTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicant_job', function (Blueprint $table) {
            $table->increments('id')->comment = 'Applicant Job Id';
            $table->integer('applicant_user_id')->unsigned()->nullable()->comment = 'User Id';
            $table->integer('job_id')->unsigned()->nullable()->comment = 'Job Id';
            $table->tinyInteger('status')->default(1)->comment = 'Applicant Job Status';
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment = 'Created At';
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment = 'Updated At';
            $table->foreign('applicant_user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('restrict')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicant_job');
    }
}
