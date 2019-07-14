<?php
$totalPrice = $data['totalPrice'];
$postPrice =$data[1];
$totalPriceDiscount =$data['totalPriceDiscount'];
//echo '<pre>';
//var_dump($totalPriceDiscount);
//echo '</pre>';
?>
<div class="card-third-part">
    <div class="right">

    </div>
    <div class="left">
        <table>
            <tr>
                <td>مبلغ قابل پرداخت شما :</td>
                <td>
                    <span class="font-lg"><?= ( $totalPrice + $postPrice ) - $totalPriceDiscount?></span>
                    <span>تومان</span>
                </td>
            </tr>
            <tr  style="background:rgba(144,238,144,0.17); color: #247f0c;">
                <td>مبلغ پستی :</td>
                <td>
                    <span class="font-lg"><?=$postPrice?></span>
                    <span>تومان</span>
                </td>
            </tr>
            <tr  style="background:rgba(144,238,144,0.17); color: #247f0c;">
                <td>جمع کل تخفیف :</td>
                <td>
                    <span class="font-lg"><?= $totalPriceDiscount; ?></span>
                    <span>تومان</span>
                </td>
            </tr>
            <tr style="background:rgba(144,238,144,0.17); color: #247f0c;">
                <td>جمع کل خرید :</td>
                <td>
                    <span class="font-lg"><?php echo $totalPrice;?></span>
                    <span>تومان</span>
                </td>
            </tr>
        </table>
    </div>
</div>