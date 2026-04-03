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
	Schema::create('categories', function(Blueprint $table) {
		$table->id();
		$table->string('name', 255);
		$table->string('slug', 255)->nullable();
		$table->text('description')->nullable();
		$table->string('image', 255)->nullable();
		$table->bigInteger('parent_id', false, true)->nullable();
		$table->integer('sort_order')->nullable();
		$table->string('seo_title', 255)->nullable();
		$table->text('seo_description')->nullable();
		$table->tinyInteger('is_active')->default('1');
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
	Schema::dropIfExists('categories');
}

};
