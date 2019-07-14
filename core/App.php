<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 04/05/2019
 * Time: 00:21
 */

class App
{
    public $controller = 'index';
    public $method = 'index';
    public $params = [];
    public function __construct()
    {
        if (isset($_GET['url']) && (isset($_GET['url']) !== 'index.php')) {

            $url = $_GET['url'];
            $url = $this->explodeUrl($url);
            $this->controller = $url[0];
            unset($url[0]);
            if (isset($url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
            $this->params = array_values($url);

            if (file_exists('controllers/'.$this->controller.'.php')) {
                require('controllers/' . $this->controller . '.php');
                $object = new $this->controller;
                $object->model($this->controller);
                if (method_exists($object, $this->method)) {
                    call_user_func_array([$object, $this->method], $this->params);
                }
            }
        }else{
            $this->controller = 'index';
            $this->method= 'index';
            if (file_exists('controllers/'.$this->controller.'.php')) {
                require('controllers/' . $this->controller . '.php');
                $object = new $this->controller;
                $object->model($this->controller);
                if (method_exists($object, $this->method)) {
                    call_user_func_array([$object, $this->method], $this->params);
                }
            }
        }
    }

    public function explodeUrl($url){
        $url = filter_var($url,FILTER_SANITIZE_URL);
        $url = rtrim($url,'/');
        $url = explode('/',$url);
        return $url;
    }
}
