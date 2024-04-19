<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('networks', function (Blueprint $table) {
            $table->ulid('id')->primary()->unique();
            $table->integer('network_id')->unique();
            $table->string('logo')->nullable();
            $table->string('name')->nullable();
            $table->string('homepage')->nullable();
            $table->string('headquarters')->nullable();
            $table->string('origin_country')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::dropIfExists('networks');
    }
};
