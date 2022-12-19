<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProposalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author')->references('id')->on('users')->onDelete('cascade');
            $table->text('title');
            $table->text('abstract_indonesian');
            $table->text('abstract_english');
            $table->foreignId('pembimbing1')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('pembimbing2')->nullable()->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('penguji')->references('id')->on('users')->onDelete('cascade');
            $table->integer('status')->default(0); // 0:draft. 2:accepted
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
        Schema::dropIfExists('proposals');
    }
}
