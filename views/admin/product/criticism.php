<?php
$allCriticisms = $data['allCriticisms'];
$currentProduct = $data['currentProduct'];

//echo '<pre>';
//var_dump($allCriticisms);
//echo '</pre>';
//die();
?>
<div id="main">
    <div class="boxes">
        <div class="admin-main">
            <?php require ('views/admin//menus.php');?>
            <div class="admin-content">
                <h4 class="font-B-Yekan">مدیریت نقد و انتقادات
                    {
                    <a><span><?php echo @$currentProduct[0]['title']?></span></a>
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
                    <a href="adminProduct/addCriticism/<?php echo @$currentProduct[0]['id']?>" class="addCategory">افزودن نقد</a>
                    <form action="adminProduct/removeCriticism/<?php echo @$currentProduct[0]['id'];?>>" method="post">
                        <button type="submit" class="removeCategory">حذف دسته</button>

                        <table>
                            <tr>
                                <td>ردیف</td>
                                <td>عنوان</td>
                                <td>ویرایش</td>
                                <td>انتخاب</td>
                            </tr>
                            <?php foreach ($allCriticisms as $Criticism) {
                                ?>
                                <tr>
                                    <td><?= $Criticism['id']?></td>
                                    <td><?= $Criticism['title']?></td>
                                    <td><a href="adminProduct/addCriticism/<?= $currentProduct[0]['id'].'/'?><?= $Criticism['id']?>/edit"><span class="edit-submennu"></span></a></td>
                                    <td>
                                        <input type="checkbox" name="ids[]" id="" value="<?php echo $Criticism['id']?>">
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
