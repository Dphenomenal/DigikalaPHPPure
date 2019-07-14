<?php
$tab2 = $data[0];

/*echo '<pre>';
var_dump($tab2);
echo '</pre>';
die();*/

?>
<h4>
    <span class="sectionIcon"></span>
    مشخصات فنی
    <p class="font-B-Yekan font-sm" style="color: #999999;">
        Apple iphone5s-16GB mobile phone
    </p>
</h4>
<?php
foreach ($tab2 as $statement){
    $children = $statement['children'];
    ?>

    <div class="section_content1">
        <div class="items">

            <h3><?php echo $statement['name'];?></h3>
            <div class="list">
                <div class="right">
                    <?php
                    foreach ($children as $child){
                    ?>
                    <p><?php echo $child['name']?></p>
                        <?php
                    }
                    ?>
                </div>
                <div class="left">
                    <?php
                    foreach ($children as $child){
                        ?>
                        <p><?php echo $child['value']?></p>
                        <?php
                    }
                    ?>

                </div>
            </div>

        </div>
    </div>
<?php
}
?>


