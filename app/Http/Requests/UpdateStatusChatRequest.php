<?php

namespace App\Http\Requests;

use App\Models\Chat;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateStatusChatRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $messageId = $this->route('messageId');
        $chat = Chat::where('id', $messageId)->first();

        if (!$chat) {
            return false;
        }

        return $chat->to === auth('sanctum')->user()->id;
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json(
            [],
            400
        ));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "id" => "required|integer|exists:chats,id"
        ];
    }
}
