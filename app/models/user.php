<?php

namespace app\models;
use \sys\core\Model as Model;

class User extends Model{

    public function register($login, $passw, $email, $regdate, $role_id, $status_id, $confirm){
        $sql = 'insert into users (login,passw, email, regdate, role_id, status_id, confirm) values (?,?,?,?,?,?,?)';

        $params=[$login, $passw, $email, $regdate, $role_id, $status_id, $confirm];
        $this->execute_dml_query($sql, $params);

    }

    public function reg_confirm($email){
        $sql =  'update users set confirm="yes" where email=?';
        $params = [$email];
        $this->execute_dml_query($sql, $params);
    }


    public function check_login($login){
        $sql = "select login from users where login=?";
        $params = [$login];
        $result = $this->execute_select_query($sql, $params);
        if (count($result)===0){
            return true;
        }else{
            return false;
        }
    }

    public function check_email($email){
        $sql =  'select email from users where email=?';
        $params = [$email];
        $result=  $this->execute_select_query($sql, $params);
        if (count($result)===0){
            return true;
        }else{
            return false;
        }
    }

    public function authenticate($login, $passw){
        $sql = "select login, passw from users where login=? and passw=?";
        $params = [$login, $passw];
        $result = $this->execute_select_query($sql, $params);
        if (count($result)>0){
            return true;
        }else{
            return false;
        }

    }

    public function check_confirm($login){
        $sql = 'select confirm from users where login=?';
        $params = [$login];
        $result = $this->execute_select_query($sql, $params);
        if (count($result)>0 && $result[0]['confirm']==='yes'){
            return true;
        }else{
            return false;
        }
    }
}