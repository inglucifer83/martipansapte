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
	Schema::create('reviews', function(Blueprint $table) {
		$table->id();
		$table->bigInteger('user_id', false, true)->nullable();
		$table->bigInteger('product_id', false, true);
		$table->integer('rating');
		$table->string('title', 255)->nullable();
		$table->text('body')->nullable();
		$table->tinyInteger('approved')->nullable();
		$table->integer('helpful_count')->nullable();
		$table->timestamp('created_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('updated_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('deleted_at')->default(new Expression('NULL'))->nullable();

		$table->foreign('user_id', 'fk_review_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
		$table->foreign('product_id', 'fk_review_product')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
	});
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
	Schema::dropIfExists('reviews');
}

};
