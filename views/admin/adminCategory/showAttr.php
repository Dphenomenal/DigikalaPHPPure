<?php
$catId = $data['catId'];
$ParentsAttr = $data['ParentsAttr'];
$currentCategory = $data['currentCategory'];
$currentParentAttr = $data['currentParentAttr'];
$parentID = 0;
if (is_null($currentParentAttr)){
    $parentID = $currentParentAttr = 0;
}else{
    $parentID = $currentParentAttr['id'];
}
//$currentAttr = $data['currentAttr'];
//echo '<pre>';
//var_dump($currentParentAttr);
//echo '</pre>';
//die();
//$currentAllAttr = @$data['currentAllAttr'];
//$currentAttr = $data['currentAttr'];
//$currentCategory = $data['currentCategory'];
//$categoriesInfo = $data['categoriesInfo'];
//if (isset($data['currentCategory'])){

//    $currentCategoryId = @$currentCategory[0]['id'];
//}else{
//    $currentCategoryId = 0;
//}
//
//if (isset($data['parents'])){
//    $parents = $data['parents'];
//    $parents = array_reverse($parents);
//}

?>
<div id="main">
    <div class="boxes">
        <div class="admin-main">
            <?php require ('views/admin//menus.php');?>
            <div class="admin-content">
                <h4 class="font-B-Yekan">مدیریت ویژگی ها
                    {
                    <a href="adminCategory/showAttr/<?= @$currentCategory[0]['id']?>"><span><?= @$currentCategory[0]['name']; ?></span>
                    <span>
                        <?php if (!$parentID == 0){
                            echo ' -> سر ویژگی : ';
                            echo $currentParentAttr['name'];
                        }?>
                    </span>
                    </a>
                    }
                </h4>
                <div class="admin-content-table">
                    <style>
                        .addCategory,.removeCategory{
                            padding: 10px 15px;
                            font-family: B-yekan, Vazir, sans-serif;
                            font-size: 10pt;
                            background: #5ac45d;
                            color: #FFFFFF;
                            display: block;
                            float: left;
                            margin-left: 20px;
                            margin-bottom: 10px;
                            border-radius: 4px;
                            box-shadow: .3pt .3pt 5px #eeeeee;
                        }
                        .removeCategory{
                            background: red;
                            border: 0;
                        }
                        .addCategory:hover{
                            color: #439145;
                        }
                        .removeCategory:hover{
                            color: #810000;
                        }
                    </style>
                    <a href="adminCategory/addAttr/<?php echo $currentCategory[0]['id'];?>/<?php echo $parentID?>" class="addCategory">افزودن دسته</a>
                    <form action="adminCategory/deleteAttr/<?php echo $currentCategory[0]['id']?>" method="post">
                        <button type="submit" class="removeCategory">حذف دسته</button>

                        <table>
                            <tr>
                                <td>ردیف</td>
                                <td>عنوان ویژگی</td>
                                <?php if ($parentID == 0){
                                ?>
                                <td>مشاهده ی زیر ویژگی ها</td>
                                <?php
                                }
                                ?>
                                <td>ویراش ویژگی</td>
                                <td>انتخاب</td>
                            </tr>
                            <?php foreach ($ParentsAttr as $item) {
                                ?>
                                <tr>
                                    <td><?= $item['id']?></td>
                                    <td><a href="adminCategory/showAttr/<?= $currentCategory[0]['id']?>/<?php echo $item['id']?>"><?= $item['name']?></a></td>
                                    <?php if ($parentID == 0){
                                        ?>
                                        <td><a href="adminCategory/showAttr/<?= $currentCategory[0]['id']?>/<?php echo $item['id']?>"><span class="show-submennu"></span></a></td>
                                        <?php
                                    }?>
                                    <td><a href="adminCategory/addAttr/<?= $currentCategory[0]['id']?>/<?php if (isset($currentParentAttr)){echo $parentID.'/';}?><?php echo $item['id']?>/edit"><span class="edit-submennu"></span></a></td>
                                    <td>
                                        <input type="checkbox" name="ids[]" id="" value="<?php echo $item['id']?>">
                                    </td>
                                </tr>
                                <?php
                            }?>
                        </table>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
