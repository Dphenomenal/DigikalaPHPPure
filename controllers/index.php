<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 04/05/2019
 * Time: 02:12
 */

class index extends Controller
{

    /**
     * index constructor.
     */
    public function __construct()
    {
    }
    public function index(){
        $data1 = $this->model->getSlider1();
        $data2 = $this->model->getSpecialProducts();
        $data3 = $this->model->getOnlyDigikala();
        $data4 = $this->model->getTheMostViewed();
        $data5 = $this->model->getTheNewest();
        $result = $data2[0];
        $special_time = $data2[1];
        $arr_data = [$data1,$result,$special_time,$data3,$data4,$data5];
        /*echo '<pre>';
        var_dump($arr_data[4]);
        echo '</pre>';
        die();*/
        $this->view('index/index',$arr_data);
    }
}