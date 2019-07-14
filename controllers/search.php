<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 04/05/2019
 * Time: 13:03
 */

class search extends Controller
{

    /**
     * search constructor.
     */
    public function __construct()
    {
    }

    public function index()
    {
        $this->view('search/index');
    }
}