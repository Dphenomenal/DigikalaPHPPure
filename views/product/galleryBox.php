<div id="galleryBox">
    <h3><?php echo $result['title'];?></h3>
    <span class="cancel" onclick="closeModal(this)"></span>
    <div id="images_section">
        <div class="right">
            <img src="public/" alt="">
        </div>
        <div class="left">
            <?php $gallery = $data[3];?>
            <ul>
                <?php foreach ($gallery as $itemGallery){
                    ?>
                    <li data-src="public/main-images/products/<?= $itemGallery['idproduct']; ?>/gallery/large/<?= $itemGallery['img'] ?>"><img src="public/main-images/products/<?= $itemGallery['idproduct']; ?>/gallery/small/<?= $itemGallery['img'] ?>" alt=""></li>
                    <?php
                }?>
            </ul>
        </div>
    </div>
</div>