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
	Schema::create('order_items', function(Blueprint $table) {
		$table->id();
		$table->bigInteger('order_id', false, true);
		$table->bigInteger('product_id', false, true);
		$table->bigInteger('variant_id', false, true)->nullable();
		$table->string('name_snapshot', 255);
		$table->string('sku_snapshot', 100)->nullable();
		$table->double('unit_price');
		$table->integer('quantity');
		$table->double('total_price');
		$table->double('tax_amount')->nullable();
		$table->timestamp('created_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('updated_at')->default(new Expression('NULL'))->nullable();

		$table->foreign('order_id', 'fk_orderitem_order')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
	});
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
	Schema::dropIfExists('order_items');
}

};
