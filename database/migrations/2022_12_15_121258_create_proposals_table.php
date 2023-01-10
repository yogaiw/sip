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
            $table->foreignId('author_id')->references('id')->on('users')->onDelete('cascade');
            $table->text('title');
            $table->text('abstract_indonesian');
            $table->text('abstract_english');
            $table->dateTime('approvedByDosbing1')->nullable();
            $table->dateTime('approvedByDosbing2')->nullable();
            $table->dateTime('approvedByPenguji')->nullable();
            $table->integer('status')->default(0); // 0:draft. 1:acc oleh dosbing, 2: acc oleh penguji 3: acc oleh ketua jurusan
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
