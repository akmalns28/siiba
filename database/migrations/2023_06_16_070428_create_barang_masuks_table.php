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
        Schema::create('barang_masuks', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('dana_id')
                ->constrained('danas')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table
                ->foreignId('supplier_id')
                ->constrained('suppliers')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('kode_barang_masuk');
            $table->string('tgl_masuk_barang');
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
        Schema::dropIfExists('barang_masuks');
    }
};
