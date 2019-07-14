<?php

class model_adminCategory extends Model {

    /**
     * model_adminCategory constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getCategory($getCurrentCat=false,$idCategory='')
    {
        if ($getCurrentCat == true){
            $sql = 'select * from tbl_category where id=?';
            $result = self::selectQuery($sql,[$idCategory]);
        }else{
            $sql = 'select * from tbl_category where parent=0';
            $result = self::selectQuery($sql);
        }
        return $result;
    } //get current category or get parents category

    public function getChildren($idCategory)
    {
        $sql = 'select * from tbl_category where parent=?';
        $data = [$idCategory];
        $result = self::selectQuery($sql,$data);
        return $result;
    } //get all children of special parent category

    public function getParent($idCategory)
    {
        $currentCategory = $this->getCategory(true,$idCategory);
        $parent_id =@$currentCategory[0]['id'];
        $arr_parents = [];
        while($parent_id != 0){
            $sql = 'select * from tbl_category where id=?';
            $parent = self::selectQuery($sql,[$parent_id]);
            $parent_id = $parent[0]['parent'];
            array_push($arr_parents,$parent);
        }
        return $arr_parents;
    } //get all parents with cat_id

    public function getAllCategories()
    {
        $sql = 'select * from tbl_category';
        $result = self::selectQuery($sql);
        return $result;
    } // get all categories

    public function insertUpdateCategory($title='',$parent=0,$edit='',$idCategory)
    {
        if ($edit == ''){
            $sql = 'insert into tbl_category (name,parent) VALUES (?,?)';
            $stmt = self::$conn->prepare($sql);
            $stmt->bindParam(1,$title);
            $stmt->bindParam(2,$parent);
        }else {
            $sql = 'update tbl_category set name=?,parent=? where id=?';
            $stmt = self::$conn->prepare($sql);
            $stmt->bindParam(1,$title);
            $stmt->bindParam(2,$parent);
            $stmt->bindParam(3,$idCategory);
        }
        $stmt->execute();
    } // insert and update category based on id($idCategory)

    public function removeItems($ids = [])
    {
        $allChildrenIds = [];
        $allChildrenIds = array_merge($allChildrenIds,$ids);
        while(sizeof($ids)>0){
            $childrenIds = $this->getChilds($ids);
            $allChildrenIds = array_merge($allChildrenIds,$childrenIds);
            $ids = $childrenIds;
        }
        $data = join(',',$allChildrenIds);
        $sql = 'delete from tbl_category where id IN ('.$data.')';
        $stmt = self::$conn->prepare($sql);
        $stmt->execute();
    } //remove categories

    public function getChilds($ids=[])
    {
        $children_id = [];
        foreach ($ids as $id){
            $children = $this->getChildren($id);//state 2 children
            foreach ($children as $child){
                array_push($children_id,$child['id']);
            }
        }
        return $children_id;
    } // get all children ids for remove

    public function getParentsAttr($catId,$parentAttrId=0)
    {
        $sql = 'select * from tbl_attr where idCategory=? and parent=?';
        $result = self::selectQuery($sql,[$catId,$parentAttrId]);
        return $result;

    } // get all attribute parents

    public function getCurrentParentAttr($catId,$currentAttrId)
    {
        if ($currentAttrId > 0) {
            $sql = 'select * from tbl_attr where idCategory=? and id=?';
            $result = self::selectQuery($sql, [$catId, $currentAttrId], 1, PDO::FETCH_ASSOC);
            return $result;
        }
    } // get current parent Attribute

    public function insertAttr($catId,$data=[],$edit,$attrID)
    {
        $name = $data['title'];
        $parent=$data['categories'];
        if ($edit == ''){
            $sql = 'insert into tbl_attr (name,idCategory,parent) VALUES (?,?,?)';
            self::insertQuery($sql,[$name,$catId,$parent]);
        }else{
            $sql = 'UPDATE tbl_attr SET name=?,idCategory=?,parent=? where id=?';
            self::insertQuery($sql,[$name,$catId,$parent,$attrID]);
        }
    } // insert and update attribute

    public function getCurrentAttr($catID,$attrID)
    {
        $sql = 'select * from tbl_attr where idCategory=? and id=?';
        $result = self::selectQuery($sql,[$catID,$attrID],1,PDO::FETCH_ASSOC);
        return $result;
    } // get current attribute

    public function deleteAttr($catID = 0,$data=[])
    {
        $ids = $data['ids'];
        $sql = 'select * from tbl_attr where idCategory=?';
        $allAttr = self::selectQuery($sql,[$catID]);
        $allAttrArr=[];
        $allAttrArr = array_merge($allAttrArr,$ids);
        foreach ($ids as $id){
            foreach ($allAttr as $attr){
                if ($attr['parent'] == $id){
                    array_push($allAttrArr,$attr['id']);
                }
            }
        }
        $allAttrArr = join(',',$allAttrArr);
        $d = 'DELETE from tbl_attr where id IN ('.$allAttrArr.')';
        self::insertQuery($d);
    } // delete attribute


}