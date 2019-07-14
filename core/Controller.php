<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 04/05/2019
 * Time: 02:24
 */

class Controller
{

    public $model = 'index';
    /**
     * Controller constructor.
     */
    public function __construct()
    {
    }


    public function view($viewName,$data=[],$includeHeader='',$includeFooter=''){
        if ($includeHeader == ''){
            require ('header.php');
        }
        require ('views/'.$viewName.'.php');
        if ($includeFooter == ''){
            require ('footer.php');
        }


    }


    public function model($modelName){
        require ('models/model_'.$modelName.'.php');
        $modelClass = 'model_'.$modelName;
        $this->model = new $modelClass;
    }
}