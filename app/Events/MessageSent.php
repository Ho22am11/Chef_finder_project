<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\Message;


class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $sender;
    public $receiver;

    public function __construct($message)
    {
        $this->message = $message;
    }
    
    public function broadcastOn()
    {
        // بث الرسالة على قناة المستلم
        return new PrivateChannel('chatt.' . $this->message->receiver_id);
    }
    
    // البيانات التي سيتم بثها
    public function broadcastWith()
    {
        return [
            'message' => $this->message->message, // محتوى الرسالة
            'sender_id' => $this->message->sender_id, // معرف المرسل
            'sender_type' => $this->message->sender_type, // نوع المرسل
        ];
    }
}
