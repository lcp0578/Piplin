<?php

/*
 * This file is part of Piplin.
 *
 * Copyright (C) 2016-2017 piplin.com
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Piplin\Bus\Notifications\Task;

use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use NotificationChannels\Webhook\WebhookMessage;
use Piplin\Models\Hook;

/**
 * Notification sent when a task succeeds.
 */
class TaskFailedNotification extends TaskFinishedNotification
{
    /**
     * Get the mail representation of the notification.
     *
     * @param Hook $notification
     *
     * @return MailMessage
     */
    public function toMail(Hook $notification)
    {
        return $this->buildMailMessage(
            'hooks.deployment_failed_email_subject',
            'hooks.deployment_failed_email_message',
            $notification
        )->error();
    }

    /**
     * Get the slack version of the notification.
     *
     * @param Hook $notification
     *
     * @return SlackMessage
     */
    public function toSlack(Hook $notification)
    {
        return $this->buildSlackMessage(
            'hooks.deployment_failed_slack_message',
            $notification
        )->error();
    }

    /**
     * Get the webhook version of the notification.
     *
     * @param Hook $notification
     *
     * @return WebhookMessage
     */
    public function toDingtalk(Hook $notification)
    {
        return $this->buildDingtalkMessage('hooks.deployment_failed_ding_message', $notification);
    }

    /**
     * Get the webhook version of the notification.
     *
     * @param Hook $notification
     *
     * @return WebhookMessage
     */
    public function toWebhook(Hook $notification)
    {
        return $this->buildWebhookMessage('deployment_failed', $notification);
    }
}
