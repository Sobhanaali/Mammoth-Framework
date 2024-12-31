<?php

namespace app\core;


class Router
{
    protected array $routers = [];
    public Request $request;


    public function __construct(Request $request)
    {
        $this->request = $request;
        
    }

    public function get($path , $callback)
    {

        $this->routers['get'][$path] = $callback;

    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();

        $callback = $this->routers[$method][$path] ?? false;
        
        if(!$callback){
            echo 'Not Found';
            exit;
        }

        echo call_user_func($callback);
    }
}