var slackUpdating = false;
jQuery(document).ready(function ($) {


    $("input[type='radio'][name='ima']").click(function() {
        var value = $(this).val();
        if(value == 'other'){
            $('#other-field').show();
        }else{
            $('#other-field').hide();
        }
    });

    $.each($('.photonic-album-photo-count'), function () {
        var photostring = $(this).html(),
            photocount = parseInt(photostring);

        photostring = photostring.replace(photocount, '');

        $(this).html('<span class="countnum">' + photocount + '</span>' + photostring);
    })

    if($('.brass-rat-slider').length){
        $('.brass-rat-slider').slick({
            dots: true,
            arrows: false
        });
    }

    if($('.leader-ship-slider').length){
        $('.leader-ship-slider').slick({
            prevArrow: $('.previous-link'),
            nextArrow: $('.next-link'),
            initialSlide: ($('.leader-ship-slider .current_user_profile').length) ? parseInt($('.leader-ship-slider .current_user_profile').data('current_user_order')) : 0
        });
    }

    if($('.card-slider').length){
        $('.card-slider').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            arrows: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        arrows: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
    
                        slidesToScroll: 1
                    }
                }
    
            ]
        });
    }

    if($('.card-slider2').length){
        $('.card-slider2').slick({
            infinite: true,
            slidesToShow: 2,
            slidesToScroll: 2,
            arrows: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2,
                        infinite: true,
                        arrows: false
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
    
                        slidesToScroll: 1
                    }
                }
    
            ]
        });
    }

    $(window).scroll(function () {
        if ($(this).scrollTop() > 650) {
            $('.static-registration-bar').addClass('active');
        } else {
            $('.static-registration-bar').removeClass('active');
        }
    });

    if($('.banner-slider').length){
        $('.banner-slider').slick({
            dots: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            infinite: true,
            speed: 300,
            autoplay: true,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        arrows: true
                    }
                },
                {
                    breakpoint: 1010,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                    }
                }
    
            ]
        });
    }

    if($('.home-slider-container').length){
        $('.home-slider-container').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            // lazyLoad: 'ondemand',
            autoplay: false,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        infinite: true,
                        arrows: true
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
    
            ]
        });
    }

    if($('.slick-nav-slider').length){
        $('.slick-nav-slider').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            initialSlide: 1,
            autoplay: false,
            dots: false
        });
    }

    $('#slider_loader').fadeOut('slow', function () {
        $('.home-slider-container').css('visibility', 'visible');
    });

    $('.slick-nav-slider .slick-next').on('click', function () {
        $(".home-slider-container, .slick-nav-slider").slick('slickNext');
    });


    $('.slick-nav-slider .slick-prev').on('click', function () {
        $(".home-slider-container, .slick-nav-slider").slick('slickPrev');
    });

    if($('.upcoming-events-banner').length){
        $('.upcoming-events-banner').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            autoplay: false,
        });
    }

    if($('.upcoming-event-nav').length){
        $('.upcoming-event-nav').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            slickGoTo: 1,
            initialSlide: 1,
            dots: false
        });
    }

    $('.upcoming-event-nav .slick-next').on('click', function () {
        $(".upcoming-events-banner, .upcoming-event-nav").slick('slickNext');
    });

    $('.upcoming-event-nav .slick-prev').on('click', function () {
        $(".upcoming-events-banner, .upcoming-event-nav").slick('slickPrev');
    });

    var mouse = 'out';
    $('.main-nav > li.menu-item-object-custom.menu-item-has-children').hover(function () {
        if (mouse == 'out') {
            $(this).parents('.navigation').css("height", "280px");
            $('.main-nav').addClass("open");
            $(this).find('.drop-down').slideDown(1);
            mouse = 'in';
        }
    }, function () {
        if (mouse == 'in') {
            $(this).parents('.navigation').css("height", "65px");
            $('.main-nav').removeClass("open");
            $(this).find('.drop-down').slideUp(1);
            mouse = 'out';
        }
    });

    $('a[href^="#"]').click(function (event) {
        event.preventDefault();
        if(typeof $($.attr(this, 'href')).offset() !== 'undefined'){
            $('html, body').animate({
                scrollTop: $($.attr(this, 'href')).offset().top
            }, 1000);
        }
    });

    $('.event-filter li select').click(function () {
        $(this).parent('li').addClass('selected');
        if ($(this).find(":selected").text() == "") {
            $(this).parent('li').removeClass('selected');
        }
    });

    $('.event-tab a').click(function () {
        $('.event-tab a').removeClass('active');
        $(this).addClass('active');
    });

    $(".toggle-button").click(function () {
        $(this).toggleClass('open');
        $('.mobile-navigation').toggleClass('active');
    });

    if (navigator.userAgent.match(/Android/i)
        || navigator.userAgent.match(/webOS/i)
        || navigator.userAgent.match(/iPhone/i)
        || navigator.userAgent.match(/iPad/i)
        || navigator.userAgent.match(/iPod/i)
        || navigator.userAgent.match(/BlackBerry/i)
        || navigator.userAgent.match(/Windows Phone/i)) {

        $(".main-nav > li.menu-item-has-children").click(function () {
            $('.main-nav > li.menu-item-has-children .drop-down').toggleClass('open');
        });
    } else {
        // write code for your desktop clients here
    }


    $(window).scroll(function () {
        if ($(window).scrollTop() >= 80) {
            $('.main-sidebar-container').addClass('fixed-sidenav');
        } else {
            $('.main-sidebar-container').removeClass('fixed-sidenav');
        }
    });


    $(".show-answer").click(function () {
        $(".answer-box").slideToggle();
    });


    /***********************************************
     *************** FARAZ CODE *********************
     ************************************************/
    // FOR MEGA MENU
    $('.main-nav > li.two-collumn .sub-menu').css('float', 'left');
    $('.main-nav > li.two-collumn .sub-menu').after('<ul class="sub-menu" id="_two_column_content"></ul>');
    var recommend_speaker = $('.recommend_speaker').clone(),
        recommend_event = $('.recommend_event').clone();
    $('.recommend_speaker, .recommend_event').remove();
    if (typeof recommend_speaker[0] !== 'undefined') {
        $('#_two_column_content').append(recommend_speaker[0]['outerHTML'] + recommend_event[0]['outerHTML']);
    }
    $('#_two_column_content').css({'float': 'left', 'padding-top': '0px', 'margin-left': '20px'});

    if ($('#gallery_wrapper').length) {
        var gallery_html = '',
            gallery_container = $('#gallery_wrapper');
        $.each($('.photonic-google-stream.photonic-stream'), function () {
            gallery_html += $(this).find('ul').html();
        });
        $('.photonic-google-stream.photonic-stream').remove();
        $('#gallery_wrapper').append('<div class="photonic-google-stream photonic-stream"><ul class="title-display-slideup-stick photonic-level-2-container photonic-standard-layout photonic-thumbnail-effect-none"></ul></div>')
        gallery_container.find('ul').html(gallery_html);
    }

    $('#locations--list').on('click', 'ul li a', function (e) {
        e.preventDefault();
        var location_id = $(this).data('value');
        $('#locations--list ul li').removeClass('active');
        $(this).closest('li').addClass('active');
        $('select[name=event_location] option').removeAttr('selected');
        $('select[name=event_location] option[value=' + location_id + ']').attr('selected', 'selected');
        $('#event_filters_form').submit();
    });

    var team_search_fields = $('.form--search-field');
    if (team_search_fields.length > 0) {
        team_search_fields.on('input', function (e) {
            e.preventDefault();
            loadusersbytopic(this);
        });
    }

    loadusersbytopic($('#topics'));
    $('#topics').change(function () {
        loadusersbytopic(this);
    });

    function loadusersbytopic($this) {
        var topics = $('#topics'),
            topicValue = topics.children("option:selected").val(),
            team_search_fields = $('.form--search-field'),
            value = (team_search_fields.length > 0) ? team_search_fields.val() : '';

        if (team_search_fields.length > 0 || topics.length > 0) {
            value = value.toLowerCase();
            $('.users_list').find('[data-team_member]').hide();
            if (topicValue != 'all' && typeof topicValue !== 'undefined') {
                if (value == '') {
                    $('.users_list').find('[data-topic*="' + topicValue + '"]').show();
                } else {
                    $('.users_list').find('[data-team_member*="' + value + '"][data-topic*="' + topicValue + '"]').show();
                }
            } else {
                if (value != '') {
                    $('.users_list').find('[data-team_member*="' + value + '"]').show();
                } else {
                    $('.users_list').find('[data-team_member]').show();
                }
                $('.users_list').find('[data-type]').hide();
            }
        }

    }

    $('body').on('click', '.btn--location, .btn--program', function (e) {
        $('#step--1 li a').removeClass('active');
        $(this).addClass('active');
        var location_id = $('.btn--location.active').data('id'),
            program_id = $('.btn--program.active').data('id');
        create_calendar_url(location_id, program_id);
        $('#step--2').slideDown();
        $('#step--3').slideDown();
        $('html, body').animate({
            scrollTop: $('#step--2').offset().top - 80
        }, 500);
        var formData = new FormData(),
            xhttp = new XMLHttpRequest();
        formData.append('action', 'isEventAvailable');
        formData.append('location', ((typeof location_id !== 'undefined') ? location_id : ''));
        formData.append('program', (typeof program_id !== 'undefined') ? program_id : '');
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                if (eval(this.responseText) === false) {
                    $('#step--2 .input-link').css({'opacity': 0.3, 'pointer-events': 'none'});
                    $('#alert--no-events').html('There are no upcoming events at this time');
                } else {
                    $('#step--2 .input-link').css({'opacity': 1, 'pointer-events': 'all'});
                    $('#alert--no-events').html('');
                }
            }
        };
        xhttp.open('POST', myAjaxObject.ajax_url, true);
        xhttp.send(formData);
    });
    $('body').on('click', '#copy_the_url', function (e) {
        e.preventDefault();
        $('<input>').val($('#add_to_calendar_url').val()).appendTo('body').select();
        document.execCommand("copy");
        $(this).html('Copied.');
        setTimeout(function () {
            $('#copy_the_url').html('Copy');
        }, 2000);
    });

    $('body').on('click', '.speaker--click', function (e) {
        e.preventDefault();
        $(this).closest('.speaker-card').find('form').submit();
    });


    $('body').on('click', '.tabs-list .calendar-btn', function (e) {
        $('.tabs-list .calendar-btn').removeClass('active');
        $(this).addClass('active');
        var tab_id = $(this).attr('id');

        $('.tabs-data .single-tab').fadeOut('fast');
        $('.tabs-data .' + tab_id).fadeIn('fast');
    });

    var $sawards = $('.users_list');
    if ($sawards.length > 0) {
        $sawards.find('.awards-section').sort(function (a, b) {
            return -a.getAttribute('data-years') - -b.getAttribute('data-years');
        }).appendTo($sawards);
    }

    if ($('[ev__checkout]').length > 0) {
        $.each($('[ev__checkout]'), function () {
            var buttonId = $(this).attr('id'),
                eventId = $(this).attr('ev__eventId'),
                discountCode = $(this).attr('ev__discountCode');
            evCheckout(buttonId, eventId, discountCode)
        });
    }

    $('.slider-container .loader')
        .css('visibility', 'hidden')
        .hide();
    $('.slider-container').removeClass('loading');
    if($('.home-slider-container').length){
        $('.home-slider-container').slick('resize');
    }

    $('.play-icon').click(function () {
        var audioid = $(this).parent().parent().data('audio');
        var myAudio = document.getElementById(audioid);

        if (myAudio.duration > 0 && !myAudio.paused) {
            myAudio.pause();
            $(this).attr("src", myAjaxObject.assets_uri + "/images/icons/play-icon.jpg");
            $(this).removeClass('pause-icon');
        } else {
            myAudio.play();
            $(this).addClass('pause-icon');
            $(this).attr("src", myAjaxObject.assets_uri + "/images/icons/pause-icon.png")
        }
    });


    if($('.page-template-template-event-agenda').length > 0 && $('.agenda-dates-tab li').length > 0 && $('.event-banner.custom-event-banner').length > 0){
        var $data_banner = $('.agenda-dates-tab li.active').data('banner');
        $('.event-banner.custom-event-banner').css({'background-image': 'url("'+$data_banner+'")'})
    }


    $('.agenda-dates-tab li').click(function(){
        var name = $(this).data('name');
        var banner = $(this).data('banner');
        $('.agenda-container').hide();
        $('.'+name).show();
        $('.agenda-dates-tab li').removeClass('active');
        $(this).addClass('active');
        $('.event-banner.custom-event-banner').css({'background-image': 'url("'+banner+'")'});
    });

    $('body').on('click', '.agenda-session-join-btn', function(){
        var agenda_date_id = $(this).data('agenda_date_id');
        if(window.localStorage.getItem('agenda_verification_'+agenda_date_id) != '1'){
            $('.agenda-session-join-btn').show();
            $('.agenda-session-join-form').hide();
            $(this).hide();
            $(this).closest('li').find('.agenda-session-join-form').css('display', 'inline-flex');
        } else{
            $(this).closest('li').find('[name="email"]').val(window.localStorage.getItem('agenda_verified_email_'+agenda_date_id));
            $(this).closest('li').find('.agenda-session-join-form').submit();
        }
    });


    $('body').on('click', '.agenda-session-join-btn-details', function(){
        var agenda_date_id = $(this).data('agenda_date_id');
        if(window.localStorage.getItem('agenda_verification_'+agenda_date_id) != '1'){
            $('.agenda-session-join-btn-details').show();
            $('.agenda-session-join-form-inner').hide();
            $(this).hide();
            $(this).find('.agenda-session-join-form-inner').css('display', 'inline-flex');
        } else{
            $('[name="email"]').val(window.localStorage.getItem('agenda_verified_email_'+agenda_date_id));
            $('.agenda-session-join-form-inner').submit();
        }
    });

    $('body').on('submit', '.agenda-session-join-form', function(e){
        var $this = $(this);
        var agenda_date_id = $($this).find('[name="agenda_date_id"]').val();
        var btnIcon = $($this).find('.fa-arrow-circle-right');
        if(window.localStorage.getItem('agenda_verification_'+agenda_date_id) != '1'){
            e.preventDefault();
            $(btnIcon).removeClass('fa-arrow-circle-right');
            $(btnIcon).addClass('fa-spinner fa-spin');
            $($this).find('.agenda-verification-msg').hide();

            setTimeout(function(){
                window.localStorage.setItem('agenda_verification_'+agenda_date_id, '1');
                window.localStorage.setItem('agenda_verified_email_'+agenda_date_id, $($this).find('[name="email"]').val());
                $($this).unbind('submit').submit();

                $(btnIcon).addClass('fa-arrow-circle-right');
                $(btnIcon).removeClass('fa-spinner fa-spin');
            }, 1500);
        }
    });

    if($('.slack-conversation-history').length > 0){
        updateSlackConversation();
        if($('.slim-scroll').length){
            $('.slim-scroll').slimScroll({
                height: '426px'
            });
            $( '.slim-scroll' ).on( 'mousewheel DOMMouseScroll', function ( e ) {
                var e0 = e.originalEvent,
                    delta = e0.wheelDelta || -e0.detail;
            
                this.scrollTop += ( delta < 0 ? 1 : -1 ) * 30;
                e.preventDefault();
            });
        }
        setInterval(function(){
            updateSlackConversation();
        }, 180000);
    }

    if($('.toggle-session-speakers').length > 0){
        $('body').on('click', '.toggle-session-speakers', function(){
            $(this).next('ul').find('.speaker').toggle();
        });
    }


    if($('.timeline-agenda-list').length > 0){
        $('.timeline-agenda-list .aglist').each(function(index,item){
            var agenda_date_id = $(item).find('.session-join-btn').data('agenda_date_id');
            if(window.localStorage.getItem('agenda_verification_'+agenda_date_id) != '1'){
                console.log("not login : "+agenda_date_id);
            }else{
                console.log("login : "+agenda_date_id);
                $(item).addClass('login');
            }
        });
    }

    var search_request;
    $('body').on('input', '#searchInput', function(){
        var $keyword = $(this).val();
        $('#search-result-count').text(0);
        $('#search-results-posts').html('');
        $('#search-results-users').html('');
        if($keyword.length > 3){
            if(typeof search_request !== 'undefined'){
                search_request.abort();
            } 
            search_request = $.ajax({
                data: 'action=get_search_results_callback&keyword=' + $keyword,
                type: "POST",
                url: myAjaxObject.ajax_url,
                success: function(res){
                    var result = (res != '') ? $.parseJSON(res) : [];
                    $('#search-result-count').text(result.count);
                    $('#search-results-posts').html(result.posts_html);
                    $('#search-results-users').html(result.users_html);
                    $('#search_result_container').show();
                }
            });
        }
    });

    if($('#hompage-upcoming-events').length){
        $.ajax({
            data: 'action=get_events_for_homepage_callback',
            type: "POST",
            url: myAjaxObject.ajax_url,
            success: function(res){
                $('#hompage-upcoming-events').html(res);
                if($('.card-slider').length){
                    $('.card-slider').slick({
                        infinite: true,
                        slidesToShow: 3,
                        slidesToScroll: 3,
                        arrows: true,
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 2,
                                    infinite: true,
                                    arrows: false
                                }
                            },
                            {
                                breakpoint: 600,
                                settings: {
                                    slidesToShow: 2,
                                    slidesToScroll: 2
                                }
                            },
                            {
                                breakpoint: 480,
                                settings: {
                                    slidesToShow: 1,
                
                                    slidesToScroll: 1
                                }
                            }
                
                        ]
                    });
                }
            }
        });
    }

    if($('#homepage-blog-area').length){
        $.ajax({
            data: 'action=blog_area_for_homepage_callback',
            type: "POST",
            url: myAjaxObject.ajax_url,
            success: function(res){
                $('#homepage-blog-area').html(res);
            }
        });
    }

    if($('#hompage-banner').length){
        $.ajax({
            data: 'action=banner_for_homepage_callback',
            type: "POST",
            url: myAjaxObject.ajax_url,
            success: function(res){
                $('#hompage-banner').html(res);
                if($('.home-slider-container').length){
                    $('.home-slider-container').slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        autoplay: false,
                        responsive: [
                            {
                                breakpoint: 1024,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1,
                                    infinite: true,
                                    arrows: true
                                }
                            },
                            {
                                breakpoint: 600,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                }
                            },
                            {
                                breakpoint: 480,
                                settings: {
                                    slidesToShow: 1,
                                    slidesToScroll: 1
                                }
                            }
                
                        ]
                    });
                }
                if($('.slick-nav-slider').length){
                    $('.slick-nav-slider').slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        initialSlide: 1,
                        autoplay: false,
                        dots: false
                    });
                }
                $('#slider_loader').fadeOut('slow', function () {
                    $('.home-slider-container').css('visibility', 'visible');
                });
                $('.slick-nav-slider .slick-next').on('click', function () {
                    $(".home-slider-container, .slick-nav-slider").slick('slickNext');
                });
                $('.slick-nav-slider .slick-prev').on('click', function () {
                    $(".home-slider-container, .slick-nav-slider").slick('slickPrev');
                });
            }
        });
    }
    

});

