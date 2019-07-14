<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 04/05/2019
 * Time: 13:54
 */

class userPanel extends Controller
{

    /**
     * userPanel constructor.
     */
    public function __construct()
    {
        Model::sessionInit();
        $check = Model::getSession('userId');
        if ($check == false){
            header('Location:'.URL.'login/index');
        }
    }

    public function index()
    {
        $this->view('userPanel/index');
    }
}