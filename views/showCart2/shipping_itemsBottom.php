<?php
 $transportData = $data['transportData'];
?>
<div class="shipping_items">
    <div class="header">
        <h4>شیوه ی ارسال</h4>
    </div>
    <div class="transportationStates">

        <?php foreach ($transportData as $tData){
            ?>
            <table class="transformation_table">
                <tr>
                    <td style="position: relative; width: 70px;border-left: 1px solid #eeeeee;">
                        <span class="circleEmpty">
                        <span class="circleSmall"></span>
                        </span>
                    </td>
                    <td style="width: 900px;height: 73px;">
                        <p class="transportationStatesIcon" style="float: right;"></p>
                        <p class="font-B-Yekan font-sm" style="float: right;width: 700px;margin-right: 37px;"><?= $tData['title']?></p>
                        <p class="font-B-Yekan font-sm" style="color: #999999;float: right; margin-right: 35px;margin-top: 3px;" >
                            <?= $tData['description']?>
                        </p>
                    </td>
                    <td style="border-right: 1px solid #eeeeee;">
                        <p style="text-align: center">هزینه ی ارسال</p>
                        <p style="text-align: center; color: darkgreen;">رایگان</p>
                    </td>
                </tr>
            </table>
            <?php
        }?>
        <div class="btnBox">
            <a href="showCart" class="returnBack">بازگشت به سبد خرید</a>
            <a href="showCart3" class="goToNextPage">ثبت اطلاعات و ادامه خرید</a>
        </div>
    </div>
</div>


<script>
    $('.transformation_table').find('td:first-child').click(function () {
        $('.transformation_table').removeClass('active');
        $(this).parents('.transformation_table').addClass('active');
    });
</script>