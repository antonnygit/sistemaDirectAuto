<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    protected $fillable = [
        'from',
        'to',
        'message',
        'read',
        'conversation_id'
    ];

    public function conversation(){
        return $this->belongsTo(Conversation::class, 'conversation_id');
    }

    public function from(){
        return $this->belongsTo(User::class);
    }

    public function to(){
        return $this->belongsTo(User::class);
    }

}
