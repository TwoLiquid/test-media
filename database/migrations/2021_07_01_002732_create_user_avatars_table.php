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
        Schema::create('user_avatars', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('auth_id')->unsigned()->index();
            $table->string('request_id')->index()->nullable();
            $table->text('url');
            $table->string('mime');
            $table->boolean('declined')->default(false)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('user_avatars');
    }
};
