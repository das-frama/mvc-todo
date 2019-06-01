<?php

namespace core;

use core\exception\NotFoundException;

class Application
{
    public function run()
    {
        $request = $this->getRequest($_SERVER['REQUEST_URI']);
        $controller = $this->getController($request->controller);
        $actionName = 'action' . ucfirst($request->action);

        try {
            if (method_exists($controller, $actionName)) {
                call_user_func_array([$controller, $actionName], $request->params);
            } else {
                throw new NotFoundException();
            }
        } catch (NotFoundException $e) {
            $this->render404();
        }
    }

    public function getRequest($url)
    {
        $url = trim($url, '/');
        list($controller, $action) = explode('/', $url);

        $request = new Request();
        $request->controller = $controller;
        if (strpos($action, '?') > 0) {
            $request->action = strstr($action, '?', true);
        } else {
            $request->action = $action;
        }
        $request->params = $_GET;

        return $request;
    }

    public function getController($name)
    {
        $className = sprintf("app\\controllers\\%sController", ucfirst($name));
        return new $className;
    }

    public function render404()
    {
        http_response_code(404);
        require(CORE . DIRECTORY_SEPARATOR . "views" . DIRECTORY_SEPARATOR . "404.php");
    }
}
