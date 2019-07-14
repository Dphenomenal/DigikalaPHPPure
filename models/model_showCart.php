<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 05/05/2019
 * Time: 10:14
 */

class model_showCart extends Model
{

    /**
     * model_showCart constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }





    public function removeBasketItem($basketId)
    {
        $sql = 'delete from tbl_basket where id=?';
        self::insertQuery($sql,[$basketId]);
        $result = $this->getBasket();
        return $result;
    }

    public function updateBasket($data)
    {
        if (isset($data)){
            $basketId = $data['basketId'];
            $count = $data['count'];
            $sql = 'update tbl_basket set count=? where id=?';
            self::insertQuery($sql,[$count,$basketId]);
            //do update query
        }

    }
}