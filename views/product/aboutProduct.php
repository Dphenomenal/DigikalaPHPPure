<?php
/*echo '<pre>';
var_dump($result['guarantee_info']);
echo '</pre>';
die();*/
?>
<div class="aboutProduct">

    <?php if ($result['special'] == 1) {
        ?>
        <div class="specialOffer">
            <div class="timer_slider">
                <div class="example">
                    <div class="hours"></div>
                    <div class="minutes"></div>
                    <div class="seconds"></div>
                </div>
            </div>
            <div class="discount">
                <div class="price">
                    <p class="font-B-Yekan font-xs priceText">هزار تومان</p>
                    <p class="font-B-Yekan number"><?php echo $result['discount_price']; ?></p>
                </div>
                <div class="text font-B-Yekan font-sm">
                    تخفیف
                </div>
            </div>
        </div>
        <?php
    };
    ?>
    <script src="public/js_files/jquery-3.3.1.min.js"></script>
    <script src="public/FlipTimer/js/jquery.flipTimer.js"></script>
    <script>
        $('.afterTimeOutSlider2').fadeOut();
        $('.example').flipTimer({
            direction: 'down',
            date: '<?php echo $timer;?>',
            days: false,
            callback: function () {
                $('.afterTimeOutSlider2').fadeIn();
            }
        });
    </script>

    <div class="productSection">
        <?php
        $gallery = $data[3];
        /*var_dump($gallery);
        die();*/
        ?>
        <div class="right">
            <div class="social">
                <p class="share"></p>
                <p class="like"></p>
            </div>
            <div class="product-img">
                <img id="zoom" src="public/main-images/products/<?php echo $result['id'] ?>/product_350.jpg" alt=""
                     data-zoom-image="public/main-images/products/<?php echo $result['id'] ?>/product.jpg">
                <div class="gallery">
                    <ul>
                        <?php for ($i = 0; $i < 4; $i++) {
                            ?>
                            <li data-src="public/main-images/products/<?= $gallery[$i]['idproduct']; ?>/gallery/large/<?= $gallery[$i]['img'] ?>">
                                <img src="public/main-images/products/<?= $gallery[$i]['idproduct']; ?>/gallery/small/<?= $gallery[$i]['img'] ?>"
                                     alt=""></li>
                            <?php
                        } ?>
                        <li class="tripleDot" data-src="public/"><i class="tripleDot"></i></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="left">
            <div class="titleHeader">
                <div class="title">
                    <h3 class="font-B-Yekan">Apple iphone5s-16GB mobile phone</h3>
                    <p class="font-B-Yekan font-sm">گوشی موبایل لنوو مدلVIBE shot دوسیم کارت</p>
                </div>
                <div class="stars">
                    <span class="starItemsGray"></span>
                    <p class="font-B-Yekan">4 رای از 84 رای</p>
                </div>
            </div>
            <div class="detail">
                <div class="right">
                    <div class="selectColor">
                        <p class="font-B-Yekan font-sm">انتخاب رنگ</p>
                        <div class="colors">
                            <?php
                            $colors_info = $result['colors_info'];
                            //                            foreach ($colors_info as $color_info){
                            //                               $id = $color_info['id']
                            for ($i = 0; $i < sizeof($colors_info); $i++) {
                                ?>
                                <div class="colorItem font-B-Yekan font-sm">
                                    <div class="text font-B-Yekan font-sm"><?php echo $colors_info[$i]['name']; ?></div>
                                    <span class="tick" data-color="<?php echo $colors_info[$i]['id']; ?>"
                                          style="background: <?php echo $colors_info[$i]['hex']; ?>;"></span>
                                </div>
                                <?php
                            }
                            ?>
                        </div>


                    </div>
                    <div class="guarantee">
                        <p class="font-B-Yekan font-sm">
                            انتخاب گارانتی
                        </p>
                        <div class="selectBar">
                                 <span class="currentShowItem font-B-Yekan font-sm">
                                 گارانتی خودرا انتخاب کنید
                                 </span>
                            <ul>
                                <?php
                                $guarantee_info = $result['guarantee_info'];
                                foreach ($guarantee_info as $guaranteeInfo) {
                                    ?>
                                    <li class="guaranteeItem"
                                        data-id="<?= $guaranteeInfo['id'] ?>"><?php echo $guaranteeInfo['name']; ?></li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                    <div class="price">
                        <div class="rightCol">
                            <p>قیمت:</p>
                            <del><?php echo $result['price'] ?></del>
                            <p>تومان</p>
                        </div>
                        <div class="leftCol">
                            <div class="disC">تخفیف</div>
                            <div class="leftDisc">
                                <span><?php echo $result['discount_price'] ?></span><span>هزار تومان</span></div>
                        </div>
                    </div>
                    <div class="lastPrice">
                        <p><i class="lastPrice_icon"></i></p>
                        <p class="lastPrice_text font-B-Yekan font-me">
                            قیمت برای شما :
                        </p>
                        <div class="lastPrice_price">
                            <p class="number"><?php echo $result['total_price'] ?></p>
                            <p class="font-B-Yekan font-xs">تومان</p>
                        </div>
                    </div>
                    <div class="saleBtn">
                        <div class="compare"><a href="" class="compare_a">مقایسه کن</a><span
                                    class="compare_icon"></span></div>
                        <div class="basket"><span class="basket_icon"></span><a class="basket_a" style="cursor: pointer;" onclick="productToBasket(<?= $result['id'] ?>)">افزودن
                                به سبد خرید</a>
                        </div>
                        <script>
                            var guarantee_selected = 0;

                            function productToBasket(idProduct) {
                                var color = $('.colorItem').find('.tick.cActive').attr('data-color');
                                var url = 'product/addBasket/' + idProduct + '/' + color + '/' + guarantee_selected;
                                var data = {};
                                $.post(url, data, function (msg) {
                                    alert(msg);
                                });
                            }
                        </script>
                    </div>
                </div>
                <div class="left">
                    <div class="top font-B-Yekan font-sm">
                        <ul style="list-style-type: circle">
                            <li style="list-style-type: disc;color: #999999">سیستم عامل : Android</li>
                            <li style="list-style-type: disc;color: #999999">ظرفیت حافظه داخلی : 64 گیگابایت
                            </li>
                        </ul>
                    </div>
                    <div class="bottom">
                        <div class="top_row">
                            <p class="present_icon"></p>
                            <p class="font-B-Yekan font-sm"
                               style="border-bottom: 1px solid #999999;padding-bottom: 10px;width: 150px; color: #999999">
                                هدایای همراه این کالا
                            </p>
                        </div>
                        <div class="bottom_row">
                            <p class="font-B-Yekan font-sm" style="color: #999999">کارت اشتراک 1 ماه
                                تلویزیون
                            </p>
                            <p class="font-B-Yekan font-sm" style="color: #999999">اینترنتی irangate TV |
                                گارانتی اصالت
                            </p>
                            <p class="font-B-Yekan font-sm" style="color: #999999">و سلامت فیزیکی</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="transfer_feature" class="marginB-me">
            <ul>
                <li>
                    <p class="font-B-Yekan font-sm">7 روز ضمانت بازگشت</p>
                    <span class="Warranty-return-icon"></span>
                </li>
                <li>
                    <p class="font-B-Yekan font-sm">ضمانت اصل بودن کالا</p>
                    <span class="Warranty-org-icon"></span>
                </li>
                <li>
                    <p class="font-B-Yekan font-sm">تضمین بهترین قیمت</p>
                    <span class="Warranty-best-icon"></span>
                </li>
                <li>
                    <p class="font-B-Yekan font-sm">پرداخت در محل</p>
                    <span class="pay-icon"></span>
                </li>
                <li>
                    <p class="font-B-Yekan font-sm">تحویل اکسپرس</p>
                    <span class="Delivery-icon"></span>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
    $('.selectColor .colors > .colorItem').click(function () {
        $(this).parents('.colors').find('.tick').removeClass('cActive');
        $('> .tick', this).addClass('cActive');
    });
    $('.currentShowItem').click(function () {
        $(this).parents('.selectBar').find('ul').slideToggle(200);
    });
    $('.selectBar ul > li').click(function () {
        guarantee_selected = $(this).attr('data-id');
        var value = $(this).text();
        $(this).parents('.selectBar').find('.currentShowItem').html(value);
        $(this).parents('.selectBar').find('ul').slideUp(200);
    });
</script>