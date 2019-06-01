<?php

namespace core;

class Controller
{
    public $layout = 'main';

    public function redirect($action)
    {
        $className = (new \ReflectionClass($this))->getShortName();
        $className = lcfirst(str_replace('Controller', '', $className));

        header('Location: /' . $className . '/' . $action);
    }

    public function render($viewName, $params = [])
    {
        extract($params);
        ob_start();
        $className = (new \ReflectionClass($this))->getShortName();
        $className = lcfirst(str_replace('Controller', '', $className));

        $viewPath = APP . 'views' . DIRECTORY_SEPARATOR . $className . DIRECTORY_SEPARATOR . $viewName . '.php';
        require($viewPath);
        $content = ob_get_clean();

        if ($this->layout) {
            $layoutPath = APP . 'views' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . $this->layout . '.php';
            require($layoutPath);
        } else {
            $content;
        }
    }
}
