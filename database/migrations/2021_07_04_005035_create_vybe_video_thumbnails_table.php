<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Running MySQL migration
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() : void
    {
        Schema::create('vybe_video_thumbnails', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('video_id')->unsigned()->index();
            $table->text('url');
            $table->string('mime');

            $table->foreign('video_id')
                ->references('id')
                ->on('vybe_videos')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('vybe_video_thumbnails');
    }
};