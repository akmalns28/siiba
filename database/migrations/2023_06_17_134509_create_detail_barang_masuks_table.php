<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_barang_masuks', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('barang_id')
                ->constrained('barangs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('barang_masuk_id')
                ->constrained('barang_masuks')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('pemilik_id')
                ->constrained('departemens')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('nama_barang');
            $table->string('jumlah');
            $table->string('harga');
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
        Schema::dropIfExists('detail_barang_masuks');
    }
};
