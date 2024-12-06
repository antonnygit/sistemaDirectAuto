<?php

use App\Http\Controllers\Api\ChatController;
use App\Http\Middleware\AuthApi;
use Illuminate\Support\Facades\Route;

Route::middleware(AuthApi::class)->group(function () {
    Route::get("/api/v1/getConversations", [ChatController::class, "getConversations"])->name("chat.conversations");
    Route::post("/api/v1/chat/init", [ChatController::class, "initConversation"])->name("chat.init");
    Route::post("/api/v1/chat/send", [ChatController::class, "sendMessage"])->name("chat.send");
});

Route::post("/api/v1/chat", [ChatController::class, "getAllMessages"])->name("chat.index");