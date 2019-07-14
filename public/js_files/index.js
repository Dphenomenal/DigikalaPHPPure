/****************************************** navigation menu ********************************************/
var timer = {};
$('#menu_top li').hover(function () {
    var tag = $(this);
    var attr = tag.attr('data-time');
    clearTimeout(timer[attr]);
    timer[attr] = setTimeout(function () {
        $(' > a', tag).addClass('navigation-hovering');
        $(' > ul', tag).fadeIn(0);
        $(' > .submenu3', tag).fadeIn(0);
    }, 500);
}, function () {
    var tag = $(this);
    var attr = tag.attr('data-time');
    clearTimeout(timer[attr]);
    timer[attr] = setTimeout(function () {
        $(' > a', tag).removeClass('navigation-hovering');
        $(' > ul', tag).fadeOut(0);
        $(' > .submenu3', tag).fadeOut(0);
    }, 500);
});
/* slider top */
var parent = $('#slider_top');
var items = parent.find(' > .slider_img > .item');
var navItems_a = parent.find('.slider_nav ul li a');
var current = 1;
var itemsLength = items.length;
var first_interval;
var secondInterval;

function slide() {
    items.hide();
    if (current > itemsLength) {
        current = 1;
    } else if (current < 1) {
        current = itemsLength;
    }
    items.eq(current - 1).fadeIn(100);
    navItems_a.removeClass('slider1active');
    navItems_a.eq(current - 1).addClass('slider1active');
    current++;
}

$('.arrow_right').click(function () {
    clearInterval(first_interval);
    clearInterval(secondInterval);
    goToPrev();
});

function goToPrev() {
    current = current - 2;
    slide();
}

$('.arrow_left').click(function () {
    clearInterval(first_interval);
    clearInterval(secondInterval);
    goToNext();
});

function goToNext() {
    slide();
}

$('.slider_nav ul li').click(function () {
    $('.slider_nav ul li a').removeClass('slider1active');
    $(' > a', this).addClass('slider1active');
    var navIndex = $(this).index();
    goToSlide(navIndex);
    clearInterval(first_interval);
    clearInterval(secondInterval);
});

function goToSlide(index) {
    current = index + 1;
    slide();
}


/* second slider */
var first_interval_slider2;
var secondInterval_slider2;
var slider2Parent = $('#slider_second');
var slider2_imgItems = slider2Parent.find('.slider2_items');
var slider2_imgItems_length = slider2_imgItems.length;
var slider2_current = 1;
var slider2_current_index;
var slider2_links = slider2Parent.find('.sliderTop_nav ul li a');
$('button').click(function () {
    slider2_slide();
});

function slider2_slide() {
    if (slider2_current < 1) {
        slider2_current = slider2_imgItems_length;
    } else if (slider2_current > slider2_imgItems_length) {
        slider2_current = 1;
    }
    slider2_imgItems.hide();
    slider2_imgItems.eq(slider2_current - 1).fadeIn(100);
    slider2_links.removeClass('active2');
    slider2_links.eq(slider2_current - 1).addClass('active2');
    slider2_current++;
}

$('.sliderTop_nav ul li').click(function () {
    clearInterval(first_interval_slider2);
    clearInterval(secondInterval_slider2);
    slider2_current_index = $(this).index();
    slider2_current = slider2_current_index + 1;
    slider2_slide();

});


first_interval_slider2 = setInterval(function () {
    slider2_slide();
}, 3000);

/**************************** after page load ********************/
// $(document).ready(function () {
    /*$('.afterTimeOutSlider2').fadeOut();
    $('.example').flipTimer({
        direction: 'down',
        date: 'April 29, 2019 9:33:00',
        days: false,
        callback: function () {
            $('.afterTimeOutSlider2').fadeIn();
        }
    });*/
    slide();
    first_interval = setInterval(function () {
        slide();
    }, 3000);
    parent.mouseleave(function () {
        clearInterval(first_interval);
        clearInterval(secondInterval);
        secondInterval = setInterval(function () {
            slide();
        }, 3000);
    });
    slider2_slide();
    slider2Parent.mouseleave(function () {
        clearInterval(first_interval_slider2);
        clearInterval(secondInterval_slider2);
        secondInterval_slider2 = setInterval(function () {
            slider2_slide();
        }, 3000);
    });
// });

