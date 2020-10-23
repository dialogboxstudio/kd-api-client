<?php


namespace DialogBoxStudio\KdClient\API;


class OrderStatus extends Base
{
    public function __construct(string $result, bool $is_error = false)
    {
        parent::__construct($result, $is_error);
    }


    public function getOrderStatus(): string
    {
        return $this->data->result->orderStatus;
    }
}