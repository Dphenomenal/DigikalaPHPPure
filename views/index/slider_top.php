<div id="slider_top">
    <div class="slider_img">
        <div class="arrow_right"></div>

        <div class="arrow_left"></div>
        <?php
        $slider_top = $data[0];
        foreach ($slider_top as $d){
            ?>
            <a class="item" href="<?php echo $d['link']?>"><img alt="" src="<?php echo $d['img']?>"></a>
        <?php
        }?>
    </div>
    <div class="slider_nav">
        <ul>
            <?php foreach ($slider_top as $d){
                ?>
                <li>
                    <a class="font-B-Yekan font-me"><?php echo $d['title']?></a>
                </li>
                <?php
            }?>
        </ul>
    </div>
</div>
