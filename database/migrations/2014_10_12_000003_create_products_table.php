<?php

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
            $table->string('ten_sp');
            $table->string('slug');
            $table->string('anh_sp')->nullable();
            $table->unsignedBigInteger('gia_sp');
            $table->unsignedBigInteger('giakm_sp')->nullable();
            $table->smallInteger('soluong_sp')->default(1);
            $table->boolean('tinhtrang_sp')->default(true);
            $table->boolean('noibat_sp')->default(false);
            $table->text('phukien_sp')->nullable();
            $table->text('khuyenmai_sp')->nullable();
            $table->text('mota_sp')->nullable();
            $table->softDeletes();
            $table->unsignedBigInteger('cat_id');
            $table->timestamps();
            $table->foreign('cat_id')->references('id')->on('categories');
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
