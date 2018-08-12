<?php
class Router
{
    private $routes;
    public function __construct()
    {
        $routesPath = ROOT . '\congig\routes.php';
        $this->routes = include $routesPath;

    }
    public function getUri(){
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'],'/');
        }
    }
    public function run(){
        $uri= $this->getUri();
        foreach ($this->routes as $uriPattern => $path) {
            if(preg_match("~$uriPattern~", $uri)){
                $internalRoute = preg_replace("~$uriPattern~", $path, $uri);
                $segments = explode('/', $internalRoute);
              //var_dump($segments);
               //s $controllerNa = array_shift($segments) . 'Controller';
                //var_dump($controllerNa);
                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);
                $actionName = 'action' . ucfirst(array_shift($segments));
                $parametrs = $segments;
                //var_dump($parametrs);
                $controllerFile = ROOT . '/controllers/'. $controllerName . '.php';
                if (file_exists($controllerFile)) {
                    include_once($controllerFile);
                }
                $controllerObject = new $controllerName;
                $result = call_user_func_array(array($controllerObject, $actionName), $parametrs);

                if ($result != null) {
                    break;
                }
            }
            
        }

    }

}