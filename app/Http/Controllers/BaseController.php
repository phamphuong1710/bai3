<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Notification;
use App\Notifications\OrderNotification;
use App\Service\UserService;
use Auth;
use View;

class BaseController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->middleware('auth');
        $this->userService = $userService;
        $userId = Auth::id();
        $user = $this->userService->getUserById($userId);
        $listNote = [];
        foreach ($user->unreadNotifications as $notification) {
            array_push($listNote, $notification);
        }

        View::share('notes', $listNote);
    }
}
