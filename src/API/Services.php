<?php


namespace DialogBoxStudio\KdClient\API;


class Services extends Base
{
    public function __construct(string $result, bool $is_error = false)
    {
        parent::__construct($result, $is_error);
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