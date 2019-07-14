<style>
    #textarea{
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
                        <input type="text" name="family" value="">
                    </label>
                    <label for="">
                        <p>شماره تماس ضروری(تلفن همراه)</p>
                        <input type="text" name="phone" value="">
                    </label>
                    <label for="">
                        <p>شماره تماس ثابت</p>
                        <input type="text" name="tel" value="">
                    </label>
                    <label for="">
                        <p>استان و شهر</p>
                        <select name="state" id="#id1" onchange="ostan(this)">
                            <option data-val="41">آذربایجان شرقی</option>
                            <option data-val="44">آذربایجان غربی</option>
                            <option data-val="45">اردبیل</option>
                            <option data-val="31">اصفهان</option>
                            <option data-val="26">البرز</option>
                            <option data-val="84">ایلام</option>
                            <option data-val="77">بوشهر</option>
                            <option data-val="21">تهران</option>
                            <option data-val="38">چهارمحال و بختیاری</option>
                            <option data-val="56">خراسان جنوبی</option>
                            <option data-val="51">خراسان رضوی</option>
                            <option data-val="58">خراسان شمالی</option>
                            <option data-val="61">خوزستان</option>
                        </select>
                        <span class="shahr">
                           <select name="city" id="#id2" onchange="mahale(this)">
                           </select>
                           </span>
                    </label>
                    <label for="">
                        <p>محله</p>
                        <span class="mahale">
                           <select name="mahale" id="#id3">
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
                        <input type="text" name="postCode" value="">
                    </label>
                    <label for="">
                        <input type="button" class="btnIgnore" value="انصراف">
<!--                    <input type="button" class="btnSave" value="ثبت اطلاعات و بازگشت" onclick="addAddress();">-->
                        <button type="submit" onclick="addAddress();" class="btnSave">ثبت اطلاعات و بازگشت</button>
                    </label>
                </form >
            </div>
            <script>

                function addAddress() {
                    var url = 'showCart2/addAddress';
                    var data = $('#addressForm').serializeArray();
                    $.post(url,data,function (msg) {
                        console.log(msg);
                    });
                }
            </script>
        </div>
    </div>
</div>
