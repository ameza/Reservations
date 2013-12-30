<?php

use Illuminate\Database\Migrations\Migration;

class CreateCompanyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        if(!Schema::hasTable('company')){
            Schema::create('company', function($table)
            {
                $table->increments('id');
                $table->integer('cluster_id')->unsigned();
                $table->string('name');
                $table->string('domains');
                $table->string('logo_url');
                $table->timestamps();

                //foreign key
                $table->foreign('cluster_id')
                    ->references('id')->on('cluster')
                    ->onDelete('cascade')
                    ->onUpdate('cascade');
            });
        }else{
            if(!Schema::hasColumn('company', 'name')){
                Schema::table('company', function($table)
                {
                    $table->string('name');
                });
            }
            if(!Schema::hasColumn('company', 'domains')){
                Schema::table('company', function($table)
                {
                    $table->string('domains');
                });
            }
            if(!Schema::hasColumn('company', 'logo_url')){
                Schema::table('company', function($table)
                {
                    $table->string('logo_url');
                });
            }
        }
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        if(Schema::hasTable('company')){
            Schema::drop('company');
        }
	}

}