<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 04/05/2019
 * Time: 13:33
 */

class showCart3 extends Controller
{

    /**
     * showCart3 constructor.
     */
    public function __construct()
    {
    }

    public function index()
    {
        Model::sessionInit();
        $address = Model::getSession('address');
        $address = unserialize($address);
        $postId = Model::getSession('postId');

        $results = $this->model->getBasketSc3();
        $getPostPrice = $this->model->getPostPrice($address,$postId,$results);

        $result = $results[0];
        $totalPrice = $results[1];
        $totalPriceDiscount = $results[2];
        $data = ['basket'=>$result,'totalPrice'=>$totalPrice,'postPrice',$getPostPrice,'totalPriceDiscount'=>$totalPriceDiscount,'address'=>$address,'postId'=>$postId];

//        var_dump($data);
     $this->view('showCart3/index',$data);
    }
}