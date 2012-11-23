// 重定位页脚函数
function repositionFooter(){
    var h = $(window).height();
    // 再减去60是因为footer里面的padding和margin
    $("#maincontent").css('min-height',h - $('#header').height() - $('#footer').height() - 60);
};

// 用户调整窗口大小时重定位页脚
var resizeTimer = null;
$(window).bind('resize', function(){
    if(resizeTimer) clearTimeout(resizeTimer);
    resizeTimer = setTimeout(repositionFooter,100);
});

// 页面加载的时候重定位页脚
$(document).ready(repositionFooter);
