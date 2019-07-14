<?php
$allProducts = $data['allProducts'];

//echo '<pre>';
//var_dump($allProducts);
//echo '</pre>';
//die();
?>
<div id="main">
    <div class="boxes">
        <div class="admin-main">
            <?php require ('views/admin//menus.php');?>
            <div class="admin-content">
                <h4 class="font-B-Yekan">مدیریت محصولات
                    {
                            <a href="adminCategory/showChildren/"><span></span></a>
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
                    <a href="adminProduct/addProduct/" class="addCategory">افزودن محصول</a>
                    <form action="adminProduct/removeProduct/" method="post">
                        <button type="submit" class="removeCategory">حذف دسته</button>
                        <table>
                            <tr>
                                <td>ردیف</td>
                                <td>عنوان</td>
                                <td>معرفی</td>
                                <td>تخفیف</td>
                                <td>قیمت</td>
                                <td>ویژگی ها</td>
                                <td>گالری</td>
                                <td>ویرایش</td>
                                <td>نقد و بررسی</td>
                                <td>انتخاب</td>
                            </tr>
                            <?php foreach ($allProducts as $product) {
                                ?>
                                <tr>
                                    <td><?= $product['id']?></td>
                                    <td><?= $product['title']?></td>
                                    <td><?= $product['information']?></td>
                                    <td><?= $product['discount']?></td>
                                    <td><?= $product['price']?></td>
                                    <td><a href="adminProduct/addValueAttr/<?= $product['id']?>/"><span class="show-attr"></span></a></td>
                                    <td><a href="adminProduct/gallery/<?= $product['id']?>">گالری</a></td>
                                    <td><a href="adminProduct/addProduct/<?= $product['id']?>/edit"><span class="edit-submennu"></span></a></td>
                                    <td><a href="adminProduct/criticism/<?= $product['id']?>/"><span class="criticsm_icon"></span></a></td>
                                    <td>
                                        <input type="checkbox" name="ids[]" id="" value="<?php echo $product['id']?>">
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
