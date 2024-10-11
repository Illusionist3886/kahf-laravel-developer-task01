<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NotifyVaccineTaker extends Notification implements ShouldQueue
{
    use Queueable;

    protected $schedule;
    protected $email;

    /**
     * Create a new notification instance.
     */
    public function __construct($schedule, $email)
    {
        $this->schedule = $schedule;
        $this->email = $email;
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
        return (new MailMessage)
                    ->line("You are scheduled to take your dose of COVID Vaccine tomorrow (".$this->schedule->schedule_date.").")
                    ->line("Vaccine Center: ".$this->schedule->vaccineCenter->name)
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
