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
        Schema::create('vybe_videos', function (Blueprint $table) {
            $table->id();
            $table->text('url');
            $table->double('duration')->nullable();
            $table->string('mime');
            $table->boolean('main')->default(false);
            $table->boolean('declined')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('vybe_videos');
    }
};
