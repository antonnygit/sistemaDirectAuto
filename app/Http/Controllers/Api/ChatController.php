<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetAllMessagesRequest;
use App\Http\Requests\StoreChatRequest;
use App\Http\Requests\StoreConversationRequest;
use App\Http\Requests\UpdateStatusChatRequest;
use App\Http\Resources\ChatResource;
use App\Models\Chat;
use App\Models\Conversation;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function getAllMessages(GetAllMessagesRequest $request)
    {
        $data = $request->validated();
        $messages = Chat::where('conversation_id', $data['conversation_id'])->oldest()->get();

        return ChatResource::collection($messages);
    }

    public function getConversations(Request $request)
    {
        $user = auth('sanctum')->user()->id;

        $conversations = Conversation::where('from', $user)->orWhere('to', $user)->with('from', 'to')->get();

        // for loop para pegar as conversas do usuário
        foreach ($conversations as $conversation) {
            $lastMessage = Chat::where('conversation_id', $conversation->id)->latest()->first();
            $conversation['last_message'] = $lastMessage ? $lastMessage->message : '';
        }

        return response()->json([
            'data' => $conversations
        ]);
    }

    public function initConversation(StoreConversationRequest $request)
    {
        $data = $request->validated();

        $user = auth('sanctum')->user()->id;

        $conversation = Conversation::where('from', $user)
            ->where('to', $data['to'])
            ->first();

        if (!$conversation) {
            $conversation = Conversation::where('from', $data['to'])
            ->where('to', $user)
            ->first();
        }

        if (!$conversation) {
            $conversation = Conversation::create([
                'from' => $user,
                'to' => $data['to'],
            ]);
        }

        $conversation->with('from', 'to');

        $conversation = Conversation::where('id', $conversation->id)->with('from', 'to')->first();

        return response()->json([
            "conversation" => $conversation
        ]);
    }

    public function sendMessage(StoreChatRequest $request)
    {
        $data = $request->validated();
        $data['from'] = auth('sanctum')->user()->id;

        Chat::create($data);

        return response(null, 201);
    }

    public function updateStatus(UpdateStatusChatRequest $request)
    {
        $data = $request->validated();
        $chat = Chat::where('id', $data['id'])->first();
        $chat->read = true;
        $chat->save();

        return response(null, 200);
    }
}
