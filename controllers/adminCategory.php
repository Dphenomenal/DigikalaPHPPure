<?php

class AdminCategory extends Controller
{

    /**
     * AdminCategory constructor.
     */
    public function __construct()
    {
    }

    public function index()
    {
        $categoriesInfo = $this->model->getCategory();
        $data = ['categoriesInfo' => $categoriesInfo];
        $this->view('admin/adminCategory/index', $data);
    }
        //in the both of methods we should send  category info in view to show elements in table
    public function showChildren($idCategory)
    {
        $currentCategory = $this->model->getCategory(true, $idCategory);
        $children = $this->model->getChildren($idCategory);
        $parents = $this->model->getParent($idCategory);
        $data = ['categoriesInfo' => $children, 'parents' => $parents, 'currentCategory' => $currentCategory];
        $this->view('admin/adminCategory/index', $data);
    }

    public function addCategory($parent_id = 0, $edit = '')
    {
        if (isset($_POST['title'])) {
            $title = $_POST['title'];
            if (isset($_POST['categories'])) {
                $categories = $_POST['categories'];
                if ($categories == '') {
                    $categories = 0;
                }
            } else {
                $categories = 0;
            }
            if ($parent_id == '') {
                $parent_id = 0;
            }
            $this->model->insertUpdateCategory($title, $categories, $edit, $parent_id);
        }
        $currentCategory = $this->model->getCategory(true, $parent_id); //current category
        $allCategories = $this->model->getAllCategories(); //all categories
        $data = ['allCategories' => $allCategories, 'currentSelectParentId' => $parent_id, 'edit' => $edit, 'currentCategory' => $currentCategory];
        $this->view('admin/adminCategory/addCategory', $data);
    }

    public function removeCategory($idCategory)
    {
        if (isset($_POST['ids'])) {
            $ids = $_POST['ids'];
            $this->model->removeItems($ids);
        }
        header('Location:' . URL . '/adminCategory/showChildren/' . $idCategory);
    }

    public function showAttr($catId = 0, $currentAttrId = 0)
    {
        $ParentsAttr = $this->model->getParentsAttr($catId, $currentAttrId);
        $currentParentAttr = $this->model->getCurrentParentAttr($catId, $currentAttrId);
        $currentCategory = $this->model->getCategory(true, $catId);
        $data = ['catId' => $catId, 'ParentsAttr' => $ParentsAttr, 'currentCategory' => $currentCategory, 'currentParentAttr' => $currentParentAttr];
        $this->view('admin/adminCategory/showAttr', $data);
    }

    public function addAttr($catID = 0, $parentAttrId = 0, $attrID = 0, $edit = '')
    {
        if (isset($_POST['title'])) {
            $this->model->insertAttr($catID, $_POST, $edit, $attrID);
            header('Location:'.URL.'adminCategory/showAttr/'.$catID.'/');
        }
        $currentParentAttr = $this->model->getCurrentParentAttr($catID, $parentAttrId);
        $currentAttr = $this->model->getCurrentAttr($catID, $attrID);
        $parents = $this->model->getParentsAttr($catID, 0);
        $currentCategory = $this->model->getCategory(true, $catID);
        $data = ['currentCategory' => $currentCategory, 'edit' => $edit, 'currentParentAttr' => $currentParentAttr, 'currentAttr' => $currentAttr, 'parents' => $parents];
        $this->view('admin/adminCategory/addAttr', $data);
    }

    public function deleteAttr($catID = 0,$parentID=0)
    {
        if (isset($_POST['ids'])){
        $this->model->deleteAttr($catID,$_POST);
        header('Location: '.URL.'adminCategory/showAttr/'.$catID.'/'.$parentID.'');
        }
    }

}