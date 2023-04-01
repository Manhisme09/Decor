<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SanPham extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('san_pham', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('danh_muc_id')->unsigned();
            // $table->foreign('danh_muc_id')->references('id')->on('danh_muc');
            $table->string('ten_san_pham');
            $table->string('slug');
            $table->bigInteger('so_luong')->default(0);
            $table->bigInteger('da_ban')->default(0);
            $table->double('gia_ban')->default(0);
            $table->text('hinh_anh')->nullable();
            $table->text('thuoc_tinh')->nullable();
            $table->text('mo_ta')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('san_pham');
    }
}
