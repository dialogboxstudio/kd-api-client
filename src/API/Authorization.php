<?php


namespace DialogBoxStudio\KdClient\API;


class Authorization
{
    private string $result;

    private bool $is_error;

    private object $data;

    private Error $error;

    public function __construct(string $result, bool $is_error = false)
    {
        $this->result = $result;
        $this->is_error = $is_error;
        if ($is_error === true) {
            $this->error = new Error($result);
        } else {
            $this->data = json_decode($this->result);
        }
    }

    public function getResult(): string
    {
        return $this->result;
    }

    public function getStatus(): string
    {
        return $this->data->result->status;
    }

    public function isError(): bool
    {
        return $this->is_error;
    }

    public function getError(): Error
    {
        return $this->error;
    }

    public function getCode(): string
    {
        return ($this->data->result->code !== null)? $this->data->result->code : '0';
    }

}