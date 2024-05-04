<?php

namespace App\Base\Notification;

use App\Base\Services\FirebaseHandler;

class FCMService implements INotificationChannel
{
    /**
     * Send notification
     *
     * @param string $token
     * @param string $title_ar
     * @param string $title_en
     * @param string $content_ar
     * @param string $content_en
     * @return void
     */
    public function send(string $token, string $title_ar, string $title_en, string $content_ar, string $content_en): void
    {
        (new FirebaseHandler())->send(
            token: $token,
            title_ar: $title_ar,
            title_en: $title_en,
            content_ar: $content_ar,
            content_en: $content_en
        );
    }
}
