var userPanelTab_content = $('.userPanelTab_content > ul > li');
userPanelTab_content.click(function () {
    userPanelTab_content.removeClass('activetab');
    $(this).toggleClass('activetab');
    var index = $(this).index();
    userPanelTab_content.parents('.userPanelTab_content').find('.content section').fadeOut(0);
    $(this).parents('.userPanelTab_content').find('.content section').eq(index).fadeToggle(200);
});
/** tab details **/
function openTabDetail(tag){
    var tagItem = $(tag);
    var tr = tagItem.parents('tr');
    tr.next().fadeToggle(200);
    tagItem.find('p').toggleClass('down');
}
$(".selectpicker").selectpicker();

/** user page modal **/
$('a.login').click(function () {
    $('#galleryBoxUserPage').fadeIn(200);
    $('#behindGallery').fadeIn(200);
});


/*
function addColorSpan(color,tag,name) {
    alert('Hello');
    var item = '<span class="colorItem" style="background:rgba(238,238,238,0.55);"><span style="display: inline-block; color: "+color+";">"+name+"</span><i class="colorCircle" style="background:"+color+""></i><img\n' +
        '                                        src="public/main-images/close-icon.gif" alt="" style="width: 15px;float: left;position: relative;top: 4px;"></span>';
}*/
