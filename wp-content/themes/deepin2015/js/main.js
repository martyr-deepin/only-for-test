function smoothScroll(offset) {
    $('a[href*=#]:not([href=#])').click(function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {

            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top - offset
                }, 400);
                return false;
            }
        }
    });
}

/*页面跳转*/
function EnterPress(event){ //传入 event
    if(event.keyCode == 13) {
        var page = parseInt($('#skip').val());
        var $maxPage = $('#footer_page span');
        var maxPage = $maxPage.html();
        maxPage = maxPage.substring(1, maxPage.length);
        var currentLocation = window.location.href;
        var currentLang = null;

        if(currentLocation.indexOf('language') !== -1) {
        	currentLang = currentLocation.substring(currentLocation.indexOf('language'), currentLocation.length);
        	currentLocation = currentLocation.substring(0, currentLocation.indexOf('/?language'));
        }

        if(currentLocation.indexOf('page') !== -1) {
        	currentLocation = currentLocation.substring(0, currentLocation.indexOf('/page'));
        }

        if(!isNaN(page) && page <= maxPage && page > 0) {
        	if(currentLocation.charAt(currentLocation.length - 1) !== '/')  {
        		currentLocation += '/';
        	}

            currentLocation = currentLocation + 'page/' + page + '/';
            if(currentLang) {
            	currentLocation = currentLocation + '?' + currentLang;
            }

            window.location.href = currentLocation;
        }
    }
}

