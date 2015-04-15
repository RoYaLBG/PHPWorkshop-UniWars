<?php
namespace Uniwars;

class View
{
    private $controllerName;
    private $actionName;

    public function __construct($controllName, $actionName)
    {
        $this->controllerName = $controllName;

        if (!$actionName) {
            $actionName = 'index';
        }

        $this->actionName = $actionName;

    }

    public function render()
    {
        require_once '/Views/' . $this->controllerName
            . '/' . $this->actionName . '.php';
    }

    public function url(
        $controller = null,
        $action = null,
        $params = []
    ) {
        $requestUri = explode('/', $_SERVER['REQUEST_URI']);
        $url = "//" . $_SERVER['HTTP_HOST'] . "/";
        foreach ($requestUri as $k => $uri) {
            if ($uri == $this->controllerName) {
                break;
            }
            $url .= "$uri";
        }

        if ($controller) {
            $url .= "/$controller";
        }

        if ($action) {
            $url .= "/$action";
        }

        foreach ($params as $key => $param) {
            $url .= "/$key/$param";
        }

        return $url;
    }

    public function partial($name)
    {
        include 'Views/Partials/' . $name . ".php";
    }
}