/************************************ third slider and others **********************************/
function showSliderProduct(direction, tag) {
    var arrowTag = $(tag);
    var ulParent = arrowTag.parents('.product_slider_content').find('.slider_contentP ul');
    var liItemsProduct = ulParent.find(' li').length;
    var slider2Count = Math.ceil(liItemsProduct / 4);
    var maxNegativeMargin = -(slider2Count - 1) * 780;
    ulParent.css('width', liItemsProduct * 196);
    var currentUlMargin = ulParent.css('margin-right');
    currentUlMargin = parseFloat(currentUlMargin);
    if (direction === 'left') {
        currentUlMargin -= 780;
    } else if (direction === 'right') {
        currentUlMargin += 780;
    }
    if (currentUlMargin < maxNegativeMargin) {
        currentUlMargin = 0;
    } else if (currentUlMargin > 0) {
        currentUlMargin = maxNegativeMargin;
    }
    var strNextMove = currentUlMargin + 'px';
    ulParent.animate({'marginRight': strNextMove}, 1000);
}

/************************************* register and login checkbox ************************************************/
$('.behindCheck').click(function () { //input
    var behindSpan = $(this);
    var labelTagCheckboxOn = behindSpan.parents('.checkboxOn '); //parent
    var labelTagRemember = behindSpan.parents('.remember '); //parent
    var labelTagSearch = behindSpan.parents('.searchCheck '); //parent
    var checkboxOn = labelTagCheckboxOn.length;
    var remember = labelTagRemember.length;
    var search = labelTagSearch.length;
    var currentParent;
    if (checkboxOn > 0) {
        currentParent = labelTagCheckboxOn;
    } else if (remember > 0) {
        currentParent = labelTagRemember;
    } else if (search > 0) {
        currentParent = labelTagSearch;
    }
    checkFunction(currentParent, behindSpan);
});

function checkFunction(tag, behindSpan) {
    var prCheckbox = tag.find('.onCheckbox'); //span on input
    if (behindSpan.is(':checked')) {
        prCheckbox.addClass('checkedCheck');
    } else {
        prCheckbox.removeClass('checkedCheck');
    }
}

/********************************* search page checkbox ************************************/
var filterListLi = $('.filterList > ul > li');
var secondLi = filterListLi.find('.options > ul > li');
var checkedFilter = $('.checkedFilter');
var removeBtn;
var titleName;
var itemName;
var itemId;
var spanItem;
var oldParent = $('.leftColumn');
var spanItemLength;
filterListLi.click(function () {
    var options = $(this).find(' > .options');
    options.slideToggle(200);
});
secondLi.hover(function () {
    $(this).find('i').addClass('square_select_gray');
}, function () {
    $(this).find('i').removeClass('square_select_gray');
});
secondLi.click(function () {
    // titleName =$(this).parents('.filterList').find('.title').text();
    titleName = $(this).parents('li').find('.title').text();
    itemName = $(this).find('span').text();
    itemId = $(this).attr('data-id');
    spanItem = checkedFilter.find('span[data-id="' + itemId + '"]');
    removeBtn = spanItem.find('.removeI');
    spanItemLength = spanItem.length;

    if (spanItemLength < 1) {
        checkedFilter.append('<span data-id="' + itemId + '" class="items">' + titleName + ' : ' + itemName + '<i class="removeI" onclick="removeSelectedFilter(this)"></i></span>');
    } else if (spanItemLength > 0) {
        spanItem.remove();
    } else if (spanItemLength === 0) {
        checkedFilter.append('<span data-id="' + itemId + '" class="items">' + titleName + ' : ' + itemName + '<i class="removeI" onclick="removeSelectedFilter(this)"></i></span>');
    }
    $(this).find('i').toggleClass('square_select_red');
});

function removeSelectedFilter(tag) {
    $(tag).parents('span').remove();
    var liId = $(tag).parents('span').attr('data-id');
    $('.options li[data-id="' + liId + '"]').find('i').removeClass('square_select_red');
}

/* show on off state */
var onOffImg;
$('.behindImgExists').click(function () {
    onOffImg = $(this).find(' > .onOffImg');
    $(this).toggleClass('behindImgExistsGreen');
    onOffImg.toggleClass('onYes');
    if ($(this).hasClass('behindImgExistsGreen')) {
        onOffImg.animate({left: '11px'});
    } else {
        onOffImg.animate({left: '0'});
    }
});

