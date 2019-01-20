<?php
namespace XRA\LU\Events;
use Illuminate\Queue\SerializesModels;

class TestEvent
{
    use SerializesModels;

    public $msg;

    /**
     * Create a new event instance.
     *
     * @param \App\User $user
     */
    public function __construct($msg)
    {
        $this->msg = $msg;
    }
}