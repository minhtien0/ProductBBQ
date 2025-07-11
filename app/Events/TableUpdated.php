<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Queue\SerializesModels;

class TableUpdated implements ShouldBroadcast
{
    use SerializesModels;

    public $table; // hoặc $tables nếu truyền cả danh sách

    public function __construct($table)
    {
        $this->table = $table; // Có thể là 1 bàn hoặc cả danh sách bàn
    }

    public function broadcastOn()
    {
        return new Channel('tables');
    }

    public function broadcastWith()
    {
        return [
            'table' => $this->table
        ];
    }
}

