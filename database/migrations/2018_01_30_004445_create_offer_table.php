<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOfferTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('offer', function (Blueprint $table) {
      $table->increments('id');
      $table->string('title');
      $table->longText('description');
      $table->string('begin_date');
      $table->string('end_date');
      $table->string('regulation');
      $table->integer('likes_count');
      $table->string('purchase_url');
      $table->string('public_description');
      $table->integer('source_file_id')->unsigned();
      $table->foreign('source_file_id')
        ->references('id')
        ->on('source_file')
        ->onDelete('cascade');
      $table->timestamps();
      $table->softDeletes();
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::dropIfExists('offer');
  }
}
