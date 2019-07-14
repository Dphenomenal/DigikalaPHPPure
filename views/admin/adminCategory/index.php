<?php
    $categoriesInfo = $data['categoriesInfo'];
    if (isset($data['currentCategory'])){
    $currentCategory = $data['currentCategory'];
    $currentCategoryId = @$currentCategory[0]['id'];
    }else{
        $currentCategoryId = 0;
    }

        if (isset($data['parents'])){
        $parents = $data['parents'];
        $parents = array_reverse($parents);
    }

?>
<div id="main">
    <div class="boxes">
        <div class="admin-main">
            <?php require ('views/admin//menus.php');?>
            <div class="admin-content">
                <h4 class="font-B-Yekan">مدیریت دسته ها
                    {
                    <?php
                    if (isset($data['parents'])){
                    foreach ($parents as $parent){
                        ?>
                        <a href="adminCategory/showChildren/<?= $categoriesInfo[0]['parent']?>"><span><?= $parent[0]['name'].'->'; ?></span></a>
                    <?php
                        }
                    }else{
                        echo 'دسته های اصلی';
                    }?>
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
                    <a href="adminCategory/addCategory/<?php echo $currentCategoryId;?>" class="addCategory">افزودن دسته</a>
                    <form action="adminCategory/removeCategory/<?php echo $categoriesInfo[0]['parent']?>" method="post">
                    <button type="submit" class="removeCategory">حذف دسته</button>

                        <table>
                        <tr>
                            <td>ردیف</td>
                            <td>عنوان دسته</td>
                            <td>مشاهده ی زیر دسته ها</td>
                            <td>ویژگی ها</td>
                            <td>ویراش دسته</td>
                            <td>انتخاب</td>
                        </tr>
                        <?php foreach ($categoriesInfo as $item) {
                            // item == current category
                            ?>
                            <tr>
                                <td><?= $item['id']?></td>
                                <td><a href="adminCategory/showChildren/<?= $item['id']?>"><?= $item['name']?></a></td>
                                <td><a href="adminCategory/showChildren/<?= $item['id']?>"><span class="show-submennu"></span></a></td>
                                <td><a href="adminCategory/showAttr/<?= $item['id']?>/0">مشاهده ی ویژگی</a></td>
                                <td><a href="adminCategory/addCategory/<?= $item['id']?>/edit"><span class="edit-submennu"></span></a></td>
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
