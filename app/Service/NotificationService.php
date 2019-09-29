<?php

namespace App\Service;

use App\InterfaceService\NotificationInterface;
use Notification;
use App\Notifications\OrderNotification;

class NotificationService implements NotificationInterface
{
    public function getNotifyById($id)
    {
        $notify = Notification::findOrFaild($id);

        return $notify;
    }
}
