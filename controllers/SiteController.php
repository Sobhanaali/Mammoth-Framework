<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function home()
    {
        $params = [
            'devName' => 'Sobhan Aali'
        ];

        return $this->render('home' , $params);
    }

    public function contact(){
        return $this->render('contact');
    }
       
    public function handleContent(Request $request)
    {
        $body = $request->getBody();

        echo '<pre>';
        var_dump($body);
        echo '</pre>';
        exit();

        return "handling submitted data";
    }
}

