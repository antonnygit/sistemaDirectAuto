<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string("model", 45)->nullable(false);
            $table->date("release_model");
            $table->date("release_year")->nullable(false);
            $table->string("color", 45)->nullable(false);
            $table->integer("km")->default(0);
            $table->text("description");
            $table->float("price");

            // marca
            $table->unsignedBigInteger("brand_id")->nullable(false);
            $table->foreign("brand_id")->references("id")->on("brands");

            // status
            $table->unsignedBigInteger("status_id")->nullable(false);
            $table->foreign("status_id")->references("id")->on("vehicle_status");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle');
    }
};