(function ($) {

    jQuery.getCookie = function(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i=0; i<ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1);
            if (c.indexOf(name) == 0) {
                return c.substring(name.length,c.length);
            }
        }
        return '';
    };

    $(document).ready(function () {
        // 文本框暗示
        $.fn.hint = function (text) {
            var t = this,
                color = 'color';
            text = text || T1;
            return t.each(function () {
                var $this = $(this);
                $this.val(text).css(color, '#ccc').off('focus.hint').on('focus.hint', function () {
                    if ($this.val() == '' || $this.val() == text) {
                        $this.val('').css(color, '#000');
                    }
                }).off('blur.hint').on('blur.hint', function () {
                    if ($this.val() == '' || $this.val() == text) {
                        $this.val(text).css(color, '#ccc');
                    }
                });
            });
        };

        var lang = $.getCookie('deepin_language');
        if(lang === 'zh-cn'){
            $('#scbar_txt').hint("请输入提示内容");
        }else{
            $('#scbar_txt').hint("Please input the search content");
        }

        /*头部搜索框和语言*/
        $('.navbar-nav .global').on('click', function(event){
            var $languagePanel =  $('.language-panel', $(this));
            $languagePanel.toggleClass('invisible');
            event.stopPropagation();
        });

        $('.navbar-nav .search .search-button').on('click', function(event){
            var $this = $(this);

            var $languagePanel = $('.navbar-nav .global .language-panel');

            if(!$languagePanel.hasClass('invisible')) {
                $languagePanel.addClass('invisible');
            }

            var $search = $('.navbar-nav .search input');
            if(!$this.hasClass('clicked')){
                $this.addClass('clicked');
                /*
                 $search.show(function(){

                 if(typeof $search[0].style['transition'] !== 'string'){
                 $search.width(241);
                 }
                 else{
                 $search.css({
                 width: 241,
                 transition: 'width 50ms'
                 });
                 }
                 });
                 */
                $search.show();
                setTimeout(function() {
                    $search.focus();
                }, 500);
                $('.user-info .user').hide();
                event.stopPropagation();
                return;
            }

            var searchString = $search.val();
            /*
             if(typeof $search[0].style['transition'] !== 'string'){
             $search.width(0);
             }
             else{
             $search.css({
             width: 0,
             transition: 'width 50ms'
             });
             }
             */
            //$search.width(0);
            /*
             setTimeout(function(){
             $search.hide();
             }, 600);
             */
            $search.hide();
            $('.user-info .user').show();
            $this.removeClass('clicked');
            if(searchString.length === 0){
                return;
            }
            searchString ="/?s="+ searchString+"&searchsubmit=true";
            var searchWindow = window.open(searchString, '_blank');

            searchWindow.focus();

        });

        $('.navbar-nav .search input').on('keyup', function(event){
            if(event.keyCode === 13) {
                var $this = $(this);
                var $searchButton = $('.navbar-nav .search .search-button');

                var searchString = $this.val();
                /*
                 if(typeof $search[0].style['transition'] !== 'string'){
                 $search.width(0);
                 }
                 else{
                 $search.css({
                 width: 0,
                 transition: 'width 50ms'
                 });
                 }
                 */
                //$search.width(0);
                /*
                 setTimeout(function(){
                 $search.hide();
                 }, 600);
                 */
                $this.hide();
                $searchButton.removeClass('clicked');


                if(searchString.length === 0){
                    return;
                }
                var search_url = $('.navbar-nav .search .search-button').attr('search_url');
                searchString = search_url + searchString;
                var searchWindow = window.open(searchString, '_blank');


                searchWindow.focus();
            }
        });

        $('.navbar-nav .search input').on('click', function(){
            return false;
        });

        $(document.body).on('click', function(){
            //var $searchButton = $('.navbar-nav .search .search-button');
            //var $searchInput = $('.navbar-nav .search input');
            if($('.search-button').hasClass('clicked')){
                $('.search-button').removeClass('clicked');
            }

            var $userInfo =  $('.user-info .dropdown');

            if(!$userInfo.hasClass('invisible')){
                $userInfo.addClass('invisible');
            }
            //if(!$('.language-panel').hasClass('invisible')){
            //    $('.language-panel').addClass('invisible');
            //}


            $('.language-panel').addClass('invisible');
            $('#scbar_txt').hide();
            $('#scbar_btn').hide();
            $('.user-info .user').show();

            $('#theme_moreSort').hide();
            $('.arrow_sort').hide();
            $('.theme_moresort').removeClass('popDiv');
            $('.theme_moresort').addClass('popDiv1');
        });



        /*moreSort更多分类信息隐藏和显示*/
        $('.theme_moresort').on('click',function(event){
            if(document.getElementById('theme_moreSort').style.display=='block'){
                $('#theme_moreSort').hide();
                $('.arrow_sort').hide();
                $('.theme_moresort').removeClass('popDiv');
                $('.theme_moresort').addClass('popDiv1');
            }else{
                $('.arrow_sort').css('display','block');
                $('#theme_moreSort').show();
                $('.theme_moresort').removeClass('popDiv1');
                $('.theme_moresort').addClass('popDiv');
            }
            event.stopPropagation();
        });

        /*回到顶部的图标指示*/
        $(window).scroll(function(){
            if($(window).scrollTop() > 55){
                $('#scrolltop').show();
            } else {
                $('#scrolltop').hide();
            }
        });
        /*
         * * Smooth scroll.
         * */

        smoothScroll($('#top').height() + 100);


        var $maskLayer = $('.mask-layer');

        function showMaskLayer(show) {
            if (show === true) {
                $maskLayer.css({
                    display: 'block',
                    width: $(document.body).width(),
                    height: $(document.body).height()
                });
            }
            else {
                $maskLayer.css({display: 'none'});
            }
        }

        function showWindow(windowName, show) {
            var $window = $('.window' + '.' + windowName);
            if (show === true) {
                $window.css({
                    display: 'block',
                    left: ($(window).width() - $window.width()) / 2,
                    top: (window.screen.availHeight - $window.height()) / 2
                });
            }
            else {
                $window.css({
                    display: 'none'
                });
            }
        }

        $('.social > a.pop').on('click', function () {
            var $this = $(this);
            var buttonName = $this.attr('class').split(' ')[0];
            if (buttonName !== 'weibo') {
                showMaskLayer(true);
                showWindow(buttonName, true);
            }
        });

        if($('.theme_cont').length === 0){
            $('#scrolltop').css("right", parseFloat($(document).width()-$('.cont').width())/2-45);
            if($(window).width() > 1540) {
                $('#theme_moreSort').css("margin-right", parseFloat($(document).width()-$('.cont').width())/2);
            }

        }else{
            $('#scrolltop').css("right", parseFloat($(document).width()-$('.theme_cont').width())/2-30);
            if($(window).width() > 1540) {
                $('#theme_moreSort').css('margin-right',parseFloat($(document).width()-$('.theme_cont').width())/2+15);
            }
        }

        $(window).resize(function () {
            var visible = $maskLayer.css('display') !== 'none';
            if (visible){
                $maskLayer.css({
                    width: $(document.body).width(),
                    height: $(document.body).height()
                });

                $('.window').each(function () {
                    var $this = $(this);
                    if ($this.css('display') !== 'none') {
                        $this.css({
                            left: ($(document).width() - $this.width()) / 2
                        });
                    }
                });
            }
            if($('.theme_cont').length === 0){
                $('#scrolltop').css("right", parseFloat($(document).width()-$('.cont').width())/2-45);
                if($(window).width() > 1540) {
                    $('#theme_moreSort').css("margin-right", parseFloat($(document).width()-$('.cont').width())/2);
                }
            }else{
                $('#scrolltop').css("right", parseFloat($(document).width()-$('.theme_cont').width())/2-30);
                if($(window).width() > 1540) {
                    $('#theme_moreSort').css('margin-right',parseFloat($(document).width()-$('.theme_cont').width())/2+15);
                }
            }

            var lang = $.getCookie('deepin_language');
            if(lang === 'zh-cn'){
                if($('.theme_cont').length === 0){
                    $('#scrolltop').css("right", parseFloat($(document).width()-$('.cont').width())/2-45);
                    $('#theme_moreSort').css("margin-right", parseFloat($(document).width()-$('.cont').width())/2);
                }else{
                    $('#scrolltop').css("right", parseFloat($(document).width()-$('.theme_cont').width())/2-30);
                    $('#theme_moreSort').css('margin-right',parseFloat($(document).width()-$('.theme_cont').width())/2+15);
                }
            }
            if(parseFloat($(document).width()-$('.theme_cont').width())/2 <= 0){
                $('#theme_moreSort').css("right",$(window).width()-$('.theme_cont').width());
            }else{
                $('#theme_moreSort').css("right",0);
            }

        });

        $('.window .close').on('click', function () {
            showWindow($(this).parent('.window').attr('class').split(' ')[1], false);
            showMaskLayer(false);
        });

        $('.history .checksum').on('click', function(event){
            event.preventDefault();
            showWindow('checksum', true);
            showMaskLayer(true);
        });

        $maskLayer.on('click', function () {
            $('.window').each(function () {
                var $this = $(this);
                if ($this.css('display') !== 'none') {
                    $this.css({
                        display: 'none'
                    });
                }
            });
            showMaskLayer(false);
        });

        $('.theme_discuz .reply').on('click',function(){
            $('#reply_pop').show();
        });
        $('.tl5_top a').on('click',function(){
            $('#reply_pop').hide();
        });
        $('#reply_pop1 .tl5_top a').on('click',function(){
            $('#reply_pop1').hide();
        });


        //$('#top .user-menu').mouseenter(function(){
        //    $('.dropdown').removeClass('invisible');
        //});

        //$('#top .user-menu').mouseleave(function(){
        //    $('.dropdown').addClass('invisible');
        //});
        $('#top .user-menu').hover(function(){
            $('.dropdown').removeClass('invisible');
        },function(){
            $('.dropdown').addClass('invisible');
        });


        (function(){
            var icon_list = {
                en: ['twitter', 'facebook'],
                'zh-cn': ['weixin', 'weibo']
            };

            var lang = $.getCookie('deepin_language');
            lang = (lang === '' ? 'zh-cn' : lang);
            var icons = icon_list[lang];
            for(var i = 0; i < icons.length; ++i) {
                $('.social .' + icons[i]).show();
            }

            if(lang === 'zh-cn'){
                if($('.theme_cont').length === 0){
                    $('#scrolltop').css("right", parseFloat($(document).width()-$('.cont').width())/2-45);
                    $('#theme_moreSort').css("margin-right", parseFloat($(document).width()-$('.cont').width())/2);

                }else{
                    $('#scrolltop').css("right", parseFloat($(document).width()-$('.theme_cont').width())/2-30);
                    $('#theme_moreSort').css('margin-right',parseFloat($(document).width()-$('.theme_cont').width())/2+15);
                }
            }else{
                $('.arrow_sort').css("right","193px");
                $('.arrow_sort').css("margin-left","-15px");
            }

            if(parseFloat($(document).width()-$('.theme_cont').width())/2 <= 0){
                $('#theme_moreSort').css("right",$(window).width()-$('.theme_cont').width());
            }else{
                $('#theme_moreSort').css("right",0);
            }
        })();
    });
})(jQuery);
