<?php

namespace App\Notifications;

use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ReservationSaved extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(private Carbon $datetime, private Service $service)
    {
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
            ->subject("Potwierdzenie rezerwacji")
            ->greeting("Potwierdzenie rezerwacji")
            ->line(new HtmlString("Potwierdzamy przyjęcię twojej rezerwacji na usługę:<br><b>" . $this->service->name . "</b>"))
            ->line(new HtmlString("Dnia: <b>" . $this->datetime->format('d.m.Y') . "</b>"))
            ->line(new HtmlString("O godzinie: <b>" . $this->datetime->format('G:i') . "</b>"))
            ->line("Dziękujemy za korzystanie z naszych usług!")
            ->salutation(new HtmlString("Pozdrawiamy,<br>" . config('app.name', 'Laravel') . "."));
    }
}
