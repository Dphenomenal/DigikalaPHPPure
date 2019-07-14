<script src="public/js_files/jquery-3.0.0.min.js"></script>
<!--<script src="public/js_files/jquery-3.3.1.min.js"></script>-->
<script src="public/js_files/city.js"></script>
<script src="public/js_files/ostan.js"></script>


<style>
    #textarea {
        resize: none;
        border: 1px solid #888888;
        border-radius: 4px;
        overflow: hidden;
    }
</style>
<div id="behindGallery">
    <div id="galleryBox" style="display: block;">
        <h3>ورود اطلاعات آدرس جدید</h3>
        <span class="cancel" onclick="closeModal(this)"></span>
        <div id="images_section">
            <div class="images_section_form">
                <form action="" method="post" id="addressForm">
                    <label for="">
                        <p>نام و نام خانوادگی تحویل گیرنده</p>
                        <input type="text" name="family">
                    </label>
                    <label for="">
                        <p>شماره تماس ضروری(تلفن همراه)</p>
                        <input type="text" name="phone">
                    </label>
                    <label for="">
                        <p>شماره تماس ثابت</p>
                        <input type="text" name="tel">
                    </label>




                    <label for="" class="any">
                        <p>استان و شهر</p>
                        <select name="state" id="state" class="state">
                        </select>
                        <span class="shahr">
                           <select name="city" id="city" class="city">
                           </select>
                        </span>
                    </label>
                    <script>
                        loadOstan('state');
                        $('#state').change(function () {
                            var i = $(this).find('option:selected').val();
                            ldMenu(i,'city');
                        });
                    </script>

                    <label for="">
                        <p>محله</p>
                        <span class="mahale">
                           <select name="mahale" id="#id3" class="mahale">
                               <option value="anything">یه کدومو انتخاب کنید</option>
                           </select>
                           </span>
                    </label>
                    <label for="">
                        <p>آدرس پستی</p>
                        <textarea name="address" id="textarea" cols="47" rows="8"></textarea>
                    </label>
                    <label for="">
                        <p>کدپستی</p>
                        <input type="text" name="postCode">
                    </label>
                    <label for="">
                        <input type="button" class="btnIgnore" value="انصراف">
                        <!--                    <input type="button" class="btnSave" value="ثبت اطلاعات و بازگشت" onclick="addAddress();">-->
                        <button type="submit" onclick="addAddress();" class="btnSave">ثبت اطلاعات و بازگشت</button>
                    </label>
                </form>
            </div>
            <script>
                var editAddressId = '';

                function addAddress() {
                    var url = 'showCart2/addAddress/' + editAddressId;
                    var data = $('#addressForm').serializeArray();
                    var stateName = $('#state option:selected').text();
                    var cityName = $('#city option:selected').text();
                    // console.log(stateName);
                    // console.log(cityName);
                    data.push({'name': 'city_name', 'value':cityName});
                    data.push({'name': 'state_name', 'value':stateName});
                    console.log(data);

                    $.post(url, data, function (msg) {
                        alert(msg);
                    });
                }
            </script>
        </div>
    </div>
</div>
<!--/*************************************************behind gallery******************************************************/-->








