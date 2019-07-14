<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 05/05/2019
 * Time: 10:19
 */

class model_showCart3 extends Model
{

    /**
     * model_showCart3 constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getBasketSc3()
    {
        $results = $this->getBasket();
        return $results;

    }

    public function getPostPrice($address,$postId,$baskets)
    {
        $basketsA = $baskets[0];
        $totalPrice = $baskets[1];
        $totalWeightAll =0;
        foreach ($basketsA as $row){
            $weight = $row['weight'];
            $count = $row['count'];
            $totalWeight = $weight * $count;
            $totalWeightAll = $totalWeightAll + $totalWeight;
        }

        $url = 'http://webservice1.link/ws/v1/rest/';
        $obj = new frotel_helper($url);


        $buyType = 2; //پرداخت نقدی
        $postPrice = $obj->getPrices($address[0]['city'],$totalPrice,$totalWeightAll,$buyType,$postId);
        if ($buyType == 2){
            $pishtaz = $postPrice['naghdi'][$postId]['post'];
        }else{
            $pishtaz = $postPrice['posti'][$postId]['post'];
        }

        $buyType = 1; //پرداخت در محل
        $postPrice = $obj->getPrices($address[0]['city'],$totalPrice,$totalWeightAll,$buyType,$postId);
        if ($buyType == 1){
            $sefareshi = $postPrice['posti'][$postId]['post'];
        }else{
            $sefareshi = $postPrice['naghdi'][$postId]['post'];
        }
        $result = ['pishtaz'=>$pishtaz,'sefareshi'=>$sefareshi];

        if ($postId == 1){
            $result = $result['pishtaz']/10;
        }else if ($postId == 2){
            $result = $result['sefareshi']/10;
        }
        return $result;
    }
}