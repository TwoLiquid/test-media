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
        Schema::create('alert_sounds', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('alert_id')->unsigned()->index();
            $table->text('url');
            $table->double('duration')->nullable();
            $table->string('mime');
            $table->boolean('active')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('alert_sounds');
    }
};