<?php
$all_addresses = $data['all_addresses'];
?>
<div class="shipping_items">
    <div class="header">
        <h4>انتخاب آدرس</h4>
        <a onclick="showModal(this);" style="cursor: pointer;">
            انتخاب آدرس جدید
        </a>
    </div>
    <div class="addresses">
        <?php
        foreach ($all_addresses as $address) {
            ?>
            <div class="items">
                <table cellspacing="0" class="address_table" data-id="<?= $address['id']?>" data-cityID="<?= $address['city']?>">
                    <tr>
                        <td rowspan="3" style="padding: 0;position: relative;" class="activeTableTd">
                           <span class="tickTableActiveClass">
                           <span class="tickIcon"></span>
                           </span>
                            <p class="imgCircleTable">
                                <span class="imgCircleTableSpan"></span>
                            </p>
                        </td>
                        <td colspan="3">
                            <p><?= $address['family'] ?></p>
                        </td>
                        <td rowspan="3" style="padding: 0;">
                            <table>
                                <tr>
                                    <td style="cursor: pointer;" onclick="editAddress(<?= $address['id'] ?>);">
                                        <span class="write_table_icon"></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="cursor: pointer;" onclick="removeAddress();">
                                        <span class="remove_table_icon"></span>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>استان : <?= $address['state_name'] ?></p>
                        </td>
                        <td style="width: 550px;" rowspan="2">
                            <p>محله : <?= $address['mahale'] ?></p>
                            <p><?= $address['address'] ?></p>
                            <p>کد پستی : <?= $address['postCode'] ?></p>
                        </td>
                        <td>
                            <p>شماره تماس اضطراری : <?= $address['phone'] ?></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>شهر : <?= $address['city_name'] ?></p>
                        </td>
                        <td>
                            <p>شماره تماس ثابت : <?= $address['tel'] ?></p>
                        </td>
                    </tr>
                </table>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<script>
    function showModal(tag) {
        $("#addressForm").trigger('reset');
        editAddressId = '';
        var tag = $(tag);
        var behindGallery = tag.parents('#main').find('#behindGallery');
        $('#galleryBox').fadeIn(200);
        behindGallery.fadeIn(200);
    }
    // header("Access-Control-Allow-Origin: *");
    function editAddress($rowId) {

        editAddressId = $rowId;
        var url = 'showCart2/editAddress/' + $rowId + '/';
        var data = {};
        $.post(url, data, function (response) {
            $('input[name=family]').val(response[0]['family']);
            $('input[name=phone]').val(response[0]['phone']);
            $('input[name=tel]').val(response[0]['tel']);
            $('textarea[name=address]').val(response[0]['address']);
            $('input[name=postCode]').val(response[0]['postCode']);

            var state = response[0]['state'];
            var city = response[0]['city'];
            var mahale = response[0]['mahale'];
            console.log(state);

            $('.state option').each(function (index) {
                var txt = $(this).val();
            console.log(txt);
                if (txt === state) {
                    console.log('set');
                    $(this).attr('selected', 'selected');
                    ldMenu(txt,'city');
                }
            });
            $('.city option').each(function (index) {
                var txt1 = $(this).val();
                if (txt1 === city) {
                    $(this).attr('selected', 'selected');
                }
            });
            $('#galleryBox').fadeIn(200);
            $('#behindGallery').fadeIn(200);
        }, 'json');

    }

    function removeAddress() {
        alert('remove address');
    }

    $('.address_table').find('td:first-child').click(function () {
        $('.address_table').removeClass('active');
        $(this).parents('.address_table').addClass('active');
    });
</script>


<?php
$transportData = $data['transportData'];
?>
<!--/*************************************************transport table******************************************************/-->


















<div class="shipping_items">
    <div class="header">
        <h4>شیوه ی ارسال</h4>
    </div>
    <div class="transportationStates">

        <?php foreach ($transportData as $tData){
            ?>
            <table class="transformation_table" data-id="<?= $tData['id']?>">
                <tr>
                    <td style="position: relative; width: 70px;border-left: 1px solid #eeeeee;">
                        <span class="circleEmpty">
                        <span class="circleSmall"></span>
                        </span>
                    </td>
                    <td style="width: 900px;height: 73px;">
                        <p class="transportationStatesIcon" style="float: right;"></p>
                        <p class="font-B-Yekan font-sm" style="float: right;width: 700px;margin-right: 37px;"><?= $tData['title']?></p>
                        <p class="font-B-Yekan font-sm" style="color: #999999;float: right; margin-right: 35px;margin-top: 3px;" >
                            <?= $tData['description']?>
                        </p>
                    </td>
                    <td style="border-right: 1px solid #eeeeee;">
                        <p style="text-align: center">هزینه ی ارسال</p>
                        <p style="text-align: center; color: darkgreen;" class="post<?= $tData['id'];?>"></p>
                    </td>
                </tr>
            </table>
            <?php
        }?>
        <div class="btnBox">
            <a href="showCart" class="returnBack">بازگشت به سبد خرید</a>
            <a href="showCart3" class="goToNextPage">ثبت اطلاعات و ادامه خرید</a>
        </div>
    </div>
</div>


<script>
    $('.transformation_table').find('td:first-child').click(function () {
        $('.transformation_table').removeClass('active');
        $(this).parents('.transformation_table').addClass('active');
        getPostPrice();
        setSessionForPostType();
    });

    function getPostPrice(){
        var url = 'showCart2/getPostPrice';
        var cityId = $('.address_table.active').attr('data-cityID');
        var addressId = $('.address_table.active').attr('data-id');
        var postId = $('.transformation_table.active').attr('data-id');
        var data = {'cityId':cityId,'postId':postId,'addressId':addressId};
        $.post(url,data,function ( response) {
            console.log(response);
            var naghdi = response['naghdi'];
            var posti = response['posti'];
            $('.transformation_table').find('.post1').text(naghdi);
            $('.transformation_table').find('.post2').text(posti);
            // console.log(response);
        },'json');
    }
    function setSessionForPostType() {
        var url = 'showCart2/setSessionForPostType';
        var postId = $('.transformation_table.active').attr('data-id');
        var data = {'postId':postId};
        $.post(url,data,function ( response) {
            // console.log(response);
        });
    }
</script>
<!--/*************************************************post table******************************************************/-->