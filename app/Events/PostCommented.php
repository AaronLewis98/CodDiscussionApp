<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PostCommented implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;
    public $email;
    public $commentEmail;

    public function __construct($email, $commentEmail)
    {
        $this->email = $email;
        $this->commentEmail = $commentEmail;
        $this->message  = "{$commentEmail} commented on your post.";
    }
  
    public function broadcastOn()
    {
        return ['post-commented-channel'];
    }
  
    public function broadcastAs()
    {
        return 'comment-event';
    }
}
