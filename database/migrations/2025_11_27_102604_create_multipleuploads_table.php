<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('multipleuploads', function (Blueprint $table) {
            $table->id();

            // >>>> TAMBAHAN: relasi ke pelanggan
            $table->unsignedInteger('pelanggan_id')->nullable();
            $table->foreign('pelanggan_id')
                  ->references('pelanggan_id')->on('pelanggan')
                  ->onDelete('cascade');

            // >>>> TAMBAHAN: info file
            $table->string('filename');
            $table->string('filepath'); // path relative, e.g. 'storage/pelanggan/xxx'
            $table->integer('filesize')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('multipleuploads');
    }
};
