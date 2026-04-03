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
	Schema::create('addresses', function(Blueprint $table) {
		$table->id();
		$table->bigInteger('user_id', false, true)->nullable();
		$table->string('label', 50)->nullable();
		$table->string('full_name', 255);
		$table->string('company', 255)->nullable();
		$table->string('street', 255);
		$table->string('city', 100);
		$table->string('region', 100);
		$table->string('postal_code', 20);
		$table->string('country', 100);
		$table->string('phone', 20)->nullable();
		$table->tinyInteger('is_default_shipping')->nullable();
		$table->tinyInteger('is_default_billing')->nullable();
		$table->timestamp('created_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('updated_at')->default(new Expression('NULL'))->nullable();
		$table->timestamp('deleted_at')->default(new Expression('NULL'))->nullable();

		$table->foreign('user_id', 'fk_address_user')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
	});
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
{
	Schema::dropIfExists('addresses');
}

};
