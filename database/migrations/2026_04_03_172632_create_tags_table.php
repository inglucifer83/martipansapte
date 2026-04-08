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
	Schema::create('tags', function(Blueprint $table) {
		$table->id();
		$table->string('name', 255);
		$table->string('slug', 255)->nullable();
		$table->text('description')->nullable();
		$table->string('color', 20)->nullable();
		$table->integer('priority')->nullable();
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
	Schema::dropIfExists('tags');
}

};
