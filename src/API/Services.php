<?php


namespace DialogBoxStudio\KdClient\API;


class Services
{
    private  $result;

    public function __construct( $result)
    {
        $this->result = $result;
    }

    public function getResult(): string
    {
        return $this->result;
    }

}