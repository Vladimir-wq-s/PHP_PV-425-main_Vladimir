<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

// Интерфейс ShouldQueue используется для асинхронной обработки отправки почты через очереди
class OrderShippedMail extends Mailable implements ShouldQueue
{
    use Queueable, InteractsWithQueue, SerializesModels;

    public function __construct()
    {
        // Конструктор для инициализации входящих данных
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Ваш заказ успешно отправлен!',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.order-shipped', // Указание пути к HTML-шаблону письма
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
