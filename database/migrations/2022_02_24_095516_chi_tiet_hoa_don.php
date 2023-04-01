<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChiTietHoaDon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_tiet_hoa_don', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('hoa_don_id')->unsigned();
            // $table->foreign('hoa_don_id')
            //       ->references('id')
            //       ->on('hoa_don');
            $table->integer('san_pham_id')->unsigned();
            // $table->foreign('san_pham_id')
            //       ->references('id')
            //       ->on('san_pham');
            $table->bigInteger('so_luong')->default(0);
            $table->double('don_gia');
            $table->double('giam_gia')->default(0);
            $table->double('thanh_tien')->default(0);
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
        Schema::dropIfExists('chi_tiet_hoa_don');
    }
}
