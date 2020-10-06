<?php

namespace DialogBoxStudio\KdClient\Entity;

use Psr\Http\Message\ResponseInterface;

class Authorization
{
    private object $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function getResult(): string
    {
        return $this->response->getBody()->getContents();
    }

    public function getHttpStatus(): int
    {
        return $this->response->getStatusCode();
    }

    public function getStatus(): string
    {
        $array = json_decode($this->getResult(), true);
        return $array['result']['status'];
    }

    public function getCode(): int
    {
        $array = json_decode($this->getResult(), true);
        return $array['result']['code'];
    }


}