/* show product with different type*/
var imageState = $('.imageState');
var right = imageState.find('.right');
var left = imageState.find('.left');
var productItem = $('.ProductItems');
right.click(function () {
    left.removeClass('activeSpanLeft');
    right.toggleClass('activeSpanRight');
    productItem.addClass('activeState');
});
left.click(function () {
    right.removeClass('activeSpanRight');
    left.toggleClass('activeSpanLeft');
    productItem.removeClass('activeState');
});
/***************************** product page **********************************************/

// var count = 0;
$('.productDescription .more').click(function () {
    $(this).parents('.productDescription').find('.detail').toggleClass('heightAuto');
    $(this).toggleClass('active');

    if ($(this).hasClass('active')) {
        $(this).find('span').html('بستن');
    } else {
        $(this).find('span').html('نمایش بیشتر');
    }
});


/** product page slider **/
function showSliderProductPage(direction, tag) {
    var arrowTag = $(tag);
    var ulParent = arrowTag.parents('.product_slider_content').find('.slider_contentP ul');
    var liItemsProduct = ulParent.find(' li').length;
    var slider2Count = Math.ceil(liItemsProduct / 6);
    var maxNegativeMargin = -(slider2Count - 1) * 1084;
    ulParent.css('width', liItemsProduct * 180);
    var currentUlMargin = ulParent.css('margin-right');
    currentUlMargin = parseFloat(currentUlMargin);
    if (direction === 'left') {
        currentUlMargin -= 1084;
    } else if (direction === 'right') {
        currentUlMargin += 1084;
    }
    if (currentUlMargin < maxNegativeMargin) {
        currentUlMargin = 0;
    } else if (currentUlMargin > 0) {
        currentUlMargin = maxNegativeMargin;
    }
    var strNextMove = currentUlMargin + 'px';
    ulParent.animate({'marginRight': strNextMove}, 1000);
}

/** tabs product page*
var tabLi = $('#tabs > ul > li');
// var count = 0;
tabLi.click(function () {
    // count++;
    var currentLiItem = $(this).index();
    $('#tabs ul li').removeClass('tabActive');
    $(this).addClass('tabActive');
    $(this).parents('#tabs').find('.content section').fadeOut(0);
    $(this).parents('#tabs').find('.content section').eq(currentLiItem).fadeIn(500);
});
/!*if (tabLi.hasClass('tabActive') && count === 0){
    tabLi.parents('#tabs').find('.content section').eq(0).fadeIn(0);
}*!/
/!** tab1 content**!/
$('.section_content > ul > li').click(function () {
    $(this).toggleClass('liContentActive');
});*/

$('#zoom').elevateZoom({
    zoomType: "inner",
    cursor: "crosshair"
});
$("#images_section .left").mCustomScrollbar({
    theme: "dark",
    scrollInertia: 500,
    autoHideScrollbar: true,
    scrollButtons: "stepless",
});
var image_section_li = $('#images_section .left ul li');
image_section_li.click(function () {
    var data_src = $(this).attr('data-src');
    var imgTag = $(this).parents('#images_section').find('.right img');
    imgTag.attr('src', data_src);
    $('#images_section .left ul li').css('opacity', '0.3');
    $(this).css('opacity', '1');
});

function closeModal(tag) {
    var tag = $(tag);
    tag.parents('#galleryBox').fadeOut(200);
    tag.parents('#behindGallery').fadeOut(200);
}
// function showModal(tag){
//     var tag = $(tag);
//     var behindGallery = tag.parents('#main').find('#behindGallery');
//     behindGallery.fadeIn(200);
// }

/*$('.cancel').click(function () {
    $('#galleryBox').fadeOut(200);
    $('#behindGallery').fadeOut(200);
});*/
$('.gallery ul li').click(function () {
    var data_src = $(this).attr('data-src');
    var index = $(this).index();
    if (index !== 4) {
        image_section_li.css('opacity', '0.3');
        image_section_li.eq(index).css('opacity', '1');
    } else {
        image_section_li.css('opacity', '0.3');
        image_section_li.eq(index).css('opacity', '0.3');
    }
    // image_section_li.eq(index).css('opacity','1');
    $('#galleryBox').fadeIn(200);
    $('#behindGallery').fadeIn(200);
    image_section_li.eq(index).parents('#images_section').find('.right img').attr('src', data_src);
});


/** user page modal **/
