<script src="public/ckeditor/ckeditor.js"></script>

<?php
$currentProduct = $data['currentProduct'];
$currentCriticism = $data['currentCriticism'];
//$currentProduct = @$currentProduct[0];
//$currentProductColors = $data['currentProductColors'];
$edit = $data['edit'];
$productId = $data['productId'];
//echo '<pre>';
//var_dump($currentCriticism);
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
                    $headerTitle = 'ایجاد نقد جدید';
                }else{
                    $headerTitle = 'ویرایش نقد';
                }
                ?>
                <h4 class="font-B-Yekan">
                    <?= $headerTitle;?>
                    {
                    <a><span><?php echo @$currentProduct[0]['title']?></span></a>
                    }
                </h4>
                <div class="admin-content-table">
                    <?php
                    if ($edit == ''){
                        $editUrl = '';
                        $currentCriticismId = '';
                    }else{
                        $editUrl = 'edit';
                        $currentCriticismId = @$currentCriticism[0]['id'].'/';
//                        die();
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
                    <form action="adminProduct/addCriticism/<?php echo $productId.'/'.$currentCriticismId; echo $editUrl;?>" method="post">
                        <label for="name"><span class="labelTitle">عنوان نقد :</span>
                            <?php
                            if ($edit == ''){
                                $ProductName = '';
                            }else{
                                $ProductName = @$currentCriticism[0]['title'];
                            }
                            ?>
                            <input id="name" type="text" placeholder="عنوان دسته" name="name" value="<?= $ProductName?>">
                        </label>

                        <label for="introduction"><span class="labelTitle">متن انتقاد :</span>
                            <?php
                            if ($edit == ''){
                                $ProductIntroduction = '';
                            }else{
                                $ProductIntroduction = @$currentCriticism[0]['description'];
//                                var_dump($currentCriticism);
//                                die();
                            }
                            ?>
                        </label>
                        <textarea class="editor1" id="editor1" name="introduction"><?= $ProductIntroduction;?></textarea>

                        <script>
                            CKEDITOR.replace('editor1',{

                            })
                        </script>
                        <button type="submit" class="addCategory">ثبت نقد</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
