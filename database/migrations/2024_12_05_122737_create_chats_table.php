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
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("conversation_id");
            $table->foreign("conversation_id")->references("id")->on("conversations")->onDelete("cascade");

            $table->unsignedBigInteger("from");
            $table->foreign("from")->references("id")->on("users")->onDelete("cascade");
            $table->unsignedBigInteger("to");
            $table->foreign("to")->references("id")->on("users")->onDelete("cascade");

            $table->text("message");
            $table->boolean("read")->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chats');
    }
};
