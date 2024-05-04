<?php

namespace App\Base\Notification;

class NotificationService
{
    /**
     * @var array
     */
    protected $notificationChannels = [];

    /**
     * Add notification channel
     *
     * @param string $name
     * @param INotificationChannel $channel
     * @return void
     */
    public function addChannel(string $name, INotificationChannel $channel): void
    {
        $this->notificationChannels[$name] = $channel;
    }

    /**
     * Send notification
     *
     * @param string $channelName
     * @param string $token
     * @param mixed $user
     * @param string $title_ar
     * @param string $title_en
     * @param string $content_ar
     * @param string $content_en
     * @return void
     */
    public function send(string $channelName, string $token, $user, string $title_ar, string $title_en, string $content_ar, string $content_en): void
    {
        $this->validateChannel($channelName);

        $this->sendNotification($channelName, $token, $title_ar, $title_en, $content_ar, $content_en);
        $this->saveNotificationToDatabase($channelName, $user, $title_ar, $title_en, $content_ar, $content_en);
    }

    /**
     * Validate channel
     *
     * @param string $channelName
     * @return void
     */
    protected function validateChannel(string $channelName): void
    {
        if (!isset($this->notificationChannels[$channelName])) {
            throw new \InvalidArgumentException("Invalid notification channel: $channelName");
        }
    }

    /**
     * Send notification
     *
     * @param string $channelName
     * @param string $token
     * @param string $title_ar
     * @param string $title_en
     * @param string $content_ar
     * @param string $content_en
     * @return void
     */
    protected function sendNotification(string $channelName, string $token, string $title_ar, string $title_en, string $content_ar, string $content_en): void
    {
        $this->notificationChannels[$channelName]->send($token, $title_ar, $title_en, $content_ar, $content_en);
    }

    /**
     * Save notification to database
     *
     * @param string $channelName
     * @param mixed $user
     * @param string $title_ar
     * @param string $title_en
     * @param string $content_ar
     * @param string $content_en
     * @return void
     */
    protected function saveNotificationToDatabase(string $channelName, $user, string $title_ar, string $title_en, string $content_ar, string $content_en): void
    {
        $user->notifications()->create([
            'chanel_name' => $channelName,
            'title_ar' => $title_ar,
            'title_en' => $title_en,
            'content_ar' => $content_ar,
            'content_en' => $content_en,
        ]);
    }
}
