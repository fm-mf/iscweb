<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->increments('id_receipt');
            $table->timestamps();
            $table->unsignedInteger('created_by');
            $table->timestamp('refunded_at')->nullable();
            $table->unsignedInteger('refunded_by')->nullable();
            $table->string('subject');
            $table->integer('amount');
            $table->boolean('refunded')->default(0);

            $table
                ->foreign('created_by')
                ->references('id_user')
                ->on('users')
                ->onUpdate('cascade')
                ->onDelete('restrict');
            $table
                ->foreign('refunded_by')
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
        Schema::dropIfExists('receipts');
    }
}
