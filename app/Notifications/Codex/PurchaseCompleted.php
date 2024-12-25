<?php

namespace App\Notifications\Codex;

use App\Models\Repository;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PurchaseCompleted extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        public Repository $repository,
    ) {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        /** @var \App\Models\Team $team */
        $team = $this->repository->project->team;
        return (new MailMessage)
            ->line('We have received your payment and are now processing your order.')
            ->line('You should now be able to add branches to your repository. We may have added a few standard branches for you if they existed inside the repository.')
            ->action('See repository', $team->currentPlatform()->route('projects.show', ['project' => $this->repository->project]))
            ->line('If you have any issue with the documentation or the purchase, feel free to contact us at '.config('codex.support_email'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
