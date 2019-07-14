<div id="slider_second">
    <div class="ifTimerDone afterTimeOutSlider2 font-B-Yekan">
        تمام شد!
    </div>
    <div class="sliderTop_content">
        <div class="timer_slider">
            <p class="font-B-Yekan font-me">فرصت باقی مانده تا این پیشنهاد</p>
            <div class="example">
                <!--<div class="days"></div>-->
                <div class="hours"></div>
                <div class="minutes"></div>
                <div class="seconds"></div>
            </div>
        </div>


        <?php
        $slider2_items = $data[1];
        $special_time = $data[2];
        foreach ($slider2_items as $data11){
            ?>
            <a class="slider2_items" href="<?php echo URL;?>product/index/<?php echo $data11['id'];?>">
                <div class="sliderTop_content_right">
                    <p class="sliderTop_content_right_header font-B-Yekan font-sm">جشنواره ماه نو</p>
                    <div class="sliderTop_content_right_price">
                        <div class="Discount_div font-B-Yekan font-me">
                            <?php echo $data11['price']?> <span class="slash"></span>
                        </div>
                        <div class="price_div font-B-Yekan font-me">
                            <?php echo $data11['total_price']?> هزار تومان
                        </div>
                    </div>
                    <div class="features">
                        <p class="font-B-Yekan font-sm">ظرفیت دیگ : 3.5 کیلوگرم</p>
                        <p class="font-B-Yekan font-sm">صفحه نمایش : ندارد</p>
                        <p class="font-B-Yekan font-sm">طبقه بندی رنگ : ساده</p>
                    </div>
                </div>
                <div class="sliderTop_content_left">
                    <p class="font-B-Yekan font-me"><?php echo $data11['title']?></p><img alt=""
                                                                                 src="<?php echo $data11['img'].'/'.$data11['id'].'/product_220.jpg'?>">
                </div>
            </a>
        <?php
        }?>
    </div>
    <div class="sliderTop_nav">
        <ul>
            <?php
            foreach ($slider2_items as $data12){
                ?>
                <li>
                    <a class="font-B-Yekan font-sm"><?php echo $data12['title']?></a>
                </li>
               <?php
            }
            ?>
        </ul>
    </div>
</div>

<script src="public/js_files/jquery-3.3.1.min.js"></script>
<script src="public/FlipTimer/js/jquery.flipTimer.js"></script>
<script>
    $('.afterTimeOutSlider2').fadeOut();
    $('.example').flipTimer({
        direction: 'down',
        date: '<?php echo $special_time;?>',
        days: false,
        callback: function () {
            $('.afterTimeOutSlider2').fadeIn();
        }
    });
</script>
