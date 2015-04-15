<?php
namespace Uniwars\Controllers;

class Controller
{
    /**
     * @var \Uniwars\View;
     */
    protected $view;

    /**
     * @var \Uniwars\Request;
     */
    protected $request;

    protected $controllerName;

    public function __construct(
        \Uniwars\View $view,
        \Uniwars\Request $request,
        $name
    )
    {
        $this->view = $view;
        $this->request = $request;
        $this->controllerName = $name;
        $this->onLoad();
    }

    protected function onLoad() { }

    public function redirect(
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

        header("Location: " . $url);
        exit;
    }
}