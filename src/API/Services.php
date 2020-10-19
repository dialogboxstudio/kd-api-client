<?php


namespace DialogBoxStudio\KdClient\API;


class Services
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
    public function getName(): array
    {
        $name = [];
        foreach ($this->data->result->services as $item => $value) {
            $name[] = trim($value->name);
        }
        return $name;
    }

    public function getDescription(): array
    {
        $description = [];
        foreach ($this->data->result->services as $item => $value) {
            $value->description = str_replace(array("\r\n","\r","\n","\\r","\\n","\\r\\n"),"\\n",trim($value->description));
            $value->description = str_replace(array("\\n\\n\\n", "\n\n", "\\n\\n", "\n\n\n", "\\n"), "\n", $value->description);
            $description[] = trim(preg_replace('/\t+/', '', $value->description));

        }
        return $description;
    }

    public function getList(): array
    {
        $name = $this->getName();
        $description = $this->getDescription();
        $list = [];
        foreach ($name as $item => $value) {
            $list[] = ['name' => $value, 'description' => $description[$item]];
        }
        return $list;
    }

    public function getLink(): string
    {
        return $this->data->result->link;
    }

}