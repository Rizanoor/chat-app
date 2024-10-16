<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'text',
        'is_delivered',
        'is_read',
        'reply_to'
    ];

    protected $casts = [
        'is_delivered' => 'boolean',
        'is_read' => 'boolean'
    ];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
    
    public function repliedTo()
    {
        return $this->belongsTo(Message::class, 'reply_to');
    }
}
