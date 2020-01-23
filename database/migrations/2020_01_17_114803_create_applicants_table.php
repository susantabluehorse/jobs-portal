<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateApplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('applicants', function (Blueprint $table) {
            $table->increments('id')->comment="Applicant Id";
            $table->string('application_letter')->comment = 'Application Letter';
            $table->integer('user_id')->unsigned()->nullable()->comment = 'User Id';
            $table->integer('job_id')->unsigned()->nullable()->comment = 'Job Id';
            $table->string('status',50)->nullable()->comment = 'Applicant Status';
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment = 'Created At';
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'))->comment = 'Updated At';
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('job_id')->references('id')->on('jobs')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('applicants');
    }
}
