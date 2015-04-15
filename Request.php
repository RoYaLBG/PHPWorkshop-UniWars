<?php
namespace Uniwars;

class Request
{
    private $params;

    public function __construct(array $params = [])
    {
        $this->params = $params;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function __get($name)
    {
        return $this->params[$name];
    }
}