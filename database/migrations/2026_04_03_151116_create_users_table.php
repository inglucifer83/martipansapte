<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
	Schema::create('users', function(Blueprint $table) {
		$table->id();
		$table->string('name', 255);
		$table->string('email', 255);
		$table->string('password', 255);
		$table->string('remember_token', 100)->nullable();
		$table->string('avatar', 255)->nullable();
		$table->string('display_name', 255)->nullable();
		$table->string('phone', 20)->nullable();
		$table->datetime('email_verified_at')->nullable();
		$table->tinyInteger('marketing_opt_in')->nullable();
		$table->datetime('last_login_at')->nullable();
		$table->string('role', 50)->nullable();
		$table->timestamp('created_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('updated_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('deleted_at')->default(new Expression('NULL'))->nullable();


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

};
