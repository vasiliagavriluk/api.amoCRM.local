<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('leads_id')->unique()->unsigned()->nullable();
            $table->string('name');
            $table->integer('price')->default(0);
            $table->integer('group_Id');
            $table->integer('pipeline_Id');


            $table->integer('account_Id');
            $table->integer('status_Id');
            $table->integer('company_id');
            $table->integer('responsibleUser_Id');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('status_Id')->references('statuses_id')->on('statuses');
            $table->foreign('company_id')->references('companies_id')->on('companies');
            $table->foreign('account_Id')->references('account_id')->on('accounts');
            $table->foreign('responsibleUser_Id')->references('users_id')->on('users');


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('leads');
    }
};
