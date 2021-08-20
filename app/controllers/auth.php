<?php

namespace app\controllers;

use app\forms\Entryform as Entryform;
use \sys\core\View as View;
use \app\models\User as User;
use \sys\core\Controller as Controller;
use \app\forms\Regform as Regform;
use \sys\lib\Mailer as Mailer;

class Auth extends Controller {

    public function __construct() {
        parent::__construct(new User());
    }

    public function reg() {
        $form = new Regform();
        if (empty($_POST['submit'])){
            return new View('auth/reg.php', [
                'title' => 'Регистрация','form'=>$form,
                'script'=>View::RES.'/js/reg.js'
            ]);
        }else{
            //
            $form->fill();
            //
            $login=$form->fields[0]->fieldValue;
            $passw =md5($form->fields[1]->fieldValue);
            $email=$form->fields[3]->fieldValue;
            $regdate = date('Y-m-d H:i:s');
            //Todo id of user should be 3
            $role_id=4;
            $status_id=1;
            $confirm='no';
            //
            $this->model->register($login, $passw, $email, $regdate, $role_id, $status_id, $confirm);
            //
            //mail...
            $mailer = new Mailer($email);
            $mailer->send();


            $message = "Вы успешно зарегестрированы на сайте Teach-Assistant!<h4>";
            $message .="На указаный Вами: $email отправлено соответствующе письмо,";
            $message .=' в котором содержиться ссылка на подтверждение Вашей регистрации. <hr>';
            $color="#721c24";
            //
            return new View('auth/reginfo.php',[
                'title'=>'Register-Info',
                'message'=>$message,
                'color'=>$color
            ]);
        }

    }

    public function entry() {
        $form = new Entryform();
        if (empty($_POST['submit'])) {
            return new View('auth/entry.php', [
                'title' => 'Авторизация',
                'form' => $form
            ]);
        }else{
            //authorization
            $form->fill();
            $login=$form->fields[0]->fieldValue;
            $passw=md5($form->fields[1]->fieldValue);
            $stand=$form->fields[2]->fieldValue;
            //
            if ($this->model->authenticate($login, $passw)){
                if ($this->model->check_confirm($login)) {
                    $_SESSION["user"] = $login;
                    if ($stand === 'yes') {
                        setcookie('user', $login, time() + 3600 * 24 * 7);
                    }
                    $message = "Вы успешно авторизованы на сайте Teach-Assistant!<hr>";
                    $color = 'darkblue';
                }else{
                    $message = "Ваша регистрация еще не подтверждена на сайте Teach -assistant<hr>";
                    $color = 'darkcyan';
                }
            }else{
                $message = "Авторизация провалена - пользователь не найден!<hr>";
                $color = 'red';
            }
            return new View('auth/entryinfo.php',[
                'title'=>'Entry-Info',
                'message'=>$message,
                'color'=>$color
            ]);
        }
    }

    public function confirm($email){
        $this->model->reg_confirm($email);
        return new View("auth/confirm.php",[
            'title'=>'Register-Confirm',
            'message'=>"Регистрация пользователя $email - успешно подтверждена",
            'color'=>'cyan'

        ]);
    }

    public function ajax_check_login(){
//        echo'ajax-ok';
        $loginX = $_POST['login'];
        if ($this->model->check_login($loginX)){
            echo"free";
        }else{
            echo'taken';
        }
    }

    public function ajax_check_email(){
//        echo'ajax-ok';
        $email = $_POST['email'];
        if ($this->model->check_email($email)){
            echo"free";
        }else{
            echo'taken';
        }
    }

    public function profile (){
        return new View('auth/profile.php', [
            'title' => 'Профиль пользователя'
        ]);
    }

    public function exit (){
        session_destroy();
        if (isset($_COOKIE['user'])){
            setcookie('user', '', time()-3600);
        }
        return new View('auth/exit.php', [
            'title' => 'Выход из системы'
        ]);
    }
}