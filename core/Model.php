<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 05/05/2019
 * Time: 10:11
 */

class Model
{

    public static $conn;

    public function __construct()
    {
        self::$conn = new PDO('mysql:host=' . SERVER_NAME . ';dbname=' . DB_NAME, USER_NAME, PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
        self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getOption()
    {
        $sql = 'select * from tbl_option';
        $result = self::selectQuery($sql);
        foreach ($result as $item) {
            $titles = $item['option_title'];
            $values = $item['option_value'];
            $new_arr[$titles] = $values;
        }
        return $new_arr;
    }

    public static function calculatePrice($price, $discount)
    {
        $discount_price = ($discount * $price) / 100;
        $total_price = ((100 - $discount) * $price) / 100;
        $new_arr = [$discount_price, $total_price];
        return $new_arr;
    }

    public function selectQuery($sql, $values = [], $fetch = '', $fetchType = PDO::FETCH_ASSOC)
    {
        $stmt = self::$conn->prepare($sql);
        foreach ($values as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }
        $stmt->execute();
        if ($fetch == '') {
            $result = $stmt->fetchAll($fetchType);
        } else {
            $result = $stmt->fetch($fetchType);
        }
        return $result;
    }

    public function insertQuery($sql = '', $data = [])
    {
        $stmt = self::$conn->prepare($sql);
        foreach ($data as $key => $value) {
            $stmt->bindValue($key + 1, $value);
        }

        $stmt->execute();
    }

    function create_thumbnail($file, $pathToSave = '', $w, $h = '', $crop = FALSE)
    {

        $new_height = $h;

        list($width, $height) = getimagesize($file);

        $r = $width / $height;

        if ($crop) {
            if ($width > $height) {
                $width = ceil($width - ($width * abs($r - $w / $h)));
            } else {
                $height = ceil($height - ($height * abs($r - $w / $h)));
            }
            $newwidth = $w;
            $newheight = $h;
        } else {
            if ($w / $h > $r) {
                $newwidth = $h * $r;
                $newheight = $h;
            } else {
                $newheight = $w / $r;
                $newwidth = $w;
            }
        }

        $what = getimagesize($file);

        switch (strtolower($what['mime'])) {
            case 'image/png':
                $src = imagecreatefrompng($file);

                break;
            case 'image/jpeg':
                $src = imagecreatefromjpeg($file);
                break;
            case 'image/gif':
                $src = imagecreatefromgif($file);
                break;
            default:
                //die();
        }

        if ($new_height != '') {
            $newheight = $new_height;
        }

        $dst = imagecreatetruecolor($newwidth, $newheight);//the new image
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);//az function

        imagejpeg($dst, $pathToSave, 95);//pish farz in tabe 75 darsad quality ast

        return $dst;
    }

    public static function sessionInit()
    {
        session_start();
    }

    public static function setSession($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public static function getSession($name)
    {
        if (isset($_SESSION[$name])) {
            return $_SESSION[$name];
        } else {
            return false;
        }
    }


    public static function getCookie()
    {
        if (isset($_COOKIE['basket'])) {
            $cookie = $_COOKIE['basket'];
        } else {
            echo 'cookie not set';
            $name = 'basket';
            date_default_timezone_set('Asia/tehran');
            $value = time();
            $expireTime = $value + 7 * 24 * 3600;
            setcookie($name, $value, $expireTime, '/');
            $cookie = $value;
        }
        return $cookie;
    }

    public function getBasket()
    {
        $cookie = self::getCookie();
        $sql = 'select b.count,b.id as basketId,p.*,c.hex,c.name as colorName,g.name as guaranteeName from tbl_basket b '.
            'join tbl_products p ON b.idProduct=p.id '.
            'join tbl_color c ON b.color=c.id '.
            'join tbl_guarantee g On b.guarantee=g.id '.
            'where cookie=?';
        $results = self::selectQuery($sql,[$cookie]);


        $totalPriceDiscount = 0;
        foreach ($results as $result){
            $discount = $result['discount'];
            $price = $result['price'];
            $priceDiscount = ($price * $discount) / 100;
            $totalPriceDiscount = $totalPriceDiscount + $priceDiscount; // هزینه ی تخفیف کل
            $totalPriceDiscount = $totalPriceDiscount;
        }
        $totalPriceLastPrice = 0;
        foreach ($results as $basketItem){
            $price = $basketItem['price'];
            $count = $basketItem['count'];
            $totalPrice = $price * $count;
            $totalPriceLastPrice = $totalPriceLastPrice + $totalPrice;
        }

        return [$results,$totalPriceLastPrice,$totalPriceDiscount];
    }
}

class frotel_helper
{
    private $url;

    private $api_key = '08Fc18cE53E459132d2D4D770d2D0B8A';
    const METHOD_POST   = 'post';
    const METHOD_GET    = 'get';

    const BUY_COD       = 1;

    const BUY_ONLINE    = 2;

    const DELIVERY_PISHTAZ      = 1;

    const DELIVERY_SEFARESHI    = 2;

    const DELIVERY_FIXED = 20;

    private $errors = array();

    public function __construct($webserviceUrl)
    {
        $this->url = $webserviceUrl;
    }


    public function getPrices($des_city,$price,$weight,$buy_type,$send_type)
    {
        $params = array(
            'des_city'  => $des_city,
            'price'     => $price,
            'weight'    => $weight,
            'buy_type'  => $buy_type,
            'send_type' => $send_type
        );
        return $this->call('order/getPrices.json',$params);
    }


    private function call($url,$params,$methodType = self::METHOD_POST)
    {
        // flush error list
        $this->errors = array();
        if (stripos($url, 'http://') === false)
            $url = $this->url . $url;
        $params['api'] = $this->api_key;
        $data = http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, $methodType === self::METHOD_POST);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        //set the url, number of POST vars, POST data
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        if ($this->isJson($result)) {
            $result = json_decode($result,true);
            return $this->parseResponse($result);
        }
        throw new FrotelResponseException('Failed to Parse Response');
    }
    private function isJson($string) {
        return ((is_string($string) && (is_object(json_decode($string)) || is_array(json_decode($string))))) ? true : false;//PHP Version 5.2.17 server
    }
    private function parseResponse($response)
    {
        if (!isset($response['code'],$response['message'],$response['result']))
            throw new FrotelResponseException('پاسخ دریافتی از سرور معتبر نیست.');
        if ($response['code'] == 0)
            return $response['result'];
        $this->errors[] = $response['message'];
        throw new FrotelWebserviceException(implode(' ', $response['message']));
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
class FrotelResponseException extends Exception{}
class FrotelWebserviceException extends Exception{}


