<?php

class model_adminProduct extends Model
{

    /**
     * model_adminProduct constructor.
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllProduct()
    {
        $sql = 'select * from tbl_products';
        $allProducts = self::selectQuery($sql);
        return $allProducts;
    }

    public function getCurrentProduct($id)
    {
        $sql = 'select * from tbl_products where id=?';
        $products = self::selectQuery($sql, [$id]);
        return $products;
    }

    public function getAllCategories()
    {
        $sql = 'select * from tbl_category';
        $result = self::selectQuery($sql);
        return $result;
    }

    public function getProductCategory($idProduct)
    {
        $sql = 'select * from tbl_products where id=?';
        $result = self::selectQuery($sql, [$idProduct]);
        return $result;
    }

    public function getAllColors()
    {
        $sql = 'select * from tbl_color';
        $result = self::selectQuery($sql);
        return $result;
    }

    public function getAllGuarantees()
    {
        $sql = 'select * from tbl_guarantee';
        $result = self::selectQuery($sql);
        return $result;
    }

    function delete_directory($dirname)
    {
        if (is_dir($dirname))
            $dir_handle = opendir($dirname);
        if (!$dir_handle)
            return false;
        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname . "/" . $file))
                    unlink($dirname . "/" . $file);
                else
                    $this->delete_directory($dirname . '/' . $file);
            }
        }
        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }

    function addFile($motherDir, $file = [])
    {
        $boolAccept = 1;
        $acceptedExtension = ['image/jpeg', 'image/jpeg', 'image/png'];
        $sizeLimit = 5242880;
        $newName = 'product';
        $galleryDir = $motherDir . 'gallery/';
        $galleryDirSmall = $galleryDir . 'small';
        $galleryDirLarge = $galleryDir . 'large';
        if (!file_exists($motherDir)) {
            mkdir($motherDir);
            mkdir($galleryDir);
            mkdir($galleryDirSmall);
            mkdir($galleryDirLarge);
        }

        if (isset($file)) {
            $name = $file['name'];
            $type = $file['type'];
            $tmp_name = $file['tmp_name'];
            $error = $file['error'];
            $size = $file['size'];
            $ext = pathinfo($name, PATHINFO_EXTENSION);
            $root = $motherDir . $newName . '.' . $ext;
            if (!in_array($type, $acceptedExtension)) {
                $boolAccept = 0;
            }
            echo 'in array<br>';
            if ($sizeLimit < $size) {
                $boolAccept = 0;
            }
            echo 'ok size<br>';
            if ($boolAccept == 1) {
                move_uploaded_file($tmp_name, $root);
            }
            $rootFor220 = $motherDir . $newName . '_220.' . $ext;
            $this->create_thumbnail($root, $rootFor220, 220, 220);
            $rootFor350 = $motherDir . $newName . '350.' . $ext;
            $this->create_thumbnail($root, $rootFor350, 350, 350);
        }
    }


    public function insertProduct($data = [], $productId = 0, $edit = '', $file)
    {
        $name = $data['name'];
        $categories = $data['categories'];
        $price = $data['price'];
        $introduction = $data['introduction'];
        $count_exist = $data['count_exist'];
        $discount = $data['discount'];
        $colors = join(',', @$data['colors']);
        $guarantees = join(',', $data['guarantees']);
//       $data = [$name,$categories,$price,$introduction,$count_exist,$discount,$colors,$guarantees];
        if ($edit == '') {
            $data = [$name, $categories, $price, $introduction, $count_exist, $discount, $colors, $guarantees];
            $sql = 'insert into tbl_products (title,cat_id,price,information,count_exist,discount,colors,guarantee) VALUES (?,?,?,?,?,?,?,?)';
            $this->insertQuery($sql, $data);
            $productId = parent::$conn->lastInsertId();
            $motherDir = 'public/main-images/products/' . $productId . '/';
            $this->addFile($motherDir, $file);
        } else {
            $data = [$name, $categories, $price, $introduction, $count_exist, $discount, $colors, $guarantees, $productId];
            $sql = 'update tbl_products set title=?,cat_id=?,price=?,information=?,count_exist=?,discount=?,colors=?,guarantee=? where id=?';
            $this->insertQuery($sql, $data);
            $motherDir = 'public/main-images/products/' . $productId . '/';
            $this->addFile($motherDir, $file);
        }
    }

    public function getCurrentProductColors($currentProduct)
    {
        $colorIds = @$currentProduct[0]['colors'];
        $colorIds = explode(',', $colorIds);
        $totalColorsOfProduct = [];
        foreach ($colorIds as $colorId) {
            $sql = 'select * from tbl_color where id=?';
            $color = self::selectQuery($sql, [$colorId]);
            array_push($totalColorsOfProduct, $color);
        }
        return $totalColorsOfProduct;
    } // explode ids and query to tbl_colors to get all colors based on these ids

    public function getCurrentProductGuarantees($currentProduct)
    {
        $guaranteeIds = @$currentProduct[0]['guarantee'];
        $guaranteeIds = explode(',', $guaranteeIds);
        $totalGuaranteesOfProduct = [];
        foreach ($guaranteeIds as $guaranteeId) {
            $sql = 'select * from tbl_guarantee where id=?';
            $guarantee = self::selectQuery($sql, [$guaranteeId]);
            array_push($totalGuaranteesOfProduct, $guarantee);
        }
        return $totalGuaranteesOfProduct;
    }

    public function getAllCriticisms($id)
    {
        $sql = 'select * from tbl_criticism where idProduct=?';
        $result = self::selectQuery($sql, [$id]);
        return $result;
    }

    public function getCurrentCriticism($criticismId)
    {
        $sql = 'select * from tbl_criticism where id=?';
        $result = self::selectQuery($sql, [$criticismId]);
        return $result;
    }

    public function addCriticism($productId = 0, $data = [], $edit = '', $criticismId = 0)
    {
        $introduction = $data['introduction'];
        $name = $data['name'];
//        var_dump($introduction,$name);
//        die();
        if ($edit == '') {
            $data = [$name, $introduction, $productId];
//            var_dump($data);
//            die();
            $sql = 'insert into tbl_criticism (title,description,idProduct) VALUES (?,?,?)';
            $this->insertQuery($sql, $data);
        } else {
            $data = [$name, $introduction, $criticismId];
            $sql = 'update tbl_criticism set title=?,description=? where id=?';
            $this->insertQuery($sql, $data);
        }
    }

    public function removeProduct($data = [])
    {
        $ids = $data;
        $ids = join(',', $ids);
        $sql = 'delete from tbl_products where id IN (' . $ids . ')';
        self::insertQuery($sql);
    }

    public function removeCriticism($data = [])
    {
        $ids = $data;
        $ids = join(',', $ids);
        $sql = 'delete from tbl_criticism where id IN (' . $ids . ')';
        self::insertQuery($sql);
    }

    public function getAttributes($cat_id, $idProduct)
    {
        $sql = 'select tbl_attr.*,tbl_product_attr.value from tbl_attr LEFT JOIN tbl_product_attr ON tbl_attr.id=tbl_product_attr.idAttr and tbl_product_attr.idProduct=? where idCategory=? and parent!=0 ';
        $result = self::selectQuery($sql, [$idProduct, $cat_id]);
        return $result;
    }

    public function getAttributeProduct($idProduct)
    {
        $product = $this->getProductCategory($idProduct);
        $category = $product[0]['cat_id'];
        $attrs = $this->getAttributes($category, $idProduct);
        return $attrs;
    }

    public function setAttr($idProduct, $data = [])
    {
        $delete = 'delete from tbl_product_attr where idProduct=?';
        self::insertQuery($delete, [$idProduct]);
        $ids = $data['ids'];
        foreach ($ids as $id) {
            $sql = 'insert into tbl_product_attr (idProduct,idAttr,value) VALUES (?,?,?)';
            self::insertQuery($sql, [$idProduct, $id, $data['value' . $id]]);
        }
    }

    public function getGallery($idProduct)
    {
        $sql = 'select * from tbl_gallery where idproduct=?';
        $result = self::selectQuery($sql, [$idProduct]);
        return $result;
    }

    public function addGallery($idProduct, $file)
    {
//        echo '<pre>';
//        var_dump($file);
//        echo '</pre>';
//        die();
        $motherDir = 'public/main-images/products/' . $idProduct . '/gallery/large/';
        $boolAccept = 1;
        $acceptedExtension = ['image/jpeg', 'image/jpeg', 'image/png'];
        $sizeLimit = 5242880;
        $newName = time();
        if (isset($file)) {
            $file=$file['file'];
            $name = $file['name'];

            $type = $file['type'];
            $tmp_name = $file['tmp_name'];
            $error = $file['error'];
            $size = $file['size'];
            $ext = pathinfo($name, PATHINFO_EXTENSION);

            $rootMain = $motherDir . $newName . '.' . $ext;
            if (!in_array($type, $acceptedExtension)) {
                $boolAccept = 0;
            }
            if ($sizeLimit < $size) {
                $boolAccept = 0;
            }
            if ($boolAccept == 1) {
                move_uploaded_file($tmp_name, $rootMain);
                $sql = 'insert into tbl_gallery (img,idproduct) VALUES (?,?)';
                self::insertQuery($sql,[$newName.'.'.$ext,$idProduct]);
            }

            $motherDir = 'public/main-images/products/' . $idProduct . '/gallery/small/';
            $root = $motherDir . $newName. '.' . $ext;
            $this->create_thumbnail($rootMain, $root, 115, 115);
        }
    }

    public function removeItemGallery($idProduct, $items)
    {
        $Dir = 'public/main-images/products/'.$idProduct.'/gallery/';
        foreach ($items as $item) {
            $sqlGet = 'select * from tbl_gallery where id=?';
            $itemInfo = self::selectQuery($sqlGet,[$item]);
//            echo '<pre>';
//            var_dump($itemInfo);
//            echo '</pre>';
//            die();
            $smallDir = $Dir.'small/'.$itemInfo[0]['img'];
            $largeDir = $Dir.'large/'.$itemInfo[0]['img'];
            unlink($smallDir);
            unlink($largeDir);
            $sqlRemove = 'DELETE from tbl_gallery where id=?';
            self::insertQuery($sqlRemove, [$item]);
        }
    }
}