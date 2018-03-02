<?php
/**
 *
 * @arParam массив праметров компонента
 */
$log = '';
$error = false;
$error_text = '';

if(!empty($arParam['post']['email']) AND !empty($arParam['post']['password'])) {
    $email    = get_clean($arParam['post']['email']);
    $password = get_clean($arParam['post']['password']);

    if(check_email($email)){
        $error = true;
    }
    if(check_password($password)){
        $error = true;
    }
    $password = get_password($password);

    if($this->db->query("SELECT * FROM user WHERE email='".$email."' AND password = '".$password."'")->row_array()) {
        $this->app->user_login($email,$password);
        $log = 'Вы вошли';
    }else{
        $log = 'Ошибка авторизации';
    }
}



