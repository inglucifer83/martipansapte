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
	Schema::create('carts', function(Blueprint $table) {
		$table->id();
		$table->bigInteger('user_id', false, true)->nullable();
		$table->string('token', 255)->nullable();
		$table->string('currency', 3)->default('USD')->nullable();
		$table->double('total_amount')->nullable();
		$table->datetime('expires_at')->nullable();
		$table->tinyInteger('is_active')->default('1');
		$table->timestamp('created_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('updated_at')->default(new Expression('NULL'))->nullable();

		$table->foreign('user_id', 'fk_cart_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
	});
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
	Schema::dropIfExists('carts');
}

};