function TimeConvert(time){
    var hours = Number(time.match(/^(\d+)/)[1]);
    var minutes = Number(time.match(/:(\d+)/)[1]);
    var AMPM = time.match(/\s(.*)$/)[1];
    if(AMPM == "PM" && hours<12) hours = hours+12;
    if(AMPM == "AM" && hours==12) hours = hours-12;
    var sHours = hours.toString();
    var sMinutes = minutes.toString();
    if(hours<10) sHours = "0" + sHours;
    if(minutes<10) sMinutes = "0" + sMinutes;
    var NewTime = sHours + ":" + sMinutes;
    var MS = Number(NewTime.split(':')[0])*60+Number(NewTime.split(':')[1])*1000;

    return MS;
}

function create_calendar_url(location_id, program_id) {
    location_id = (typeof location_id !== 'undefined') ? location_id : jQuery('.btn--location.active').data('id');
    program_id = (typeof program_id !== 'undefined') ? program_id : jQuery('.btn--program.active').data('id');
    var url = location.protocol + '//' + location.hostname + (location.port ? ':' + location.port : '') + '/add-to-calendar';
    url += '?loc=' + ((Number.isInteger(location_id)) ? location_id : '');
    url += '&prog=' + ((Number.isInteger(program_id)) ? program_id : '');
    url += '&noCache';
    jQuery('#add_to_calendar_url').val(url);
}

