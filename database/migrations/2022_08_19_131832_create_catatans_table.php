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
        Schema::create('catatans', function (Blueprint $table) {
            $table->id();
            $table->string("tgl_keberangkatan");
            $table->time("waktu_keberangkatan");
            $table->string("waktu_perjalanan");
            $table->string("tujuan");
            $table->integer("tlp");
            $table->string("rating");
            $table->string("catatan_user");
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
        Schema::dropIfExists('catatans');
    }
};
