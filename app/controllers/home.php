<?php

namespace app\controllers;

use \sys\core\View as View;
use \sys\core\Controller as Controller;

class Home extends Controller {

    public function index() {
        return new View('home/index.php', [
            'title' => 'Главная'
        ]);
    }

    public function about() {
        return new View('home/about.php', [
            'title' => 'Про сайт'
        ]);
    }

    public function contact() {
        return new View('home/contact.php', [
            'title' => 'Контакты'
        ]);
    }
}