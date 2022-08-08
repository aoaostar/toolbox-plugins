<?php

class ApiException extends Exception
{

    private $data = [];

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData($data): void
    {
        $this->data = $data;
    }

    public function __construct($message = "", $data = [], $code = 0, Throwable $previous = null)
    {
        $this->setData($data);
        parent::__construct($message, $code, $previous);
    }

}