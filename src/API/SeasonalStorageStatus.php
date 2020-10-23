<?php


namespace DialogBoxStudio\KdClient\API;


class SeasonalStorageStatus extends Base
{
    public function __construct(string $result, bool $is_error = false)
    {
        parent::__construct($result, $is_error);
    }

    public function getSeasonalStorageStatus(): string
    {
        return $this->data->result->seasonalStorageStatus;
    }

}