<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 05/05/2019
 * Time: 10:18
 */

class model_showCart2 extends Model
{

    /**
     * model_showCart2 constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function addAddress($editAddressId,$data)
    {
        Model::sessionInit();
        $userId = Model::getSession('userId');
        $family = $data['family'];
        $phone = $data['phone'];
        $tel = $data['tel'];
        $state = $data['state'];
        $mahale = $data['mahale'];
        $city = $data['city'];
        $address = $data['address'];
        $postCode = $data['postCode'];
        $state_name = $data['state_name'];
        $city_name = $data['city_name'];
        echo $state_name;
        echo $city_name;

        if ($editAddressId == ''){
            $sql = 'insert into tbl_address (userId,family,phone,tel,state,mahale,city,address,postCode,city_name,state_name) VALUES (?,?,?,?,?,?,?,?,?,?,?)';
            self::insertQuery($sql,[$userId,$family,$phone,$tel,$state,$mahale,$city,$address,$postCode,$city_name,$state_name]);
        }else{
            $sql = 'update tbl_address set family=?,phone=?,tel=?,state=?,mahale=?,city=?,address=?,postCode=?,city_name=?,state_name=? where id=?';
            self::insertQuery($sql,[$family,$phone,$tel,$state,$mahale,$city,$address,$postCode,$city_name,$state_name,$editAddressId]);
        }
    }

    public function getAddress($currentAddress=false,$rowId=0)
    {
        if ($currentAddress == false){
            $sql = 'select * from tbl_address';
        }else{
            $sql = 'select * from tbl_address where id=?';
        }
        $address = self::selectQuery($sql,[$rowId]);
        return $address;
    }

    public function getTransportData()
    {
        $sql = 'select * from tbl_post_type';
        $result = self::selectQuery($sql);
        return $result;
    }

    public function getPostPrice($data)
    {

        $cityId = $data['cityId'];
        $postId = $data['postId'];

        $addressId = $data['addressId'];
        $sql = 'select * from tbl_address where id=?';
        $addressRow = self::selectQuery($sql,[$addressId]);
        $address = serialize($addressRow);
        self::sessionInit();
        self::setSession('address',$address);
        $results = $this->getBasket();
        $result =$results[0];
        $totalWeightAll =0;
        foreach ($result as $row){
            $weight = $row['weight'];
            $count = $row['count'];
            $totalWeight = $weight * $count;
            $totalWeightAll = $totalWeightAll + $totalWeight;
        }
        $totalPrice=$results[1];
        $url = 'http://webservice1.link/ws/v1/rest/';
//        $api_key = '08Fc18cE53E459132d2D4D770d2D0B8A'; //define in helper class
        $obj = new frotel_helper($url);
        $buyType = 2; //پرداخت نقدی
        $post_price = $obj->getPrices($cityId,$totalPrice,$totalWeightAll,$buyType,$postId);
        if ($buyType == 2){
            $online = $post_price['naghdi'][$postId]['post'];
        }else{
            $online = $post_price['naghdi'][$postId]['post'];
        }

        $buyType = 1; //پرداخت در محل
        $post_price = $obj->getPrices($cityId,$totalPrice,$totalWeightAll,$buyType,$postId);
        if ($buyType == 1){
            $inPlace = $post_price['posti'][$postId]['post'];
        }else{
            $inPlace = $post_price['posti'][$postId]['post'];
        }
        $result = ['naghdi'=>$online,'posti'=>$inPlace];
        return $result;
    }

    public function setSessionForPostType($data)
    {
        $postId = $data['postId'];
        self::sessionInit();
        self::setSession('postId',$postId);
//        $postId = self::getSession('postId');
//        echo $postId;
    }
}