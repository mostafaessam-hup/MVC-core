<?php

namespace App\Base\Notification;

class WhatsAppService implements INotificationChannel
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
        // Implementation for Firebase Cloud Messaging
    }
}
