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
        Schema::create('withdrawal_receipt_proof_documents', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('receipt_id')->unsigned()->index();
            $table->text('url');
            $table->string('mime');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() : void
    {
        Schema::dropIfExists('withdrawal_receipt_proof_documents');
    }
};
