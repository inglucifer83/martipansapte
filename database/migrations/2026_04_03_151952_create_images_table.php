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
	Schema::create('images', function(Blueprint $table) {
		$table->id();
		$table->string('url', 255);
		$table->string('alt_text', 255)->nullable();
		$table->text('caption')->nullable();
		$table->integer('position')->nullable();
		$table->tinyInteger('is_primary')->nullable();
		$table->bigInteger('product_id', false, true)->nullable();
		$table->timestamp('created_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('updated_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('deleted_at')->default(new Expression('NULL'))->nullable();

		$table->foreign('product_id', 'fk_image_product')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
	});
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
	Schema::dropIfExists('images');
}

};
