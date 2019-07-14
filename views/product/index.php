<?php
$result = $data[0];
/*echo '<pre>';
var_dump($result);
echo '</pre>';*/
$timer = $data[1];
$onlyDigikala = $data[2];
?>
<div id="behindGallery">
   <?php require ('galleryBox.php')?>
</div>
<div id="product_main">
    <div class="registerMainُSearch">
   <?php require ('aboutProduct.php')?>
    </div>
   <?php require ('productDescription.php')?>
    <div class="productSliderPage">
   <?php require ('product_slider.php')?>
    </div>
    <div id="tabs">
        <ul>
            <li>
                <span class="CriticismIcon"></span>
                نقد و بررسی تخصصی
            </li>
            <li>
                <span class="TechnicalIcon"></span>
                مشخصات فنی
            </li>
            <li>
                <span class="CommentsIcon"></span>
                نظرات کاربران
            </li>
            <li>
                <span class="QuestionIcon"></span>
                پرسش و پاسخ
            </li>
        </ul>
        <div class="content">
            <section>
            </section>
            <section>
            </section>
            <section>
            </section>
            <section>
            </section>
            <?php
             /*require ('select1.php');
             require ('select2.php');
             require ('select3.php');
             require ('select4.php');*/
             ?>
        </div>
    </div>
</div>

<script src="public/js_files/jquery-3.3.1.min.js"></script>
<script>
    /** tabs product page**/
    var tabLi = $('#tabs > ul > li');
    tabLi.click(function () {
        var currentLiItem = $(this).index();

        $('#tabs ul li').removeClass('tabActive');
        $(this).addClass('tabActive');
        $(this).parents('#tabs').find('.content section').fadeOut(0);
        var url = "<?php echo URL?>product/tab/<?php echo $result['id']?>/<?php echo $result['cat_id']?>";
        var data = {'index':currentLiItem};
        /*$.post(url,data,function (msg,status) {
            alert(msg);
        });*/
        $.post(url,data,function (msg) {
            tabLi.parents('#tabs').find('.content section').eq(currentLiItem).html(msg);
        });
        $(this).parents('#tabs').find('.content section').eq(currentLiItem).fadeIn(500);
    });

</script>