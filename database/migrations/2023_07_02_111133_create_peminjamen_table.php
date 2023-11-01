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
        Schema::create('peminjamen', function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId('peminjam_id')
                ->constrained('peminjams')
                ->onDelete('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('user_id')
                ->constrained('users')
                ->onDelete('cascade')
                ->onDelete('cascade');
            $table
                ->foreignId('detail_barang_id')
                ->constrained('detail_barangs')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('no_peminjaman');
            $table->timestamp('tgl_peminjaman');
            $table->timestamp('tgl_kembali')->nullable();
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
        Schema::dropIfExists('peminjamen');
    }
};
