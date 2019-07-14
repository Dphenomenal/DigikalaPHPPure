<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 04/05/2019
 * Time: 11:50
 */

class product extends Controller
{

    /**
     * product constructor.
     */
    public function __construct()
    {
    }

    public function index($id)
    {
        $result = $this->model->getProduct($id);
        $gallery = $this->model->getGallery($id);
        $relatedProduct = $this->model->getOnlyDigikala();
        $information = [$result[0],$result[1],$relatedProduct,$gallery];
        $this->view('product/index',$information);

    }

    public function tab($id,$cat_id){
        $index = $_POST['index']+1;
        if ($index == 1){
            $criticism = $this->model->getCriticism($id);
            $this->view('product/select1',[$criticism],1,1);
        }
        if ($index == 2){
            $attr = $this->model->technical_attributes($cat_id,$id);
            $this->view('product/select2',[$attr],1,1);
        }
        if ($index == 3){
            $params = $this->model->getCommentParam($cat_id);
            $info = $this->model->getCommentInfo($id);
            $result = $params[0];
            $average = $params[1];
            $this->view('product/select3',[$info,$result,$average],1,1);
        }
        if ($index == 4){
            $result = $this->model->getQuestionAnswer($id);
            $questions = $result[0];
            $answers = $result[1];
            $this->view('product/select4',[$questions,$answers],1,1);
        }
    }

    public function addBasket($idProduct,$color=0,$guarantee=0)
    {
        $this->model->addBasket($idProduct,$color,$guarantee);
        echo '<i>there is prod uct controller</i>';
    }
}