<?php

namespace App\Events;

use App\Comment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewComment implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $comment;
    public function __construct(Comment $comment)
    {
        $this->comment=$comment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        //return new Channel('post.'.$this->comment->post->id);
        return new PrivateChannel('post.'.$this->comment->post->id);

    }
    public function broadcastWith(){
        return [
            'comment_body'=>$this->comment->comment_body,
            'user'=>[
                'name'=>$this->comment->user->name,
            ]
        ];
    }
}
