<?php
$commentInfo = $data[0];
$commentParams = $data[1];
$average = $data[2];
$j=1;
/*echo  round($average[$j],2);
echo "<pre>";
var_dump($average);
echo "</pre>";
die();*/
?>


    <div class="section_content1">
        <div class="rightColumn">
            <h4>
                <span class="sectionIcon"></span>
                امتیاز کاربران به
                <p class="font-B-Yekan font-sm" style="color: #999999;">
                    Apple iphone5s-16GB mobile phone
                </p>
            </h4>
            <?php
                foreach ($commentParams as $param){
                   /* echo '<pre>';
                    var_dump($average);
                    echo '</pre>';
                    die();*/
                    ?>
                    <div class="eachItem">
                        <p class="font-B-Yekan font-sm"><?= $param['title'];?></p>
                        <ul>
                            <?php
                                $all_columns = 5;
                                $all_columns_withoutColor = 0;
                                $eachItem = $average[$j];
                                $intVal = floor($eachItem);
                                $current_column = $intVal;
                                $floatVal = $eachItem - $intVal;
                                $floatVal = round($floatVal,2);
                                for ($i = 0;$i<$intVal;$i++){
                                    ?>
                                    <li>
                                        <span class="full" style="height: 100%"></span>
                                    </li>
                            <?php
                                }
                            for ($i = 0;$i<$floatVal;$i++){
                                $current_column++;
                                ?>
                                <li>
                                    <span style="width:<?= $floatVal*100?>%!important;height: 100%;"></span>
                                </li>
                            <?php
                            }
                            $all_columns_withoutColor = $all_columns - $current_column;
                            for ($k=0;$k<$all_columns_withoutColor;$k++){
                                ?>
                                <li>

                                </li>
                            <?php
                            }

                            ?>

                        </ul>
                    </div>
                    <?php
                $j++;
                }
            ?>
        </div>
        <div class="leftColumn">
            <a href="" class="submit">نظر خود را بنویسید</a>
            <div class="stepOne">
                <p>5 / 4.3</p>
                <div class="stars">
                    <span class="starItemsGray"></span>
                    <!--<span class="starItemsRed"></span>-->
                </div>
                <p>( 1234 نفر )</p>
            </div>
            <h3 class="font-B-Yekan font-me">
                شما هم میتوانید در مورد این کالا نظر بدهید
            </h3>
            <p class="font-B-Yekan font-sm" style="color: #999999;">
                لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی
                تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
            </p>
        </div>
    </div>
    <div class="commentsProductPage">
        <div class="right">
            <h3>
                نظرات کاربران
                <span class="font-xs">
                           ( 850 نظر )
                           </span>
            </h3>
        </div>
        <div class="left">
            <p class="font-B-Yekan font-me">مرتب سازی بر اساس :</p>
            <ul class="font-B-Yekan font-sm">
                <li>جدیدترین نظرات</li>
                <li>مفیدترین نظرات</li>
            </ul>
        </div>
    </div>

    <?php
        foreach ($commentInfo as $comment){
            ?>
            <div class="someComments">
                <div class="header">
                    <div class="right">
                        <div class="icon"></div>
                        <div class="title">
                            <h4 class="font-B-Yekan">سجاد سرحدی <span
                                        style="color: #ff0000;"> خریدار این محصول </span></h4>
                            <p class="font-B-Yekan font-xs"><?= $comment['cDate']?></p>
                        </div>
                    </div>
                    <div class="left">
                        <div class="like_dislike">
                            <div class="like">
                                <div class="number"><?= $comment['cLike']?></div>
                                <div class="like_icon"></div>
                            </div>
                            <div class="dislike">
                                <div class="number"><?= $comment['cDislike']?></div>
                                <div class="dislike_icon"></div>
                            </div>
                        </div>
                        <p>آیا این نظر برایتان مفید بود؟</p>
                    </div>
                </div>
                <div class="content">
                    <div class="right">
                        <h5>خرید این کالا را حتما پیشنهاد میکنم</h5>
                        <div class="section_content1">
                            <div class="rightColumn">
                                <?php
                                $rate = $comment['rateParam'];
                                $rate = unserialize($rate);
                                foreach ($commentParams as $param) {
                                    $param_id = $param['id'];
                                    $score = $rate[$param_id];
                                    ?>
                                    <div class="eachItem">
                                        <p class="font-B-Yekan font-sm">ارزش خرید به نسبت قیمت </p>
                                        <ul>
                                            <?php
                                            for ($i = 0; $i < $score;$i++){
                                                ?>
                                                <li>
                                                    <span></span>
                                                </li>
                                            <?php
                                            }
                                            for ($i = 0; $i < 5-$score;$i++){
                                            ?>
                                            <li>
                                            </li>
                                            <?php
                                        }
                                        ?>
                                        </ul>
                                    </div>

                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="left">
                        <h5><?= $comment['title']?></h5>
                        <div class="points">
                            <div class="positivePoint">
                                <h5 style="color: #006b00;">نقاط مثبت</h5>
                                <p class="font-B-Yekan font-sm" style="color: #006b00;">[" <?= $comment['positive']?> "]</p>
                            </div>
                            <div class="negativePoint">
                                <h5 style="color: #ff0000;">نقاط منفی</h5>
                                <p class="font-B-Yekan font-sm" style="color: #ff0000;">[" <?= $comment['negative']?> "]</p>
                            </div>
                            <p class="text font-B-Yekan font-sm" style="color: #999999;">
                                <?= $comment['description']?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    ?>

