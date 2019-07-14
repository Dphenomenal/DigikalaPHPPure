
<div id="main">
    <div class="boxes">
        <?php require ('userContent.php')?>
        <div class="cart-header">
            <h4>سبد خرید شما در دیجیکالا</h4>
            <a href="" class="select_transport">ادامه ی خرید</a>
        </div>
        <?php require ('cart-product.php')?>
        <?php require ('card-third-part.php')?>

        <style>
            .sendingInformation{
                width: 1100px;
                display: table;
                margin:40px auto 50px;
            }
            .sendingInformation table{
                width: 100%;
                float: right;
                border: 1px solid #eeeeee;
            }
            .sendingInformation table tr:first-child{
                border-bottom: 1px solid #eeeeee;
            }
            .sendingInformation table tr td{
                padding: 5px 10px;
                height: 60px;
            }
            .sendingInformation table tr td:first-child{
                width: 50px;
                border-left: 1px solid #eeeeee;
            }
            .sendingInformationLocation,.sendingInformationPrice{
                width: 31px;
                height: 23px;
                display: block;
                margin: auto;
            }
            .sendingInformationLocation{
                background: url("public/main-images/slices.png") -805px -204px no-repeat ;
            }
            .sendingInformationPrice{
                background: url("public/main-images/slices.png") -805px -246px no-repeat ;
            }
            .edit_transport{
                background: #008000;
                padding: 10px 10px;
                font-family: B-yekan, Vazir, sans-serif;
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                border-radius: 4px;
                box-shadow: 1px 1px 5px #aaaaaa;
                color: #FFFFFF;

            }
            .edit_transport:hover{
                color: #FFFFFF;
            }
        </style>
        <?php require ('sendingInformation.php')?>
        <div class="cart-header">
            <a href="showCart4" class="select_transport">ادامه ی خرید</a>
            <a href="showCart2" class="edit_transport">ویرایش</a>
        </div>
    </div>
</div>


