<?php
$result = $data[0];

?>
    <h4>
        <span class="sectionIcon"></span>
        نقد و بررسی تخصصی دیجیکالا
    </h4>
    <div class="section_content">
        <ul>
            <?php
             foreach ($result as $data){
                 ?>
                 <li class="middleClass">
                     <?php echo $data['title']?>
                     <div class="liContent">
                         <p>
                             <?php echo $data['description']?>
                         </p>
                     </div>
                 </li>
                 <?php
             }
            ?>


        </ul>
    </div>
    <script>
        /** tab1 content**/
        $('.content section .section_content > ul > li').click(function () {
            // alert('Hello');
            $(this).toggleClass('liContentActive');
        });
    </script>