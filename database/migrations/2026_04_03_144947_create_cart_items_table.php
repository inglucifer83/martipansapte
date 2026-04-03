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
	Schema::create('cart_items', function(Blueprint $table) {
		$table->id();
		$table->bigInteger('cart_id', false, true);
		$table->bigInteger('product_id', false, true);
		$table->bigInteger('variant_id', false, true)->nullable();
		$table->double('price_at_time');
		$table->integer('quantity')->default('1');
		$table->json('metadata')->nullable();
		$table->tinyInteger('saved_for_later')->nullable();
		$table->timestamp('created_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('updated_at')->default(new Expression('NULL'))->nullable();

		$table->foreign('cart_id', 'fk_cartitem_cart')->references('id')->on('carts')->onUpdate('cascade')->onDelete('cascade');
	});
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
	Schema::dropIfExists('cart_items');
}

};
