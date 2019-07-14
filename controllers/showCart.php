<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 04/05/2019
 * Time: 13:14
 */

class showCart extends Controller
{

    /**
     * showCart constructor.
     */
    public function __construct()
    {
    }

    public function index()
    {
        $basket = $this->model->getBasket();
        $result = $basket[0];
        $totalPrice = $basket[1];
        $data = ['basket'=>$result,'totalPrice'=>$totalPrice];
        $this->view('showCart/index',$data);
    }

    public function removeBasketItem($basketId)
    {
        $result = $this->model->removeBasketItem($basketId);
//        $result = $this->model->getBasket();
//        print_r($result);
        echo json_encode($result);
    }

    public function updateBasket()
    {
        $this->model->updateBasket($_POST);
        $basket = $this->model->getBasket();
//        print_r($basket);
        echo json_encode($basket);
    }



}