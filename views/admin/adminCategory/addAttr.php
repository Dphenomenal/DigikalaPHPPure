<?php
$currentParentAttr = $data['currentParentAttr'];
$currentAttr = $data['currentAttr'];
$parents = $data['parents'];
$currentCategory = $data['currentCategory'];
$edit = $data['edit'];

if (is_null($currentParentAttr)){
    $currentParentAttr = 0;
}else{
    $currentParentAttr = $currentParentAttr['id'];
}



//echo '<pre>';
//var_dump($currentParentAttr);
//echo '</pre>';
//die();
?>
<div id="main">
    <div class="boxes">
        <div class="admin-main">
            <?php require('views/admin/menus.php'); ?>
            <div class="admin-content">
                <h4 class="font-B-Yekan">
                    <?php
                    if ($edit == '') {
                        echo 'ایجاد ویژگی جدید';
                    } else {
                        echo 'ویرایش ویژگی';
                    }
                    ?>
                </h4>
                <div class="admin-content-table">
                    <style>
                        form {
                            width: 100%;
                            float: right;
                        }

                        form label {
                            display: block;
                            font-family: B-yekan, Vazir, sans-serif;
                            font-size: 9.3pt;
                        }

                        form label input {
                            width: 200px;
                            border: .3pt solid #eeeeee;
                            padding: 5px;
                        }

                        form label select {
                            width: 170px;
                            padding: 3px;
                        }

                        .labelTitle {
                            width: 200px;
                            display: block;
                            float: right;
                            line-height: 28px;
                        }

                        .addCategory {
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
                            box-shadow: 1pt 1pt 5px #5ac45d;
                            border: none;
                        }

                        .addCategory:hover {
                            color: #439145;
                        }
                    </style>
                    <?php
                    if ($edit == '') {
                        $setEdit = '';
                    } else {
                        $setEdit = '/'.$edit;
                    }
                    ?>
                    <form action="adminCategory/addAttr/<?php echo $currentCategory[0]['id'].'/'; echo $currentParentAttr.'/'; echo $currentAttr['id']; echo $setEdit?>" method="post">
                        <label for="title"><span class="labelTitle">عنوان ویژگی :</span>
                            <?php
                            if ($edit == '') {
                                $value = '';
                            } else {
                                $value = @$currentAttr['name'];
                            }
                            ?>
                            <input id="title" type="text" placeholder="عنوان دسته" name="title" value="<?php echo $value; ?>">
                        </label>

                        <label for="categories"><span class="labelTitle">مادر :</span>
                            <select name="categories" id="categories">
                                <?php
                                $parentId = $data['currentSelectParentId'];
                                ?>
                                <option value="">انتخاب کنید</option>
                                <?php

                                foreach ($parents as $parent) {
//                                    if (isset($currentAttr)){
                                        if ($parent['id'] == $currentParentAttr) {
                                            $x = 'selected';
                                        } else {
                                            $x = '';
                                        }
//                                    }
                                    ?>
                                        <option value="<?= $parent['id'] ?>" <?php echo $x;?>><?= $parent['name'] ?></option>
                                    <?php
                                }
                                ?>

                            </select>
                        </label>
                        <button type="submit" class="addCategory">ثبت دسته</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
</div>
<script>

</script>