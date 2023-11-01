<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBarangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('barangs', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('kategori_id')
                ->constrained('kategoris')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('sub_kategori_id')
                ->constrained('sub_kategoris')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('satuan_id')
                ->constrained('satuans')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('user_id')
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('foto');
            $table->enum('aset', ['Barang Tetap', 'Barang Habis Pakai']);
            $table->string('stok');
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
        Schema::dropIfExists('barangs');
    }
}
