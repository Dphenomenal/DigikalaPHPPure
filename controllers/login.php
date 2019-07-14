<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 04/05/2019
 * Time: 10:45
 */

class login extends Controller
{

    /**
     * login constructor.
     */
    public function __construct()
    {
    }

    public function index()
    {
        $this->view('login/index');
    }

    public function checkUser()
    {
        if (isset($_POST['email'])){
            $this->model->checkUser($_POST);

            Model::sessionInit();
            $check = Model::getSession('userId');
            if ($check == true){
                header('Location:'.URL.'userPanel/index');
            }
        }

    }
}