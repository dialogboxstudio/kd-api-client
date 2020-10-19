<?php


namespace DialogBoxStudio\KdClient\API;


class Error
{
    private string $message;

    public function __construct(string $message = 'Неизвестная ошибка')
    {
        $this->message = $message;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}