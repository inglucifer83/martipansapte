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
	Schema::create('products', function(Blueprint $table) {
		$table->id();
		$table->bigInteger('category_id', false, true);
		$table->string('name', 255);
		$table->string('slug', 255)->nullable();
		$table->bigInteger('short_description_key_id', false, true);
		$table->text('long_description')->nullable();
		$table->string('sku', 100)->nullable();
		$table->double('price');
		$table->double('sale_price')->nullable();
		$table->integer('inventory_quantity');
		$table->string('featured_image', 255)->nullable();
		$table->bigInteger('seo_title_key_id', false, true);
		$table->text('seo_description')->nullable();
		$table->double('weight')->nullable();
		$table->string('dimensions', 100)->nullable();
		$table->string('shipping_class', 50)->nullable();
		$table->tinyInteger('featured_flag')->nullable();
		$table->enum('status', ["draft","active","inactive","archived"])->default('active');
		$table->timestamp('created_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('updated_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('deleted_at')->default(new Expression('NULL'))->nullable();

		$table->foreign('category_id', 'fk_product_category')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
	});
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
	Schema::dropIfExists('products');
}

};
