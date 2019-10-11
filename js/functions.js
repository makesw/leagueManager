"use strict";

(function ($) {
    var $window = $(window);
    var window_width = $window.outerWidth();
    var $body = $('body');
    var drawers = {
        states: {},
        readableName: function (handle) {
            return handle.replace(/\s|-|\.|#+/g, '_').toLowerCase();
        },
        init: function (handle, options) {
            var defaults = {
                easyClose: true,
                menuWidth: "280px",
                beforeOpen: function () {
                    $(".menu-backdrop").toggle();
                    $(".menu-backdrop").toggleClass("in");
                },
                afterClose: function () {
                    $(".menu-backdrop").toggle();
                    $(".menu-backdrop").toggleClass("in");
                }
            };
            
            if(options && typeof options === 'object') {
                options = $.extend(defaults, options);
            } else {
                options = defaults;
            }
            
            var handleName = this.readableName(handle);
            
            if ($(handle).length > 0) {
                this.states[handleName] = $(handle).bigSlide(options);
            }
        },
        destroy: function (handle) {
            var handleName = this.readableName(handle);
            if (this.states[handleName] && typeof this.states[handleName] !== 'undefined') {
                this.states[handleName].bigSlideAPI.destroy();
                this.states[handleName] = undefined;
            }
        }
    };
    
    $window.on('load', function () {
        // PAGE IS FULLY LOADED
        // FADE OUT YOUR OVERLAYING DIV
        $(".loader-backdrop").fadeOut('normal');
    });

    var current_path = window.location.pathname.split('/').pop();
    if (current_path == '') {
        current_path = 'index.html';
    }
    var $current_menu = $('a[href="' + current_path + '"]');

    if ($current_menu.length > 0) {
        $('li.menu').removeClass('open selected');
        $('.main-menu li').removeClass('active open selected');

        if ($current_menu.parent().hasClass('menu')) {
            $current_menu.parent().addClass('open selected');
        } else {
            $current_menu.parent().addClass('active').parents('.menu').addClass('open selected');
        }
    }

    var slideDuration = 250;
    $("ul.nav-menu > li.menu").on("click", function () {
        var menuLi = this;
        $("ul.nav-menu > li.menu").not(menuLi).removeClass("open");
        $("ul.nav-menu > li.menu ul").not($("ul", menuLi)).slideUp(slideDuration);
        $(" > ul", menuLi).slideToggle(slideDuration, function () {
            $(menuLi).toggleClass("open");
        });
    });

    $("ul.sub-menu li").on('click', function (e) {
        var $current_sm_li = $(this);
        var $current_sm_li_parent = $current_sm_li.parent();

        if ($current_sm_li_parent.parent().hasClass("active")) {
            console.log('has parent');
            $("li ul", $current_sm_li_parent).not($("ul", $current_sm_li)).slideUp(slideDuration, function () {
                $("li", $current_sm_li_parent).not($current_sm_li).removeClass("active");
            });

        } else {
            $("ul.sub-menu li ul").not($(" ul", $current_sm_li)).slideUp(slideDuration, function () {
                //$("ul.sub-menu li").not($current_sm_li).removeClass("active");console.log('has not parent');
            });
        }

        $(" > ul", $current_sm_li).slideToggle(slideDuration, function () {
            $($current_sm_li).toggleClass("active");
        });

        e.stopPropagation();
    });
    
    //vector Map
    if ($.isFunction($.fn.vectorMap)) {
        if ($('#vmap').length > 0) {
            $('#vmap').vectorMap({map: 'world_en'});
        }
    }

    //popover
    $('[data-toggle="popover"]').popover();

    //tooltip
    $('[data-toggle="tooltip"]').tooltip();
    
    // color theme panel
    drawers.init('#colorTheme, #close-setting-panel', {menu: '#colorSidebar', side: "right"});

    /* ============================================================================================
     Theme Settings
     ==============================================================================================*/
    var current_theme = $body.data('theme');
    $body.addClass(current_theme);

    // set active theme option in settings
    $('.gx-theme').each(function () {
        var datatheme = $(this).data('theme');

        if (datatheme == current_theme) {
            $(this).addClass('active');
        }
    });

    // change theme on click theme selecter option
    $('.gx-theme').on('click', function (event) {
        event.preventDefault();

        var dark_theme = $('#switch-dark-theme').data('theme');
        $body.removeClass(dark_theme + '-theme');

        // get cuurent theme
        var $theme_selected = $('.gx-theme.active');
        current_theme = $theme_selected.data('theme');
        $theme_selected.removeClass('active');

        // set new theme and active
        var new_theme = $(this).data('theme');
        $body.removeClass(current_theme).addClass(new_theme);

        $(this).addClass('active');
        $("#override-css-id").attr("href", "css/theme-" + new_theme + ".min.css");

        $('#switch-dark-theme').prop('checked', false);
    });

    $('#switch-dark-theme').on('change', function () {
        var dark_theme = $(this).data('theme');

        if ($(this).is(':checked')) {
            // get cuurent theme
            var $theme_selected = $('.gx-theme.active');

            if ($theme_selected.length > 0) {
                current_theme = $theme_selected.data('theme');
                $theme_selected.removeClass('active');
                $body.removeClass(current_theme);
            }

            $body.addClass(dark_theme + '-theme');
            $("#override-css-id").attr("href", "css/theme-" + dark_theme + ".min.css");
        } else {
            $body.removeClass(dark_theme + '-theme').addClass(current_theme);
            if (current_theme) {
                $("#override-css-id").attr("href", "css/theme-" + current_theme + ".min.css");
            }

            // set active theme option in settings
            $('.gx-theme').each(function () {
                var datatheme = $(this).data('theme');

                if (datatheme == current_theme) {
                    $(this).addClass('active');
                }
            });
        }
    });
    
    /* ============================================================================================
     Scrollbar Settings
     ==============================================================================================*/
    if ($.isFunction(PerfectScrollbar)) {
        var scOptions = {
            wheelSpeed: 2
        };

        new PerfectScrollbar('.main-menu', scOptions);
        new PerfectScrollbar('.gx-main-content', scOptions);
        new PerfectScrollbar('.dropdown-menu-perfectscrollbar', scOptions);
        new PerfectScrollbar('.dropdown-menu-perfectscrollbar1', scOptions);
        new PerfectScrollbar('.color-theme-body', scOptions);

        $('.ps-custom-scrollbar').each(function () {
            new PerfectScrollbar(this, scOptions);
        });
    }

    // Add slideUp animation to Bootstrap dropdown when collapsing.
    $('.dropdown, .split-dropdown').on('show.bs.dropdown', function () {
        $(this).find('.dropdown-menu').first().stop(true, true).slideDown(200);
    });

    $('.dropdown, .split-dropdown').on('hide.bs.dropdown', function () {
        $(this).find('.dropdown-menu').first().stop(true, true).slideUp(200);
    });

    if (window_width < 992) {
        drawers.init('.menu-toggle');
        drawers.init('#gxModuleSideNav', {menu: '#gxModuleSidebar', menuWidth: "230px"});
        drawers.init('#gxChatModuleSideNav', {menu: '#gxChatModuleSidebar'});
    } else {
        drawers.destroy('.menu-toggle');
        drawers.destroy('#gxModuleSideNav');
        drawers.destroy('#gxChatModuleSideNav');
    }

    $window.on('resize', function () {
        window_width = $window.outerWidth();
        if (window_width < 992) {
            drawers.init('.menu-toggle');
            drawers.init('#gxModuleSideNav', {menu: '#gxModuleSidebar', menuWidth: "230px"});
            drawers.init('#gxChatModuleSideNav', {menu: '#gxChatModuleSidebar'});
        } else {
            drawers.destroy('.menu-toggle');
            drawers.destroy('#gxModuleSideNav');
            drawers.destroy('#gxChatModuleSideNav');
        }
    });

})(jQuery);