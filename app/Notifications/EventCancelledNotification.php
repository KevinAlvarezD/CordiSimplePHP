<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class EventCancelledNotification extends Notification
{
    use Queueable;

    protected $event;

    /**
     * Crear una nueva instancia de la notificación.
     *
     * @param  \App\Models\Event  $event
     * @return void
     */
    public function __construct($event)
    {
        $this->event = $event;
    }

    /**
     * Obtener la representación del correo electrónico de la notificación.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // Suponiendo que el evento es un objeto con una propiedad "name"
        return (new MailMessage)
            ->subject('Lamentablemente, el evento ha sido cancelado')
            ->greeting('Estimado/a,')
            ->line('Nos entristece informarte que el evento "' . $this->event->name . '" ha sido cancelado.')
            ->line('Entendemos la importancia de este evento para ti y te pedimos disculpas por cualquier inconveniente que esto pueda causar.')
            ->salutation('Gracias por tu comprensión.');
    }

    /**
     * Obtener los canales en los que se debe enviar la notificación.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail']; // Solo enviamos por correo
    }
}