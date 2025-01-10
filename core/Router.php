<?php

namespace app\core;


class Router
{
    protected array $routers = [];
    public Request $request;
    public Response $response;


    public function __construct(Request $request , Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        
    }

    public function get($path , $callback)
    {

        $this->routers['get'][$path] = $callback;

    }

    public function post($path , $callback)
    {
        $this->routers['post'][$path] = $callback;

    }

    public function resolve()
    {
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        
        $callback = $this->routers[$method][$path] ?? false;
        
        if(!$callback){
            $this->response->setStatusCode(404);
            return $this->renderView('_404');
        }

        if(is_string($callback)){
            return $this->renderView($callback);
        }

        if(is_array($callback)){
            if(class_exists($callback[0])){
                $instance = new $callback[0];
    
                $callback[0] = $instance;
            }
        }

        return call_user_func($callback , $this->request);
    }

    public function renderView($view , $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view , $params);

        $sections = $this->renderSections($viewContent);
        
        foreach($sections as $key => $content){
            $layoutContent = preg_replace('/{{\s*' . preg_quote($key, '/') . '\s*}}/', $content, $layoutContent);
        }
        return $layoutContent;
    }

    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view , $params)
    {
        
        foreach($params as $key => $value){
            $$key = $value;
        }

        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }

    protected function renderSections($view){
        $sections = [];

        preg_match_all("/@section\('(\w+)'\s*,\s*'([^']+)'\)/", $view, $matches1, PREG_SET_ORDER);
        preg_match_all("/@section\s*\(\s*'([^']+)'\s*\)\s*(.*?)\s*@endSection/s", $view, $matches2, PREG_SET_ORDER);

        foreach ($matches1 as $match) {
            $sections[$match[1]] = $match[2];
        }
        foreach ($matches2 as $match) {
            $sections[$match[1]] = $match[2];
        }
        
        return $sections;

    }
}