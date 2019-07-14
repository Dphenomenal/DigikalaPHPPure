<?php
/**
 * Created by PhpStorm.
 * User: Davoud
 * Date: 04/05/2019
 * Time: 13:26
 */

class showCart2 extends Controller
{

    /**
     * showCart2 constructor.
     */
    public function __construct()
    {
    }

    public function index()
    {
        $all_addresses = $this->model->getAddress();
        $transportData = $this->model->getTransportData();
        $data = ['all_addresses' => $all_addresses, 'transportData' => $transportData];
        $this->view('showCart2/index', $data);
    }

    public function addAddress($editAddressId = '')
    {
        $this->model->addAddress($editAddressId, $_POST);
    }

    public function editAddress($rowId)
    {
        $address = $this->model->getAddress(true, $rowId);
        echo json_encode($address);
    }

    function getPostPrice(){
        if (isset($_POST['postId'])){
           $result =  $this->model->getPostPrice($_POST);
           echo json_encode($result);
        }
    }

    public function setSessionForPostType()
    {
        if (isset($_POST['postId'])){
             $this->model->setSessionForPostType($_POST);
        }
    }
}