<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 04/05/2019
 * Time: 13:22
 */

class showCart1 extends Controller
{

    /**
     * showCart1 constructor.
     */
    public function __construct()
    {
        parent::__construct();
        Model::sessionInit();
        $check = Model::getSession('userId');
        if ($check != false){
            header('Location: '.URL.'showCart2');
        }

    }

    public function index()
    {
        $this->view('showCart1/index');
    }
}