<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 05/05/2019
 * Time: 10:13
 */

class model_product extends Model
{

    /**
     * model_product constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getProduct($id)
    {
        $sql = 'select * from tbl_products where id=?';
        $result = self::selectQuery($sql, [$id], 1, PDO::FETCH_ASSOC);
        $price = $result['price'];
        $discount = $result['discount'];
        $calculatePrice = self::calculatePrice($price, $discount);
        $result['discount_price'] = $calculatePrice[0];
        $result['total_price'] = $calculatePrice[1];
        $starting_time = $result['special_time'];
        $special_time = self::getOption();
        $finish = $special_time['special_time'];
        $endTime = $finish + $starting_time;
        /* echo '<pre>';
         var_dump($endTime);
         echo '</pre>';
         die();*/
        date_default_timezone_set('Asia/Tehran');
        $endTime = date('F d, Y H:i:s', $endTime);

        $color_arr = [];
        $total_colors = $result['colors'];
        $total_colors = explode(',', $total_colors);
        $total_colors = array_filter($total_colors);
        foreach ($total_colors as $color) {
            $currentColor = $this->getColor($color);
            array_push($color_arr, $currentColor);
        }
        $result['colors_info'] = $color_arr;

        $guarantee_arr = [];
        $total_guarantee = $result['guarantee'];
        $total_guarantee = explode(',', $total_guarantee);
        $total_guarantee = array_filter($total_guarantee);
        foreach ($total_guarantee as $guarantee) {
            $currentGuarantee = $this->getGuarantee($guarantee);
            array_push($guarantee_arr, $currentGuarantee);
        }
        $result['guarantee_info'] = $guarantee_arr;

        $arr = [$result, $endTime];
        return $arr;
    }

    public function getColor($id)
    {
        $sql = 'select * from tbl_color where id=?';
        $result = self::selectQuery($sql, [$id], 1);
        return $result;
    }

    public function getGuarantee($id)
    {
        $sql = 'select * from tbl_guarantee where id=?';
        $result = self::selectQuery($sql, [$id], 1);
        return $result;
    }

    public function getOnlyDigikala()
    {
        $sql = 'select * from tbl_products where onlyDigikala=1';
        $result = self::selectQuery($sql);
        foreach ($result as $key => $items) {
            $discount = $result[$key]['discount'];
            $price = $result[$key]['price'];
            $total_price = self::calculatePrice($price, $discount);
            $result[$key]['total_price'] = $total_price[1];
        }
        return $result;
    }

    public function getCriticism($id)
    {
        $sql = 'select * from tbl_criticism where idProduct=?';
        $result = self::selectQuery($sql, [$id]);
        return $result;
    }

    public function technical_attributes($category_id, $product_id)
    {
        $sql = 'select * from tbl_attr where idCategory=? and parent=0';
        $parents = self::selectQuery($sql, [$category_id]);
        foreach ($parents as $key => $child) {
            $q = 'select tbl_attr.name,tbl_product_attr.value from tbl_attr INNER JOIN tbl_product_attr ON tbl_attr.id = tbl_product_attr.idAttr and tbl_product_attr.idProduct=? where tbl_attr.parent=?';
            $result = self::selectQuery($q, [$product_id, $child['id']]);
            $parents[$key]['children'] = $result;
        }

        return $parents;
    }

    public function getCommentParam($idCategory)
    {
        $sql = 'select * from tbl_comment_param where idCategory=?';
        $result = self::selectQuery($sql, [$idCategory]);// params id title idCategory
        $query = 'select * from tbl_comment';
        $comments = self::selectQuery($query);
        $count = sizeof($comments);
        $total_params = array();
        foreach ($comments as $comment) {
            $params = $comment['rateParam'];
            $params = unserialize($params); // [1=>2,2=>3,3=>1]
            foreach ($params as $key => $value) {
                $param_key = $key;
                $param_value = $value;
                if (!isset($total_params[$param_key])) {
                    $total_params[$key] = 0;
                }
                $total_params[$param_key] = $total_params[$param_key] + $param_value;
            }
        }
        $total_params = $this->calculateAverage($total_params, $count);// with average
        return [$result, $total_params];
    }

    public function calculateAverage($arr = [], $index)
    {

        foreach ($arr as $key => $member) {
            $arr[$key] = $member / $index;
        }
        return $arr;
    }


    public function getCommentInfo($idProduct)
    {
        $sql = 'select * from tbl_comment where idproduct=?';
        $result = self::selectQuery($sql, [$idProduct]);
        return $result;
    }

    public function getQuestionAnswer($idProduct)
    {
        $sql = 'select * from tbl_question where idproduct=? and parent=0';
        $questions = self::selectQuery($sql, [$idProduct]);
        $sql2 = 'select * from tbl_question where parent!=0';
        $answers = self::selectQuery($sql2);
        $new_arr = [];
        foreach ($answers as $key => $value) {
            $parent = $value['parent'];
            $new_arr[$parent] = $value;
        }
        return [$questions, $new_arr];
    }

    public function getGallery($idProduct)
    {
        $sql = 'select * from tbl_gallery where idproduct=?';
        $result = self::selectQuery($sql, [$idProduct]);
        return $result;
    }

    public function addBasket($idProduct, $color, $guarantee)
    {
        $cookie = parent::getCookie(); //set cookie



        echo $cookie.'<br>';
        //we should have only one cookie for each browser
        $sql = 'select * from tbl_basket where cookie=? and idProduct=? and color=? and guarantee=?';
        $result = self::selectQuery($sql, [$cookie, $idProduct, $color, $guarantee]);
//        var_dump($result);
        if (sizeof($result) > 0) {
            echo 'result is greater than 0<br>';
            $sql = 'update tbl_basket set count=count+1 where cookie=? and idProduct=?';
            self::insertQuery($sql, [$cookie, $idProduct]);
        } else {
            echo 'result is less than 0<br>';
            $sql = 'insert into tbl_basket (cookie,idProduct,color,guarantee,count) VALUES (?,?,?,?,"1")';
            self::insertQuery($sql, [$cookie, $idProduct, $color, $guarantee]);
        }
    }


}