<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id')->comment = 'Profile Id';
            $table->integer('user_id')->unsigned()->nullable()->comment = 'User Id';            
            $table->string('job_title')->nullable()->comment = 'Job Title';
            $table->text('overview')->nullable()->comment = 'Overview';
            $table->string('city')->nullable()->comment = 'City';
            $table->string('province')->nullable()->comment = 'Province';
            $table->string('country')->nullable()->comment = 'Country';
            $table->string('photo')->nullable()->comment = 'Profile Image';
            $table->string('cv')->nullable()->comment = 'Curriculum Vitae';
            $table->tinyInteger('status')->nullable()->default(1)->comment = 'Profile Status';
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
        Schema::dropIfExists('profiles');
    }
}
