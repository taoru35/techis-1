<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('item_id')->unsigned()->index();
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');

            $table->integer('quantity')->default(1);

            $table->timestamps();

            // ユーザーIDとアイテムIDの組み合わせをユニークにする
            $table->unique(['user_id', 'item_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
