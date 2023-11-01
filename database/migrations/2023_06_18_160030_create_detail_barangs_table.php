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
        Schema::create('detail_barangs', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('detail_barang_masuk_id')
                ->constrained('detail_barang_masuks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('barang_id')
                ->constrained('barangs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->enum('kondisi', ['Baik', 'Rusak'])->default('Baik');
            $table->string('status');
            $table->string('kode_barang');
            $table->string('no_registrasi');
            $table->string('no_inventarisasi');
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('detail_barangs');
    }
};
