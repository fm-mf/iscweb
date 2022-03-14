<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_sales', function (Blueprint $table) {
            $table->increments('id_product_sale');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedInteger('id_product');
            $table->unsignedInteger('id_receipt');
            $table->unsignedInteger('id_user')->nullable();

            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();

            $table
                ->foreign('id_product')
                ->references('id_product')
                ->on('products')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table
                ->foreign('id_receipt')
                ->references('id_receipt')
                ->on('receipts')
                ->onUpdate('cascade')
                ->onDelete('restrict');

            $table
                ->foreign('id_user')
                ->references('id_user')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_sales');
    }
}
