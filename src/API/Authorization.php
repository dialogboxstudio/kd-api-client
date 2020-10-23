<?php


namespace DialogBoxStudio\KdClient\API;


class Authorization extends Base
{
    public function __construct(string $result, bool $is_error = false)
    {
        parent::__construct($result, $is_error);
    }

    public function getCode(): string
    {
        return ($this->data->result->code !== null)? $this->data->result->code : '0';
    }
}