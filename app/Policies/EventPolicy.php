<?php
namespace App\Policies;

use App\Models\User;
use App\Models\Event;

class EventPolicy
{
    public function viewAny(User $user)
    {
        return true; // anyone can view events
    }

    public function view(User $user, Event $event)
    {
        return true; // anyone can view an event
    }

    public function create(User $user)
    {
        return $user->is_admin;
    }

    public function update(User $user, Event $event)
    {
        return $user->is_admin;
    }

    public function delete(User $user, Event $event)
    {
        return $user->is_admin;
    }
}

