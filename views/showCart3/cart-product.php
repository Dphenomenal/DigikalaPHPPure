<?php
$baskets = $data['basket'];
?>
<div class="cart-product">

    <table cellspacing="0">
        <tr>
            <td>شرح محصول</td>
            <td>تعداد</td>
            <td>قیمت واحد</td>
            <td>قیمت کل</td>
            <td></td>
        </tr>
        <?php
        foreach ($baskets as $basket) {
            ?>
            <style>
                .cart-product > table > tbody > tr .content .palette-color {
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
            <tr>
                <td>
                    <div class="first-col-cart">
                        <div class="img">
                            <img src="public/main-images/products/<?= $basket['id']; ?>/product_220.jpg" alt="">
                        </div>
                        <div class="content">
                            <p class="product-name">
                                <?= $basket['title']; ?>
                            </p>
                            <p class="product-model font-sm ">
                                Schwan 903 Steering Wheel Lock
                            </p>
                            <p class="product-color">
                                <span>رنگ</span><span class="palette-color"
                                                      style="background: <?= $basket['hex'] ?>"></span><span
                                        class="pallet-name"><?= $basket['colorName']; ?></span>
                            </p>
                            <p class="product-guarantee font-sm">
                                <span>گارانتی</span>
                                <span><?= $basket['guaranteeName']; ?></span>
                            </p>
                        </div>
                    </div>
                </td>
                <td>
                    <?= $basket['count']; ?>
                </td>
                <td>
                    <p><?= $basket['price']; ?></p>
                </td>
                <td>
                    <p><?= $basket['price'] * $basket['count']; ?></p>
                </td>
                <td style="background:#2938a8;cursor: pointer;" class="returnShowCart">
                    <a href="showCart" class="remove-turn-back-table"></a>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
</div>

