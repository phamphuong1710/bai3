<?php

namespace App\Http\Controllers;

use App\Service\MessagesService;
use Illuminate\Http\Request;
use App\Events\MessageSent;

class ChatController extends Controller
{
    protected $messagesService;

    public function __construct(MessagesService $messagesService)
    {
        $this->middleware('auth');
        $this->messagesService = $messagesService;
    }

    public function index()
    {
        return view('layouts.chat');
    }

    /**
     * Fetch all messages
     *
     * @return Message
     */
    public function fetchMessages()
    {
        $messages = $this->messagesService->getAllMessages();

        return $messages;
    }


    public function sendMessage(Request $request)
    {
        $messages = $request->input('message');
        $this->messagesService->createMessages($messages);
        broadcast(new MessageSent($user, $message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
