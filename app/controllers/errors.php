<?php

namespace app\controllers;

use \sys\core\View as View;
use \sys\core\Controller as Controller;

class Errors extends Controller {

    public function notfound() {
        return new View('errors/notfound.php');
    }
}
