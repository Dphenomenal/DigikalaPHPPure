<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 05/05/2019
 * Time: 10:13
 */

class model_login extends Model
{

    /**
     * model_login constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function checkUser($form)
    {
        $email = $form['email'];
        $pass = $form['pass'];

        if (!empty($email) and !empty($pass)){
            $sql = 'select * from tbl_user where email=? and pass=?';
            $result = self::selectQuery($sql,[$email,$pass]);
            if (sizeof($result) > 0){
                parent::sessionInit();
                parent::setSession('userId',$result[0]['id']);
            }else{
                echo 'not successful';
            }
        }
    }
}