<div class="product_slider">
    <h3 class="font-B-Yekan font-sm">فقط در دیجیکالا</h3>
    <div class="product_slider_content">
        <div class="slider_arrowR">
            <span onclick="showSliderProduct('right',this)"></span>
        </div>

        <div class="slider_contentP">
            <ul>
                <?php
                $slider_contentP = $data[3];
                foreach ($slider_contentP as $slider_contentPItem){
                    ?>
                    <li>
                        <a class="product_item" href="<?php echo URL;?>product/index/<?php echo $slider_contentPItem['id'];?>">
                            <p class="product_slider_img"><img alt="" src="public/main-images/products/<?php echo $slider_contentPItem['id']?>/product_220.jpg"></p>
                            <p><img alt="" src="public/main-images/exclusive-blue.png"></p>
                            <p class="product_slider_title font-B-Yekan font-sm"><?php echo $slider_contentPItem['title']?></p>
                            <p class="product_slider_price font-B-Yekan font-sm"><?php echo $slider_contentPItem['price']?><span class="font-sm">تومان</span></p></a>
                    </li>
                <?php
                }
                ?>
            </ul>
        </div>
        <div class="slider_arrowL">
            <span onclick="showSliderProduct('left',this)"></span>
        </div>
    </div>
</div>

