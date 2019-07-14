<?php
    $address = $data['address'];
    $postId = $data['postId'];
    $totalPrice = $data['totalPrice'];
    $postPrice =$data[1];
    $totalPriceDiscount =$data['totalPriceDiscount'];
//    echo '<pre>';
//    var_dump($address);
//    echo '</pre>';

?>
<div class="sendingInformation">
    <h4 class="font-B-Yekan">اطلاعات ارسال سفارش</h4>
    <table>
        <tr>
            <td>
                <span class="sendingInformationLocation"></span>
            </td>
            <td class="font-B-Yekan font-sm">
                <p>نام شما : <?= $address[0]['family']?></p>
                <p>موقعیت مکانی شما : <?= $address[0]['address']?></p>
            </td>
        </tr>
        <tr>
            <td>
                <span class="sendingInformationPrice"></span>
            </td>
            <td class="font-B-Yekan font-sm">
                <p>
                <?php
                 if ($postId == 1){
                     echo 'پیشتاز';
                 }else{
                     echo 'سفارشی';
                 }
                ?>
                </p>
                <p>
                    با قیمت : <?= ( $totalPrice + $postPrice ) - $totalPriceDiscount?>
                </p>
            </td>
        </tr>
    </table>
</div>