<?php
namespace App\Service;

use App\InterfaceService\MessagesInterface;
use App\Message; // model
use Auth;

class MessagesService implements MessagesInterface
{
    public function getAllMessages()
    {
        $messages = Message::with('user')->get();

        return $messages;
    }

    public function createMessages($messages)
    {
        $user = Auth::user();
        $message = $user->messages()->create([
            'message' => $messages
        ]);

        return $message;
    }
}