function validateEmail(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}


function evCheckout(buttonId, eventId, discountCode) {
    if (
        buttonId != '' && typeof buttonId !== 'undefined' &&
        eventId != '' && typeof eventId !== 'undefined'
    ) {
        var __evArgs = {
            widgetType: "checkout",
            eventId: eventId,
            modal: true,
            modalTriggerElementId: buttonId,
            onOrderComplete: function () {
                console.log('Order complete!');
            }
        };
        if (
            discountCode != '' &&
            typeof discountCode !== 'undefined'
        ) {
            Object.assign(
                __evArgs,
                {
                    promoCode: discountCode
                }
            );
        }
        if(typeof window.EBWidgets !== 'undefined'){
            window.EBWidgets.createWidget(__evArgs);
        }
    }
    return false;
}

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function removeCookie(cname) {
    document.cookie = cname + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
}

function updateSlackConversation() {
    if(slackUpdating == false){
        slackUpdating = true;
        var $loader = document.querySelector('.messages-container .loader'),
            xhttp = new XMLHttpRequest();
        $($loader).show();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                $('.messages-container').html($loader.outerHTML + this.responseText);
                setTimeout(function(){
                    $('.messages-container .loader').hide();
                }, 1000);
                slackUpdating = false;
            }
        };
        xhttp.open('POST', myAjaxObject.ajax_url + '?action=update_slack_conversation&channel_id=' + $('[name="slack_channel_id"]').val(), true);
        xhttp.send();
    }
}
function openNav() { 
    document.getElementById("myNav").style.width = "100%";
    $('html').css('overflow-y',"hidden");
    $('#searchInput').focus();
}
  
function closeNav() {
    document.getElementById("myNav").style.width = "0%";
    $('html').css('overflow-y',"auto");
    $('#searchInput').val('');
    $('#search-results-users, #search-results-posts').html('');
    $('#search-result-count').html(0);
}