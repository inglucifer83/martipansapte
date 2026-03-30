<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        
        Schema::create('langs', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->text('name');       
            $table->string('code', 6); 
            $table->tinyInteger('default', 1)->default(0); 
            $table->timestamp('created_at')->default(new Expression('NULL'))->nullable();
		    $table->timestamp('updated_at')->default(new Expression('NULL'))->nullable();

            $table->unique(['code']);
        });

        Schema::create('lang_keys', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->text('name');       
            $table->text('topic')->nullable(); 
            $table->timestamp('created_at')->default(new Expression('NULL'))->nullable();
		    $table->timestamp('updated_at')->default(new Expression('NULL'))->nullable();
        });

        Schema::create('lang_values', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->bigInteger('lang_id',false, true); 
            $table->bigInteger('lang_key_id', false, true);
            $table->text('value');       
            $table->timestamp('created_at')->default(new Expression('NULL'))->nullable();
		    $table->timestamp('updated_at')->default(new Expression('NULL'))->nullable();

            $table->foreign('lang_key_id', 'fk_lang_value_lang_key')->references('id')->on('lang_keys')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('lang_id', 'fk_lang_value_lang')->references('id')->on('langs')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::drop('langs');
        Schema::drop('lang_keys');
        Schema::drop('lang_values');
    }
};
