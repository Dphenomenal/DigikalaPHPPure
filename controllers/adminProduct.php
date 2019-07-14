<?php

class AdminProduct extends Controller {


    /**
     * AdminProduct constructor.
     */
    public function __construct()
    {
    }

    public function index()
    {
        if (isset($_POST['ids'])){
        }
        $allProducts = $this->model->getAllProduct();
        $data = ['allProducts'=>$allProducts];
        $this->view('admin/product/index',$data);
    }

    public function criticism($productId)
    {

        $allCriticisms = $this->model->getAllCriticisms($productId);
        $currentProduct = $this->model->getCurrentProduct($productId);
        $data = ['allCriticisms'=>$allCriticisms,'currentProduct'=>$currentProduct];
        $this->view('admin/product/criticism',$data);
    }

    public function addCriticism($productId=0,$criticismId=0,$edit='')
    {
        if (isset($_POST['name'])) {
            if ($edit == '') {
                $this->model->addCriticism($productId, $_POST);
            } else {
                $this->model->addCriticism($productId, $_POST, $edit, $criticismId);
                header('Location:'.URL.'adminProduct/criticism/'.$productId);
            }
        }
        $currentProduct = $this->model->getCurrentProduct($productId);
        $currentCriticism = $this->model->getCurrentCriticism($criticismId);

        $data = ['currentProduct'=>$currentProduct,'edit'=>$edit,'currentCriticism'=>$currentCriticism,'productId'=>$productId];
        $this->view('admin/product/addCriticism',$data);
    }

    public function removeProduct()
    {
        if (isset($_POST['ids'])){
        $this->model->removeProduct($_POST['ids']);
        header('Location:'.URL.'adminProduct/index');
        }
    }

    public function removeCriticism($ProductId)
    {
        if (isset($_POST['ids'])){
            $this->model->removeCriticism($_POST['ids']);
            header('Location:'.URL.'adminProduct/criticism/'.$ProductId);
        }
    }

    public function addValueAttr($idProduct)
    {
        if (isset($_POST['ids'])){
            $this->model->setAttr($idProduct,$_POST);
            header('Location:'.URL.'adminProduct/index');
        }
        $attrs =$this->model->getAttributeProduct($idProduct);
        $data = ['attrs'=>$attrs,'idProduct'=>$idProduct];
        $this->view('admin/product/valueAttr',$data);
    }

    public function addProduct($productId=0,$edit='')
    {
        if (isset($_POST['name'])){
            if (isset($_FILES['file'])){
                $file = $_FILES['file'];
            }else{
                $file = '';
            }
            if ($edit == ''){
                $this->model->insertProduct($_POST,$productId,'',$file);
                header('Location: '.URL.'adminProduct/index');
            }else{
                $this->model->insertProduct($_POST,$productId,$edit,$file);
                header('Location: '.URL.'adminProduct/index');
            }
        }
        $allCategories = $this->model->getAllCategories();
        $allColors = $this->model->getAllColors();
        $allGuarantees = $this->model->getAllGuarantees();
        $currentProduct = $this->model->getCurrentProduct($productId);
        $currentProductColors = $this->model->getCurrentProductColors($currentProduct);
        $currentProductGuarantees = $this->model->getCurrentProductGuarantees($currentProduct);
        $data = ['allCategories'=>$allCategories,'allColors'=>$allColors,'allGuarantees'=>$allGuarantees,'currentProduct'=>$currentProduct,'edit'=>$edit,'productId'=>$productId,'currentProductColors'=>$currentProductColors,'currentProductGuarantees'=>$currentProductGuarantees];
        $this->view('admin/product/addProduct',$data);
    }

    public function gallery($idProduct)
    {

        if (isset($_FILES['file'])){
            $this->model->addGallery($idProduct,$_FILES);
        }

        $all_imgs = $this->model->getGallery($idProduct);
        $data = ['all_imgs'=>$all_imgs,'idProduct'=>$idProduct];
        $this->view('admin/product/gallery',$data);
    }

    public function removeItemGallery($idProduct)
    {
        if (isset($_POST['ids'])){
            $this->model->removeItemGallery($idProduct,$_POST['ids']);
            header('Location: '.URL.'adminProduct/gallery/'.$idProduct);
        }
    }



}