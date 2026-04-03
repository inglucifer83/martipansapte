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
	Schema::create('variants', function(Blueprint $table) {
		$table->id();
		$table->bigInteger('product_id', false, true);
		$table->string('sku', 100)->nullable();
		$table->double('price');
		$table->double('compare_at_price')->nullable();
		$table->integer('inventory_quantity')->nullable();
		$table->json('attributes')->nullable();
		$table->double('weight')->nullable();
		$table->bigInteger('image_id', false, true)->nullable();
		$table->timestamp('created_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('updated_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('deleted_at')->default(new Expression('NULL'))->nullable();

		$table->foreign('product_id', 'fk_variant_product')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
	});
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
	Schema::dropIfExists('variants');
}

};
