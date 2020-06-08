<?php
namespace App\Service;

use App\Util\Constant;
use App\Notification;

class NotificationService {
    public static function sendNotification($user, $subject, $message, $type){
        $notification = new Notification();
        $notification->userId = $user;
        $notification->subject = $subject;
        $notification->description = $message;
        $notification->type = $type;
        $notification->status = Constant::NOTIFICATION_STATUS_UNREAD;

        return $notification->save();
    }
}
