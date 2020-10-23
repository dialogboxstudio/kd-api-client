<?php


namespace DialogBoxStudio\KdClient\API;


class Working extends Base
{
    public function __construct(string $result, bool $is_error = false)
    {
        parent::__construct($result, $is_error);
    }

    public function getLink(): string
    {
        return $this->data->result->link;
    }

    public function getPlace(): array
    {
        return json_decode(json_encode($this->data->result->place), true);
    }

}