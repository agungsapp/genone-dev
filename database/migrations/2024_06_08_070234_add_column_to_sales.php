<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->string('path_image')->default('default.png');
            $table->string('nomor', 30);
            $table->string('slogan');
            $table->integer('urutan');
            $table->unsignedBigInteger('id_jabatan')->default(1);
            $table->boolean('active')->default(false);
            $table->foreign('id_jabatan')->references('id')->on('jabatan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign(['id_jabatan']); // Hapus foreign key constraint terlebih dahulu
            $table->dropColumn([
                'path_image',
                'nomor',
                'slogan',
                'urutan',
                'id_jabatan',
                'active'
            ]);
        });
    }
};
