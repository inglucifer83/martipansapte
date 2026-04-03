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
	Schema::create('payments', function(Blueprint $table) {
		$table->id();
		$table->bigInteger('order_id', false, true)->nullable();
		$table->double('amount');
		$table->string('currency', 3)->nullable();
		$table->enum('method', ["card","paypal","bank_transfer","cod"])->default('card')->nullable();
		$table->enum('status', ["pending","completed","failed","refunded"])->default('pending')->nullable();
		$table->string('transaction_id', 255)->nullable();
		$table->json('gateway_response')->nullable();
		$table->datetime('captured_at')->nullable();
		$table->datetime('refunded_at')->nullable();
		$table->timestamp('created_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('updated_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('deleted_at')->default(new Expression('NULL'))->nullable();

		$table->foreign('order_id', 'fk_payment_order')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
	});
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
	Schema::dropIfExists('payments');
}

};
