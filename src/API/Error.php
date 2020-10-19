<?php


namespace DialogBoxStudio\KdClient\API;


class Error
{
    private string $message;

    public function __construct(string $message = 'message')
    {
        $this->message = $message;
    }
}