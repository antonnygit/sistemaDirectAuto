<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'from',
        'to'
    ];

    public function chats()
    {
        return $this->hasMany(Chat::class, 'conversation_id');
    }

    public function from(){
        return $this->belongsTo(User::class, 'from');
    }

    public function to(){
        return $this->belongsTo(User::class, 'to');
    }
}
