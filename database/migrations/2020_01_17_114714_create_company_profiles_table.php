<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_profiles', function (Blueprint $table) {
            $table->increments('id')->comment = 'Profile Id';
            $table->integer('user_id')->unsigned()->nullable()->comment = 'User Id';            
            $table->string('name',50)->nullable()->comment = 'Company Name';
            $table->text('description')->nullable()->comment = 'Company Description';
            $table->string('location',100)->nullable()->comment = 'Company Location';
            $table->string('contact_person',100)->nullable()->comment = 'Company Contact Person Name';
            $table->string('contact_email',191)->nullable()->comment = 'Company Contact Person E-mail';
            $table->string('contact_phone',50)->nullable()->comment = 'Company Contact Person Phone Number';
            $table->string('hr_name',50)->nullable()->comment = 'HR Name';
            $table->string('hr_email',191)->nullable()->comment = 'HR E-mail';
            $table->string('hr_phone',50)->nullable()->comment = 'HR Phone Number';
            $table->string('photo')->nullable()->comment = 'Company Profile Image';
            $table->tinyInteger('status')->nullable()->default(1)->comment = 'Company Profile Status';
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
        Schema::dropIfExists('company_profiles');
    }
}
