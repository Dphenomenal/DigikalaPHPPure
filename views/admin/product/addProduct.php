<script src="public/ckeditor/ckeditor.js"></script>

<?php
$allCategories = $data['allCategories'];
$allColors = $data['allColors'];
$allGuarantees = $data['allGuarantees'];
$currentProduct = $data['currentProduct'];
$currentProduct = @$currentProduct[0];
$currentProductColors = $data['currentProductColors'];
$currentProductGuarantees = $data['currentProductGuarantees'];
$edit = $data['edit'];
$productId = $data['productId'];
//echo '<pre>';
//var_dump($currentProductGuarantees);
//echo '</pre>';
//die();
?>
<div id="main">
    <div class="boxes">
        <div class="admin-main">
            <?php require('views/admin/menus.php'); ?>
            <div class="admin-content">
                <?php
                    if ($edit == ''){
                        $headerTitle = 'ایجاد محصول جدید';
                    }else{
                        $headerTitle = 'ویرایش محصول';
                    }
                ?>
                <h4 class="font-B-Yekan">
                    <?= $headerTitle;?>
                </h4>
                <div class="admin-content-table">
                    <?php
                    if ($edit == ''){
                        $editUrl = '';
                    }else{
                        $editUrl = 'edit';
                    }
                    ?>
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
                            border: .3pt solid #7a7a7a;
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

                        .colorCircle{
                            width: 15px;
                            height: 15px;
                            border-radius: 300px;
                            display: inline-block;
                            position: relative;
                            top: 4px;
                        }
                        .colorItem{
                            display: inline-block;
                            /*width: 65px;*/
                            padding: 2px 10px;
                            height: 25px;
                            margin-left: 10px;
                        }
                        .colorItemSpan{
                            display: inline-block;
                        }
                        .colorItemImg{
                            width: 15px;
                            float: left;
                            position: relative;
                            top: 4px;
                            right: 4px;
                        }
                        #cke_editor1{
                            width: 860px;
                            margin: 40px 0 20px;
                        }
                    </style>
                    <form action="adminProduct/addProduct/<?php echo $productId.'/'; echo $editUrl;?>" method="post" enctype="multipart/form-data">
                        <label for="name"><span class="labelTitle">عنوان محصول :</span>
                        <?php
                            if ($edit == ''){
                                $ProductName = '';
                            }else{
                                $ProductName = $currentProduct['title'];
                            }
                        ?>
                            <input id="name" type="text" placeholder="عنوان دسته" name="name" value="<?= $ProductName?>">
                        </label>
                        <label for="categories"><span class="labelTitle">دسته والد(مادر) :</span>
                            <select name="categories" id="categories" autocomplete="off">

                                <option value="">انتخاب کنید</option>
                                <?php
                                foreach ($allCategories as $category) {
                                    $selectedItem = '';
                                    if ($edit == '') {
                                        $selectedItem = '';
                                    } else {
                                        if ($category['id'] == $currentProduct['cat_id']) {

                                            $selectedItem = 'selected';
                                        }
                                    }
                                        ?>
                                        <option value="<?php echo $category['id']; ?>" <?php echo $selectedItem?> name="category"><?= $category['name'] ?></option>
                                        <?php
                                }
                                ?>
                            </select>
                        </label>
                        <label for="price"><span class="labelTitle">قیمت :</span>
                            <?php
                            if ($edit == ''){
                                $ProductPrice = '';
                            }else{
                                $ProductPrice = $currentProduct['price'];
                            }
                            ?>
                            <input id="price" type="text" placeholder="قیمت" name="price" value="<?= $ProductPrice;?>">
                        </label>
                        <label for="introduction"><span class="labelTitle">معرفی اجمالی :</span>
                            <?php
                            if ($edit == ''){
                                $ProductIntroduction = '';
                            }else{
                                $ProductIntroduction = $currentProduct['information'];
                            }
                            ?>
                        </label>
                        <textarea class="editor1" id="editor1" name="introduction"><?= $ProductIntroduction;?></textarea>

                        <script>
                            CKEDITOR.replace('editor1',{

                            })
                        </script>
                        <label for="count_exist"><span class="labelTitle">تعداد موجود :</span>
                            <?php
                            if ($edit == ''){
                                $ProductCount = '';
                            }else{
                                $ProductCount = $currentProduct['count_exist'];
                            }
                            ?>
                            <input id="count_exist" type="text" placeholder="تعدادموجود" name="count_exist" value="<?= $ProductCount;?>">
                        </label>
                        <label for="discount"><span class="labelTitle">میزان تخفیف(%) :</span>
                            <?php
                            if ($edit == ''){
                                $ProductDiscount = '';
                            }else{
                                $ProductDiscount = $currentProduct['discount'];
                            }
                            ?>
                            <input id="discount" type="text" placeholder="تخفیف به درصد" name="discount" value="<?= $ProductDiscount;?>">
                        </label>
                        <label for="colors" id="colors"><span class="labelTitle">انتخاب رنگ :</span>
                            <select name="colors" id="colors" autocomplete="off" class="option">
                                <option value="" >انتخاب کنید</option>
                                <?php

                                foreach ($allColors as $color) {
                                    ?>
                                    <option value="<?= $color['id'] ?>" onclick="addColorSpan('<?php echo $color['hex']?>',this,'<?php echo $color['name']?>','<?php echo $color['id']?>')"><?= $color['name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="colorItems">
                                <?php
                                if ($edit == ''){
                                }else{
                                    if (sizeof($currentProductColors)>1){
                                        foreach ($currentProductColors as $currentProductColor){
                                            echo "<span class='colorItem' style='background:rgba(238,238,238,0.55);'>\n" .
                                                "                                        <input type='hidden' value='".@$currentProductColor[0]['id']."' name='colors[]'><span class = 'colorItemSpan' style=' color: #444444;'>".@$currentProductColor[0]['name']."</span>\n".
                                                "                                        <i class='colorCircle' style='background:".@$currentProductColor[0]['hex'].";'></i>\n" .
                                                "                                        <img onclick='removeSpanItem(this);' class = 'colorItemImg' src='public/main-images/close-icon.gif' alt=''>\n" .
                                                "                                    </span>";
                                        }
                                    }

                                }
                                ?>
                            </span>
                        </label>
                        <label for="guarantees" id="guarantees"><span class="labelTitle">انتخاب گارانتی :</span>
                            <select name="guarantees" id="guarantees" autocomplete="off" class="optionGuarantees">
                                <option value="" >انتخاب کنید</option>
                                <?php

                                foreach ($allGuarantees as $guarantee) {
                                    ?>
                                    <option value="<?php echo $guarantee['id'] ?>" onclick="addGuaranteeSpan(this,'<?php echo $guarantee['name']?>','<?php echo $guarantee['id']?>')"><?php echo $guarantee['name'] ?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <span class="guaranteeItems">
                                <?php
                                if ($edit == ''){

                                }else{
                                if (sizeof($currentProductColors)>1) {
                                    foreach ($currentProductGuarantees as $currentProductGuarantee){
                                        echo "<span class='colorItem' style='background:rgba(238,238,238,0.55);'>\n" .
                                            "                                        <input type='hidden' value='".@$currentProductGuarantee[0]['id']."' name='guarantees[]'><span class = 'colorItemSpan' style=' color: #999;line-height: 23px;'>".@$currentProductGuarantee[0]['name']."</span>\n".
                                            "                                        <img onclick='removeSpanItem(this);' class = 'colorItemImg' src='public/main-images/close-icon.gif' alt=''>\n" .
                                            "                                    </span>";
                                    }
                                    }
                                }
                                ?>
                            </span>
                        </label>
                        <label for="file"><span class="labelTitle">آپلود تصویر :</span>
                            <input id="file" type="file" name="file" >
                        </label>



                        <button type="submit" class="addCategory">ثبت دسته</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
<script>

    function addColorSpan(color,tag,name,id) {
        var item = "<span class='colorItem' style='background:rgba(238,238,238,0.55);'>\n" +
            "                                        <input type='hidden' value='"+id+"' name='colors[]'><span class = 'colorItemSpan' style=' color: "+color+";'>"+name+"</span>\n" +
            "                                        <i class='colorCircle' style='background:"+color+"'></i>\n" +
            "                                        <img onclick='removeSpanItem(this);' class = 'colorItemImg' src='public/main-images/close-icon.gif' alt=''>\n" +
            "                                    </span>";
        $('.colorItems').append(item);
    }

    function addGuaranteeSpan(tag,name,id) {
        var item = "<span class='colorItem' style='background:rgba(238,238,238,0.55);'>\n" +
            "                                        <input type='hidden' value='"+id+"' name='guarantees[]'><span class = 'colorItemSpan' style=' color: #999;'>"+name+"</span>\n" +
            "                                        <i class='colorCircle' style='background:#999;'></i>\n" +
            "                                        <img onclick='removeSpanItem(this);' class = 'colorItemImg' src='public/main-images/close-icon.gif' alt=''>\n" +
            "                                    </span>";
        $('.guaranteeItems').append(item);
    }
    function removeSpanItem(tag){
        var imgRemoveTag = $(tag);
        imgRemoveTag.parents('.colorItem').remove();
    }

</script>