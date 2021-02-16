<?php

namespace backend\connection;


class RequestHandler
{
    private $error = null;
    private $routes = [];
    private $api_namespace;
    private $api_base_path;
    private $class;
    private $file_path;
    
    public function init()
    {
        $routes = include '../src/routes/routes.php';
        $this->setRoutes($routes);
        $matched_route = null;

        $request_method = strtolower($_SERVER['REQUEST_METHOD']);
       // $url = parse_url($_SERVER['REQUEST_URI'],5);
        if(isset($_GET['url'])) {
            $url = $_GET['url'];
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url2 = explode('/', $url);

            $filtered_routes = array_filter($this->routes, function ($route) use ($request_method){
                return strtolower($route['method']) === $request_method;
            });

            foreach ($filtered_routes as $route) {
                if(preg_match($route['uri_path_pattern'], $url, $matches)) {
                    $matched_route = $route;
                    if(isset($url2[1])) {
                        $param = $url2[1];

                        $param = filter_var($param, FILTER_SANITIZE_NUMBER_INT) || filter_var($param, FILTER_SANITIZE_STRING);
                    }
                    $dir = '../src/api';
                    $path = $dir . $matched_route['handler_path'];
                    include_once $path;
                    $this->class = $matched_route['handler_class'];
                    $this->class = new $this->class($param);
                    break;
                }
            }
            if(empty($matched_route)) {
                echo "Ooops... No page found";
            }
        }
    }

    public function setRoutes ($routes)
    {
        $this->routes = $routes;
    }

    public function setApiNamespace(string $arg_api_namespace)
    {
        $this->api_namespace = $arg_api_namespace;
    }

    public function setApiBasePath(string $arg_api_base_path)
    {
        $this->api_base_path = $arg_api_base_path;
    }
}