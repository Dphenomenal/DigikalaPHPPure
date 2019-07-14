<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 05/05/2019
 * Time: 10:12
 */

class model_index extends Model
{
    /**
     * model_index constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getSlider1(){
        $sql = 'select * from tbl_slider1';
        $result = self::selectQuery($sql);
        return $result;
    }

    public function getSpecialProducts(){
        $sql = 'select * from tbl_products where special=1';
        $result = self::selectQuery($sql);
        foreach ($result as $key => $items){
            $discount = $result[$key]['discount'];
            $price = $result[$key]['price'];
            $total_price = self::calculatePrice($price,$discount);
            $result[$key]['total_price'] = $total_price[1];
        }
        $special_time = @$result[0]['special_time'];//we could set another number except of 0 like 1,2,3,...
        $sql1 = 'select * from tbl_option where option_title="special_time"';
        $result1 = self::selectQuery($sql1);
        $option_title = $result1[0]['option_value'];
        $endTime = $special_time + $option_title;
        date_default_timezone_set('Asia/Tehran');
        $endTime = date('F d, Y H:i:s',$endTime);

        $arr_result = [$result,$endTime];
        return $arr_result;
    }

    public function getOnlyDigikala(){
        $sql = 'select * from tbl_products where onlyDigikala=1';
        $result = self::selectQuery($sql);
        return $result;
    }

    public function getTheMostViewed()
    {
        $sql = 'select * from tbl_option where option_title="product_slider_limit" ';
        $limit = self::selectQuery($sql);
        $limit = $limit[0]['option_value'];
        $sql = 'select * from tbl_products order by viewed desc limit '.$limit;
        $result = self::selectQuery($sql);
        return $result;
    }
    public function getTheNewest()
    {
        $sql = 'select * from tbl_option where option_title="product_slider_limit" ';
        $limit = self::selectQuery($sql);
        $limit = $limit[0]['option_value'];
        $sql = 'select * from tbl_products order by id desc limit '.$limit;
        $result = self::selectQuery($sql);
        return $result;
    }

}