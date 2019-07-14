<?php $baskets = $data['basket'];
?>
<div class="cart-product">
    <table class="basketTable" cellspacing="0">
        <thead>
        <tr>
            <td>شرح محصول</td>
            <td>تعداد</td>
            <td>قیمت واحد</td>
            <td>قیمت کل</td>
            <td></td>
        </tr>
        </thead>
        <tbody>
        <style>
            .cart-product > table > tbody > tr .content .palette-color{
                width: 20px;
                height: 20px;
                display: inline-block;
                border-radius: 300px;

                margin-bottom: 0;
                position: relative;
                top: 5px;
                right: 0;
            }
        </style>
        <?php
        foreach ($baskets as $basket) {
            ?>
            <tr>
                <td>
                    <div class="first-col-cart">
                        <div class="img">
                            <img src="public/main-images/products/<?= $basket['id'] ?>/product_220.jpg" alt="">
                        </div>
                        <div class="content">
                            <p class="product-name">
                                <?php $basket['title'] ?>
                            </p>
                            <p class="product-model font-sm ">
                                Schwan 903 Steering Wheel Lock
                            </p>
                            <p class="product-color">
                                <span>رنگ</span><span class="palette-color" style="background: <?= $basket['hex'];?>;"></span><span class="pallet-name"><?= $basket['colorName']?></span>
                            </p>
                            <p class="product-guarantee font-sm">
                                <span>گارانتی</span>
                                <span><?= $basket['guaranteeName']?></span>
                            </p>
                        </div>
                    </div>
                </td>
                <td>
                    <select name="">
                        <!-- class="selectpicker"-->
                        <?php

                        for ($i = 1; $i < 11; $i++) {
                            if ($basket['count'] == $i) {
                                $x='selected';
                            }else{
                                $x='';
                            }
                            ?>
                            <option value="<?php echo $i; ?>" <?php echo $x;?>
                                    onclick="updateBasket(<?= $basket['basketId'] ?>,<?= $i; ?>)"><?= $i; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                </td>
                <td>
                    <p><?php echo $basket['price']; ?></p>
                </td>
                <td>
                    <p><?php echo $basket['price'] * $basket['count']; ?></p>
                </td>
                <td style="background:#c7a3a5; cursor: pointer;"
                    onclick="removeBasket(<?php echo $basket['basketId'] ?>)">
                    <p class="remove-icon-table"></p>
                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>

    </table>
</div>

<?php
$basketItems = $data['totalPrice'];
?>
<div class="card-third-part">
    <div class="right">
        <a href="" class="returnBtn">
            بازگشت به صفحه ی قبل
        </a>
    </div>
    <div class="left">
        <table>
            <tr>
                <td>جمع کل خرید :</td>
                <td>
                    <span style="display: inline-block;padding: 6px;" class="totalPrice"><?= $basketItems; ?></span>
                    <span>تومان</span>
                </td>
            </tr>
            <tr style="background:rgba(144,238,144,0.17); color: #247f0c;">
                <td>مبلغ قابل پرداخت شما :</td>
                <td>
                    <span class="font-lg totalPrice2"><?= $basketItems ?></span>
                    <span>تومان</span>
                </td>
            </tr>
        </table>
        <a href="showCart1" class="select_transport">خرید خود را نهایی کنید</a>
        <p class="notation">بر اساس آدرس وارد شده امکان افزوده شدن هزینه وجود دارد.</p>
    </div>
</div>

<script>
    function removeBasket(basketId) {
        var url = 'showCart/removeBasketItem/' + basketId;
        var data = {};
        var result ='';
        var totalPrice ='';
        $.post(url, data, function (msg) {
            result = msg[0];
            totalPrice = msg[1];
            $('.basketTable tbody tr').remove();
                $.each(result, function (index, value) {
                    var trTag = "<tr><td><div class='first-col-cart'><div class='img'><img src='public/main-images/products/"+value['id']+"/product_220.jpg' alt=''></div><div class='content'><p class='product-name'>"+value['title']+"</p><p class='product-model font-sm '>Schwan 903 Steering Wheel Lock</p><p class='product-color'><span>رنگ</span><span class='palette-color' style='background: "+value['hex']+";'></span><span class='pallet-name'>"+value['colorName']+"</span></p><p class='product-guarantee font-sm'><span>گارانتی</span><span>"+value['guaranteeName']+"</span></p></div></div></td><td><select name=''><option value='"+value['count']+"' onclick='updateBasket("+value['basketId']+","+value['count']+")'>"+value['count']+"</option></select></td><td><p>"+value['price']+"</p></td><td><p>"+value['price']*value['count']+"</p></td><td style='background:#c7a3a5; cursor: pointer;'onclick='removeBasket("+value['basketId']+")'><p class='remove-icon-table'></p></td></tr>";

                    $('.basketTable tbody').append(trTag);
                });

            $('.totalPrice').text(totalPrice);
            $('.totalPrice2').text(totalPrice);
            console.log(msg);
        },'json');

    }















    function printTR(msg, totalPrice) {
        $('.basketTable tbody tr').remove();
        $.each(msg, function (index, value) {
            var trTag = "<tr><td><div class='first-col-cart'><div class='img'><img src='public/main-images/products/"+value['id']+"/product_220.jpg' alt=''></div><div class='content'><p class='product-name'>"+value['title']+"</p><p class='product-model font-sm '>Schwan 903 Steering Wheel Lock</p><p class='product-color'><span>رنگ</span><span class='palette-color' style='background: "+value['hex']+";'></span><span class='pallet-name'>"+value['colorName']+"</span></p><p class='product-guarantee font-sm'><span>گارانتی</span><span>"+value['guaranteeName']+"</span></p></div></div></td><td><select name=''><option value='"+value['count']+"' onclick='updateBasket("+value['basketId']+","+value['count']+")'>"+value['count']+"</option></select></td><td><p>"+value['price']+"</p></td><td><p>"+value['price']*value['count']+"</p></td><td style='background:#c7a3a5; cursor: pointer;'onclick='removeBasket("+value['basketId']+")'><p class='remove-icon-table'></p></td></tr>";
        $('.basketTable tbody').append(trTag);
        });
        $('.totalPrice').text(totalPrice);
        $('.totalPrice2').text(totalPrice);
    }












    function updateBasket(basketId, count) {
        var url = 'showCart/updateBasket/';
        var data = {basketId: basketId, count: count};
        $.post(url, data, function (msg) {

            var result = msg[0]; // array
            var totalPrice = msg[1]; //number
            console.log(result);
            $('.basketTable tbody tr').remove();
            $.each(result, function (index, value) {
                // var trTag = "<tr><td><div class='first-col-cart'><div class='img'><img src='public/main-images/products/" + value['id'] + "/product_220.jpg' alt=''></div><div class='content'><p class='product-name'>" + value['title'] + "</p><p class='product-model font-sm '>Schwan 903 Steering Wheel Lock </p><p class='product-color'><span>رنگ</span><span class='palette-color'></span><span class='pallet-name'>"+value['colorName']+"</span></p><p class='product-guarantee font-sm'> <span>گارانتی</span> <span>"+value['guaranteeName']+"</span></p></div></div></td><td><select name=''><option value='" + value['count'] + "' onclick='updateBasket(" + value['basketId'] + "," + value['count'] + ")'>" + value['count'] + "</option></select></td><td><p>" + value['price'] + "</p></td><td><p>" + value['price']*value['count'] + "</p></td><td style='background:#c7a3a5; cursor: pointer;' onclick='removeBasket(" + value['basketId'] + ")'><p class='remove-icon-table'></p></td></tr>";
                var trTag = printTR(result,totalPrice);
                $('.basketTable tbody').append(trTag);
            });
            $('.totalPrice').text(totalPrice);
            $('.totalPrice2').text(totalPrice);
            // console.log(result);
        }, 'json');
    }
</script>