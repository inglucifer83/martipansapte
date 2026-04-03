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
	Schema::create('orders', function(Blueprint $table) {
		$table->id();
		$table->bigInteger('user_id', false, true)->nullable();
		$table->string('order_number', 255);
		$table->enum('status', ["pending","processing","completed","cancelled","failed"])->default('pending');
		$table->double('subtotal')->nullable();
		$table->double('shipping_cost')->nullable();
		$table->double('tax_total')->nullable();
		$table->double('total')->nullable();
		$table->string('currency', 3)->nullable();
		$table->bigInteger('billing_address_id', false, true)->nullable();
		$table->bigInteger('shipping_address_id', false, true)->nullable();
		$table->datetime('placed_at')->nullable();
		$table->datetime('fulfilled_at')->nullable();
		$table->string('tracking_number', 100)->nullable();
		$table->timestamp('created_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('updated_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('deleted_at')->default(new Expression('NULL'))->nullable();

		$table->foreign('user_id', 'fk_order_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
	});
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
	Schema::dropIfExists('orders');
}

};
