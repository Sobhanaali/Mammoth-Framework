<?php

namespace app\controllers;

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

        return "handling submitted data";
    }
}

