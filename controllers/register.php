<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 04/05/2019
 * Time: 12:55
 */

class register extends Controller
{


    /**
     * register constructor.
     */
    public function __construct()
    {
    }

    public function index()
    {
        $this->view('register/index');
    }
}