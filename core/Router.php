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
            return 'Not Found';
        }

        if(is_string($callback)){
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    public function renderView($view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);

        $sections = $this->renderSections($viewContent);
        
        // echo '<pre>';
        // var_dump($sections);
        // echo '</pre>';
        
        foreach($sections as $key => $content){
            $layoutContent = str_replace("{{{$key}}}" , $content , $layoutContent);
        }
        return $layoutContent;
        // return str_replace('{{content}}' , $viewContent , $layoutContent);
    }

    protected function layoutContent()
    {
        ob_start();
        include_once Application::$ROOT_DIR."/views/layouts/main.php";
        return ob_get_clean();
    }

    protected function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$ROOT_DIR."/views/$view.php";
        return ob_get_clean();
    }

    protected function renderSections($view){
        
        $j = 1;
        $sections = [];
        while($j){
            $j = strpos($view , "@section") ?? false;
            // var_dump($j);
            if($j+8){
                $key = "";
                $content = "";
                $keyOpen = false;
                $contentOpen = false;
                $keyClose = false;
                $contentClose = false;
                $end = -1;
                $cama = 0;
    
                for($i= $j+8 ; $i<strlen($view); $i++){
                    if($view[$i] === ','){
                        $cama = 1;
                    }
                    
                    if($view[$i] === ')' && $cama){
                        $j= $i;
                        break;
                    }

                    if($i === $end){
                        $j = $i;
                        break;
                    }

                    if($view[$i] === ')' && !$cama){
                        $contentOpen = true;
                        $contentClose = false;

                        $end = strpos($view , "@endSection");

                        continue;
                    }

                    if($cama && !$contentClose && $keyClose && $view[$i] === '\''){
                        if($contentOpen){
                            $contentOpen = false;
                            $contentClose = true;
                        }else{
                            $contentOpen = true;
                            $contentClose = false;
                        }
                        continue;
                    }
    
                    if(!$contentOpen && $view[$i] === '\''){
                        if($keyOpen){
                            $keyOpen = false;
                            $keyClose = true;
                        }else{
                            $keyOpen = true;
                            $keyClose = false;
                        }
                        continue;
                    }
                    if($keyOpen){
                        $key .= $view[$i];
                        // echo $view[$i].'<br>';
                    }
                    if($contentOpen){
                        $content .= $view[$i];
                    }
                }
                if($key !== ""){

                    $sections[$key] = $content;
                }
                $view = substr($view , $j+1);
                
            }
        }
        // echo '<pre>';
        // var_dump($sections);
        // echo '</pre>';
        return $sections;
        
    }
}