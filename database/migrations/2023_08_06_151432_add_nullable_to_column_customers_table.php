<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNullableToColumnCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('khach_hang', function (Blueprint $table) {
            $table->text('dia_chi')->nullable()->change();
            $table->text('dien_thoai')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('khach_hang', function (Blueprint $table) {
            $table->text('dia_chi')->change();
            $table->text('dien_thoai')->change();
        });
    }
}
