<?php
$all_imgs = $data['all_imgs'];
$idProduct = $data['idProduct'];
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
                    <form action="adminProduct/gallery/<?php echo $idProduct?>" method="post" enctype="multipart/form-data" class="fileForm">
                        <input type="file" name="file" style="margin-bottom: 20px;">
                    <a onclick="sendFile(this);" class="addCategory" style="float: right;cursor: pointer;">ارسال فایل</a>
                    </form>
                    <script>
                        function sendFile(tag) {
                                var a = $(tag);
                                a.parent('.fileForm').submit();
                        }
                    </script>
                    <form action="adminProduct/removeItemGallery/<?php echo $idProduct?>" method="post">
                        <button type="submit" class="removeCategory">حذف مورد</button>

                        <table>
                            <tr>
                                <td>ردیف</td>
                                <td>تصویر</td>
                                <td>انتخاب</td>
                            </tr>
                            <?php foreach ($all_imgs as $img) {
                                ?>
                                <tr>
                                    <td><?= $img['id']?></td>
                                    <td><img src="public/main-images/products/<?php echo $idProduct ?>/gallery/small/<?= $img['img']?>" alt=""></td>
                                    <td>
                                        <input type="checkbox" name="ids[]" id="" value="<?php echo $img['id']?>">
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
