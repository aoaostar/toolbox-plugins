<?php

namespace plugin\aoaostar_com\image_url;

use Exception;
use Throwable;

class ApiException extends Exception
{

    private $data = [];

    public function getData()
    {
        return $this->data;
    }

    /**
     * @param mixed $data
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