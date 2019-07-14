<?php
$attrs = $data['attrs'];
$idProduct = $data['idProduct'];
//var_dump($attrs);
//die();
?>
<div id="main">
    <div class="boxes">
        <div class="admin-main">
            <?php require('views/admin/menus.php'); ?>
            <div class="admin-content">

                <h4 class="font-B-Yekan">
                    ویژگی ها
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
                    </style>
                    <form action="adminProduct/addValueAttr/<?php echo $idProduct;?>" method="post">
                        <?php foreach ($attrs as $attr){
                            ?>
                            <label for="name"><span class="labelTitle"><?php echo $attr['name'];?> :</span>
                                <input id="name" type="text"  name="value<?php echo $attr['id']; ?>" value="<?= $attr['value'];?>">
                                <input id="name" type="hidden"  name="ids[]" value="<?= $attr['id'];?>">
                            </label>
                            <?php
                        }?>
                        <button type="submit" class="addCategory">ثبت دسته</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>
