<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('category_id')->unsigned();
            $table->integer('vendor_id')->unsigned();
            $table->boolean('is_available')->default(false);
            $table->string('model')->default('unknown');
            $table->string('description')->default('');
            $table->string('url')->default('');
            $table->string('mobile_url')->default('');
            $table->string('sales_notes')->default('');
            $table->string('rassrochka')->default('');
            $table->integer('price')->unsigned();
            $table->integer('currency')->unsigned()->default(Product::CURRENCY_UNKNOWN);
            $table->boolean('is_exist')->default(false);
            $table->text('params')->nullable();
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
}
