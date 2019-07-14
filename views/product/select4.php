<?php
$questions = $data[0];
$answers = $data[1];
/*echo '<pre>';
var_dump($answers);
echo '</pre>';
die();*/
?>
    <div class="section_content1">
        <h4>
            <span class="sectionIcon"></span>
            پرسش خود را مطرح کنید
        </h4>
        <style>
        </style>
        <div class="content">
            <div class="right">
                <form action="">
                    <textarea name="" id="" placeholder="متن پرسسش خود را اینجا بنویسید..."></textarea>
                    <input type="submit" value="ارسال کنید" class="font-B-Yekan font-me">
                    <label class="checkboxOn" for="reg_ch2">
                        <span class="onCheckbox"></span>
                        <input type="checkbox" class="behindCheck" id="reg_ch2">
                        <p class="font-B-Yekan font-sm">وقتی ثروت‌های بزرگ به دست برخی مردم می‌افتد در پرتو
                            آن نیرومند می‌شوند و در سایهٔ نیرومندی و ثروت خیال می‌کنند که می‌توانند در خارج
                            از وطن خود زندگی نمایند و خوشبخت و سرافراز باشند
                        </p>
                    </label>
                </form>
            </div>
            <div class="commentsProductPage">
                <div class="right">
                    <h3>
                        پرسش ها و پاسخ ها
                        <span class="font-xs">
                                 ( 850 نظر )
                                 </span>
                    </h3>
                </div>
                <div class="left">
                    <p class="font-B-Yekan font-me">مرتب سازی بر اساس :</p>
                    <ul class="font-B-Yekan font-sm">
                        <li>جدیدترین پرسش</li>
                        <li>مفیدترین پرسش</li>
                    </ul>
                </div>
            </div>

            <?php foreach ($questions as $question){
                ?>
                <div class="someComments">
                    <div class="header">
                        <div class="right">
                            <div class="title">
                                <h4 class="font-B-Yekan">سجاد سرحدی <span
                                            style="color: #ff0000;"> خریدار این محصول </span></h4>
                                <p class="font-B-Yekan font-xs"><?= $question['tarikh']?></p>
                            </div>
                        </div>
                    </div>
                    <div class="content">
                        <p class="font-B-Yekan font-sm"><?= $question['matn']?></p>
                    </div>
                </div>
            <?php
                if (isset($answers[$question['id']])){
                    ?>
                    <div class="commentAnswer">
                        <div class="header">
                            <div class="right">
                                <div class="title">
                                    <h4 class="font-B-Yekan">سجاد سرحدی </h4>
                                    <p class="font-B-Yekan font-xs">23 تیر 1395</p>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <p class="font-B-Yekan font-sm"><?= $answers[$question['id']]['matn']?></p>
                        </div>
                    </div>
            <?php
                }
            }?>
           <!-- <div class="someComments">
                <div class="header">
                    <div class="right">
                        <div class="title">
                            <h4 class="font-B-Yekan">سجاد سرحدی <span
                                    style="color: #ff0000;"> خریدار این محصول </span></h4>
                            <p class="font-B-Yekan font-xs">23 تیر 1395</p>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <p class="font-B-Yekan font-sm">وقتی ثروت‌های بزرگ به دست برخی مردم می‌افتد در پرتو آن نیرومند می‌شوند و در سایهٔ نیرومندی و ثروت خیال می‌کنند که می‌توانند در خارج از وطن خود زندگی نمایند و خوشبخت و سرافراز باشند</p>
                </div>
            </div>
            <div class="commentAnswer">
                <div class="header">
                    <div class="right">
                        <div class="title">
                            <h4 class="font-B-Yekan">سجاد سرحدی <span
                                        style="color: #ff0000;"> خریدار این محصول </span></h4>
                            <p class="font-B-Yekan font-xs">23 تیر 1395</p>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <p class="font-B-Yekan font-sm">وقتی ثروت‌های بزرگ به دست برخی مردم می‌افتد در پرتو آن نیرومند می‌شوند و در سایهٔ نیرومندی و ثروت خیال می‌کنند که می‌توانند در خارج از وطن خود زندگی نمایند و خوشبخت و سرافراز باشند</p>
                </div>
            </div>
            <div class="someComments">
                <div class="header">
                    <div class="right">
                        <div class="title">
                            <h4 class="font-B-Yekan">سجاد سرحدی <span
                                    style="color: #ff0000;"> خریدار این محصول </span></h4>
                            <p class="font-B-Yekan font-xs">23 تیر 1395</p>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <p class="font-B-Yekan font-sm">وقتی ثروت‌های بزرگ به دست برخی مردم می‌افتد در پرتو آن نیرومند می‌شوند و در سایهٔ نیرومندی و ثروت خیال می‌کنند که می‌توانند در خارج از وطن خود زندگی نمایند و خوشبخت و سرافراز باشند</p>
                </div>
            </div>
            <div class="someComments">
                <div class="header">
                    <div class="right">
                        <div class="title">
                            <h4 class="font-B-Yekan">سجاد سرحدی <span
                                    style="color: #ff0000;"> خریدار این محصول </span></h4>
                            <p class="font-B-Yekan font-xs">23 تیر 1395</p>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <p class="font-B-Yekan font-sm">وقتی ثروت‌های بزرگ به دست برخی مردم می‌افتد در پرتو آن نیرومند می‌شوند و در سایهٔ نیرومندی و ثروت خیال می‌کنند که می‌توانند در خارج از وطن خود زندگی نمایند و خوشبخت و سرافراز باشند</p>
                </div>
            </div>-->
        </div>
    </div>
