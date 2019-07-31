(function($) {
    'use strict';

    var shortcodes = {};

    mkdf.modules.shortcodes = shortcodes;

    shortcodes.mkdfInitCounter = mkdfInitCounter;
    shortcodes.mkdfInitProgressBars = mkdfInitProgressBars;
    shortcodes.mkdfInitCountdown = mkdfInitCountdown;
    shortcodes.mkdfInitMessages = mkdfInitMessages;
    shortcodes.mkdfInitTestimonials = mkdfInitTestimonials;
    shortcodes.mkdfInitCarousels = mkdfInitCarousels;
    shortcodes.mkdfInitPieChart = mkdfInitPieChart;
    shortcodes.mkdfInitPieChartDoughnut = mkdfInitPieChartDoughnut;
    shortcodes.mkdfInitTabs = mkdfInitTabs;
    shortcodes.mkdfInitTabIcons = mkdfInitTabIcons;
    shortcodes.mkdfInitBlogListMasonry = mkdfInitBlogListMasonry;
    shortcodes.mkdfCustomFontResize = mkdfCustomFontResize;
    shortcodes.mkdfInitImageGallery = mkdfInitImageGallery;
    shortcodes.mkdfInitAccordions = mkdfInitAccordions;
    shortcodes.mkdfShowGoogleMap = mkdfShowGoogleMap;
    shortcodes.mkdfInfoBox = mkdfInfoBox;
    shortcodes.mkdfProcess = mkdfProcess;
    shortcodes.blogCarousel = blogCarousel;
    shortcodes.mkdfComparisonPricingTables = mkdfComparisonPricingTables;
    shortcodes.mkdfProgressBarVertical = mkdfProgressBarVertical;
    shortcodes.mkdfIconProgressBar = mkdfIconProgressBar;
    shortcodes.mkdfBlogSlider = mkdfBlogSlider;
    shortcodes.mkdfOnDocumentReady = mkdfOnDocumentReady;
    shortcodes.mkdfOnWindowLoad = mkdfOnWindowLoad;
    shortcodes.mkdfOnWindowResize = mkdfOnWindowResize;
    shortcodes.mkdfOnWindowScroll = mkdfOnWindowScroll;
    shortcodes.emptySpaceResponsive = emptySpaceResponsive;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitCounter();
        mkdfInitElementsHolderResponsiveStyle();
        mkdfInitProgressBars();
        mkdfInitCountdown();
        mkdfIcon().init();
        mkdfInitMessages();
        mkdfInitTestimonials();
	    mkdfInitMasonryGallery();
        mkdfInitCarousels();
        mkdfInitPieChart();
        mkdfInitPieChartDoughnut();
        mkdfInitTabs();
        mkdfInitTabIcons();
        blogCarousel();
        mkdfButton().init();
        mkdfInitBlogListMasonry();
        mkdfCustomFontResize();
        mkdfInitImageGallery();
        mkdfBlogSlider();
        mkdfInitAccordions();
        mkdfShowGoogleMap();
        mkdfSocialIconWidget().init();
        mkdfInitIconList().init();
        mkdfProcess().init();
        mkdfComparisonPricingTables().init();
        mkdfProgressBarVertical().init();
        mkdfIconProgressBar().init();
        emptySpaceResponsive().init();
    }

    /* 
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInfoBox();
    }

    /* 
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {
        mkdfInitBlogListMasonry();
        mkdfCustomFontResize();
    }

    /* 
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {

    }

    /**
     * Counter Shortcode
     */
    function mkdfInitCounter() {
        var counterHolder = $('.mkdf-counter-holder');

        if (counterHolder.length) {
            counterHolder.each(function() {
                var thisCounterHolder = $(this),
                    thisCounter = thisCounterHolder.find('.mkdf-counter');

                thisCounterHolder.appear(function() {
                    thisCounterHolder.css('opacity', '1');

                    //Counter zero type
                    if (thisCounter.hasClass('mkdf-zero-counter')) {
                        var max = parseFloat(thisCounter.text());
                        thisCounter.countTo({
                            from: 0,
                            to: max,
                            speed: 1500,
                            refreshInterval: 100
                        });
                    } else {
                        thisCounter.absoluteCounter({
                            speed: 2000,
                            fadeInDelay: 1000
                        });
                    }
                },{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            });
        }
    }
    
    /*
     **	Elements Holder responsive style
     */
    function mkdfInitElementsHolderResponsiveStyle(){
        var elementsHolder = $('.mkdf-elements-holder');
        
        if(elementsHolder.length){
            elementsHolder.each(function() {
                var thisElementsHolder = $(this),
                    elementsHolderItem = thisElementsHolder.children('.mkdf-eh-item'),
                    style = '',
                    responsiveStyle = '';
                
                elementsHolderItem.each(function() {
                    var thisItem = $(this),
                        itemClass = '',
                        largeLaptop = '',
                        smallLaptop = '',
                        ipadLandscape = '',
                        ipadPortrait = '',
                        mobileLandscape = '',
                        mobilePortrait = '';
                    
                    if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
                        itemClass = thisItem.data('item-class');
                    }
                    if (typeof thisItem.data('1280-1600') !== 'undefined' && thisItem.data('1280-1600') !== false) {
                        largeLaptop = thisItem.data('1280-1600');
                    }
                    if (typeof thisItem.data('1024-1280') !== 'undefined' && thisItem.data('1024-1280') !== false) {
                        smallLaptop = thisItem.data('1024-1280');
                    }
                    if (typeof thisItem.data('768-1024') !== 'undefined' && thisItem.data('768-1024') !== false) {
                        ipadLandscape = thisItem.data('768-1024');
                    }
                    if (typeof thisItem.data('600-768') !== 'undefined' && thisItem.data('600-768') !== false) {
                        ipadPortrait = thisItem.data('600-768');
                    }
                    if (typeof thisItem.data('480-600') !== 'undefined' && thisItem.data('480-600') !== false) {
                        mobileLandscape = thisItem.data('480-600');
                    }
                    if (typeof thisItem.data('480') !== 'undefined' && thisItem.data('480') !== false) {
                        mobilePortrait = thisItem.data('480');
                    }
                    
                    if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {
                        
                        if(largeLaptop.length) {
                            responsiveStyle += "@media only screen and (min-width: 1280px) and (max-width: 1600px) {.mkdf-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
                        }
                        if(smallLaptop.length) {
                            responsiveStyle += "@media only screen and (min-width: 1024px) and (max-width: 1280px) {.mkdf-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
                        }
                        if(ipadLandscape.length) {
                            responsiveStyle += "@media only screen and (min-width: 768px) and (max-width: 1024px) {.mkdf-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
                        }
                        if(ipadPortrait.length) {
                            responsiveStyle += "@media only screen and (min-width: 600px) and (max-width: 768px) {.mkdf-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
                        }
                        if(mobileLandscape.length) {
                            responsiveStyle += "@media only screen and (min-width: 480px) and (max-width: 600px) {.mkdf-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
                        }
                        if(mobilePortrait.length) {
                            responsiveStyle += "@media only screen and (max-width: 480px) {.mkdf-eh-item-content."+itemClass+" { padding: "+mobilePortrait+" !important; } }";
                        }
                    }
                });
                
                if(responsiveStyle.length) {
                    style = '<style type="text/css" data-type="gotravel_shortcodes_custom_css">'+responsiveStyle+'</style>';
                }
                
                if(style.length) {
                    $('head').append(style);
                }
            });
        }
    }

    /*
     **	Horizontal progress bars shortcode
     */
    function mkdfInitProgressBars() {
        var progressBar = $('.mkdf-progress-bar');

        if(progressBar.length) {
            progressBar.each(function() {
                var thisBar = $(this);

                thisBar.appear(function() {
                    mkdfInitToCounterProgressBar(thisBar);
                    
                    var percentage = thisBar.find('.mkdf-progress-content').data('percentage'),
                        progressContent = thisBar.find('.mkdf-progress-content'),
                        progressNumber = thisBar.find('.mkdf-progress-number');

                    progressContent.css('width', '0%');
                    progressContent.animate({'width': percentage + '%'}, 1500);
                    progressNumber.css('left', '0%');
                    progressNumber.animate({'left': percentage + '%'}, 1500);
                });
            });
        }
    }

    /*
     **	Counter for horizontal progress bars percent from zero to defined percent
     */
    function mkdfInitToCounterProgressBar(progressBar) {
        var percentage = parseFloat(progressBar.find('.mkdf-progress-content').data('percentage'));
        var percent = progressBar.find('.mkdf-progress-number .mkdf-percent');
        if(percent.length) {
            percent.each(function() {
                var thisPercent = $(this);
                thisPercent.parents('.mkdf-progress-number-wrapper').css('opacity', '1');
                thisPercent.countTo({
                    from: 0,
                    to: percentage,
                    speed: 1500,
                    refreshInterval: 50
                });
            });
        }
    }

    /*
     **	Function to close message shortcode
     */
    function mkdfInitMessages() {
        var message = $('.mkdf-message');
        if(message.length) {
            message.each(function() {
                var thisMessage = $(this);
                thisMessage.find('.mkdf-close').click(function(e) {
                    e.preventDefault();
                    $(this).parent().parent().fadeOut(500);
                });
            });
        }
    }

    /**
     * Countdown Shortcode
     */
    function mkdfInitCountdown() {

        var countdowns = $('.mkdf-countdown'),
            year,
            month,
            day,
            hour,
            minute,
            timezone,
            monthLabel,
            dayLabel,
            hourLabel,
            minuteLabel,
            secondLabel;

        if(countdowns.length) {
            countdowns.each(function() {
                //Find countdown elements by id-s
                var countdownId = $(this).attr('id'),
                    countdown = $('#' + countdownId),
                    digitFontSize,
                    labelFontSize;

                //Get data for countdown
                year = countdown.data('year');
                month = countdown.data('month');
                day = countdown.data('day');
                hour = countdown.data('hour');
                minute = countdown.data('minute');
                timezone = countdown.data('timezone');
                monthLabel = countdown.data('month-label');
                dayLabel = countdown.data('day-label');
                hourLabel = countdown.data('hour-label');
                minuteLabel = countdown.data('minute-label');
                secondLabel = countdown.data('second-label');
                digitFontSize = countdown.data('digit-size');
                labelFontSize = countdown.data('label-size');


                //Initialize countdown
                countdown.countdown({
                    until: new Date(year, month - 1, day, hour, minute, 44),
                    labels: ['Years', monthLabel, 'Weeks', dayLabel, hourLabel, minuteLabel, secondLabel],
                    format: 'ODHMS',
                    timezone: timezone,
                    padZeroes: true,
                    onTick: setCountdownStyle
                });

                function setCountdownStyle() {
                    countdown.find('.countdown-amount').css({
                        'font-size': digitFontSize + 'px',
                        'line-height': digitFontSize + 'px'
                    });
                    countdown.find('.countdown-period').css({
                        'font-size': labelFontSize + 'px'
                    });
                }
            });
        }
    }

    /**
     * Object that represents icon shortcode
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var mkdfIcon = mkdf.modules.shortcodes.mkdfIcon = function() {
        //get all icons on page
        var icons = $('.mkdf-icon-shortcode');

        /**
         * Function that triggers icon animation and icon animation delay
         */
        var iconAnimation = function(icon) {
            if(icon.hasClass('mkdf-icon-animation')) {
                icon.appear(function() {
                    icon.parent('.mkdf-icon-animation-holder').addClass('mkdf-icon-animation-show');
                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            }
        };

        /**
         * Function that triggers icon hover color functionality
         */
        var iconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon.find('.mkdf-icon-element');
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        /**
         * Function that triggers icon holder background color hover functionality
         */
        var iconHolderBackgroundHover = function(icon) {
            if(typeof icon.data('hover-background-color') !== 'undefined') {
                var changeIconBgColor = function(event) {
                    event.data.icon.css('background-color', event.data.color);
                };

                var hoverBackgroundColor = icon.data('hover-background-color');
                var originalBackgroundColor = icon.css('background-color');

                if(hoverBackgroundColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
                    icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
                }
            }
        };

        /**
         * Function that initializes icon holder border hover functionality
         */
        var iconHolderBorderHover = function(icon) {
            if(typeof icon.data('hover-border-color') !== 'undefined') {
                var changeIconBorder = function(event) {
                    event.data.icon.css('border-color', event.data.color);
                };

                var hoverBorderColor = icon.data('hover-border-color');
                var originalBorderColor = icon.css('border-color');

                if(hoverBorderColor !== '') {
                    icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
                    icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        iconAnimation($(this));
                        iconHoverColor($(this));
                        iconHolderBackgroundHover($(this));
                        iconHolderBorderHover($(this));
                    });

                }
            }
        };
    };

    /**
     * Object that represents social icon widget
     * @returns {{init: Function}} function that initializes icon's functionality
     */
    var mkdfSocialIconWidget = mkdf.modules.shortcodes.mkdfSocialIconWidget = function() {
        //get all social icons on page
        var icons = $('.mkdf-social-icon-widget-holder');

        /**
         * Function that triggers icon hover color functionality
         */
        var socialIconHoverColor = function(icon) {
            if(typeof icon.data('hover-color') !== 'undefined') {
                var changeIconColor = function(event) {
                    event.data.icon.css('color', event.data.color);
                };

                var iconElement = icon;
                var hoverColor = icon.data('hover-color');
                var originalColor = iconElement.css('color');

                if(hoverColor !== '') {
                    icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
                    icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
                }
            }
        };

        return {
            init: function() {
                if(icons.length) {
                    icons.each(function() {
                        socialIconHoverColor($(this));
                    });

                }
            }
        };
    };

    /**
     * Init testimonials shortcode
     */
    function mkdfInitTestimonials() {

        var testimonial = $('.mkdf-testimonials.testimonials-slider');
        if(testimonial.length) {
            testimonial.each(function() {

                var thisTestimonial = $(this);

                thisTestimonial.waitForImages(function(){
                    thisTestimonial.css('visibility','visible');
                });

                var animationSpeed = 400;
                if(typeof thisTestimonial.data('animation-speed') !== 'undefined' && thisTestimonial.data('animation-speed') !== false) {
                    animationSpeed = thisTestimonial.data('animation-speed');
                }

                if (!thisTestimonial.hasClass('owl-carousel')) {
                    thisTestimonial.addClass('owl-carousel');
                }

                thisTestimonial.owlCarousel({
                    items: 1,
                    autoHeight: true,
                    autoplay:true,
                    autoplayTimeout: 3000,
                    autoplayHoverPause: true,
                    loop:true,
                    nav: false,
                    dots: true,
                    smartSpeed: animationSpeed,
                    animateIn: 'fadeInRight',
                    animateOut: 'fadeOutLeft',
                });
            });
        }
    }
    
    /**
     * Masonry gallery, init masonry and resize pictures in grid
     */
    function mkdfInitMasonryGallery(){
        
        var galleryHolder = $('.mkdf-masonry-gallery-holder'),
            gallery = galleryHolder.children('.mkdf-mg-inner'),
            gallerySizer = gallery.children('.mkdf-mg-grid-sizer');
        
        resizeMasonryGallery(gallerySizer.outerWidth(), gallery);
        
        if(galleryHolder.length){
            galleryHolder.each(function(){
                var holder = $(this),
                    holderGallery = holder.children('.mkdf-mg-inner');
                
                holderGallery.waitForImages(function(){
                    holderGallery.animate({opacity:1});
                    
                    holderGallery.isotope({
                        layoutMode: 'packery',
                        itemSelector: '.mkdf-mg-item',
                        percentPosition: true,
                        packery: {
                            gutter: '.mkdf-mg-grid-gutter',
                            columnWidth: '.mkdf-mg-grid-sizer'
                        }
                    });
                });
            });
            
            $(window).resize(function(){
                resizeMasonryGallery(gallerySizer.outerWidth(), gallery);
                
                gallery.isotope('reloadItems');
            });
        }
    }
    
    function resizeMasonryGallery(size, holder){
        
        var rectangle_portrait = holder.find('.mkdf-mg-rectangle-portrait'),
            rectangle_landscape = holder.find('.mkdf-mg-rectangle-landscape'),
            square_big = holder.find('.mkdf-mg-square-big'),
            square_small = holder.find('.mkdf-mg-square-small');
        
        rectangle_portrait.css('height', 2*size);
        
        if (window.innerWidth <= 680) {
            rectangle_landscape.css('height', size/2);
        } else {
            rectangle_landscape.css('height', size);
        }
        
        square_big.css('height', 2*size);
        
        if (window.innerWidth <= 680) {
            square_big.css('height', square_big.width());
        }
        
        square_small.css('height', size);
    }

    /**
     * Init Carousel shortcode
     */
    function mkdfInitCarousels() {
        var carouselHolders = $('.mkdf-carousel-holder'),
            carousel,
            numberOfItems;

        if(carouselHolders.length) {
            carouselHolders.each(function() {
                carousel = $(this).find('.mkdf-carousel');
                numberOfItems = carousel.data('items');

                var showNav = carousel.data('navigation');

                if(typeof showNav !== 'undefined') {
                    showNav = showNav === 'yes';
                } else {
                    showNav = false;
                }

                carousel.waitForImages(function(){
                    carousel.css('visibility','visible');
                    
                    if (!carousel.hasClass('owl-carousel')) {
                        carousel.addClass('owl-carousel');
                    }
                
	                carousel.owlCarousel({
                        autoplayInterval: 3000,
                        autoplayHoverPause: true,
	                    loop:true,
                        smartSpeed: 600,
	                    items: numberOfItems,
		                margin: 26,
	                    responsive:{
	                        0:{
	                            items: 1
	                        },
	                        480:{
	                            items: 2
	                        },
	                        768:{
	                            items: 3
	                        },
	                        1025:{
	                            items: numberOfItems
	                        }
	                    },
                        nav: showNav,
	                    dots: false,
	                    navText: [
	                        '<span class="mkdf-prev-icon"><i class="lnr lnr-chevron-left"></i></span>',
	                        '<span class="mkdf-next-icon"><i class="lnr lnr-chevron-right"></i></span>'
	                    ]
	                });
                });
            });
        }
    }

    /**
     * Init Pie Chart and Pie Chart With Icon shortcode
     */
    function mkdfInitPieChart() {

        var pieCharts = $('.mkdf-pie-chart-holder, .mkdf-pie-chart-with-icon-holder');

        if(pieCharts.length) {

            pieCharts.each(function() {

                var pieChart = $(this),
                    percentageHolder = pieChart.children('.mkdf-percentage, .mkdf-percentage-with-icon'),
                    barColor,
                    trackColor,
                    lineWidth,
                    size = 155;

                if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
                    barColor = pieChart.data('bar-color');
                }

                if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
                    trackColor = pieChart.data('track-color');
                }

                if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
                    size = pieChart.data('size');
                }

                percentageHolder.appear(function() {
                    initToCounterPieChart(pieChart);
                    percentageHolder.css('opacity', '1');

                    percentageHolder.easyPieChart({
                        barColor: barColor,
                        trackColor: trackColor,
                        scaleColor: false,
                        lineCap: 'butt',
                        lineWidth: 6,
                        animate: 1500,
                        size: size
                    });
                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});

            });

        }

    }

    /*
     **	Counter for pie chart number from zero to defined number
     */
    function initToCounterPieChart(pieChart) {

        pieChart.css('opacity', '1');
        var counter = pieChart.find('.mkdf-to-counter'),
            max = parseFloat(counter.text());
        counter.countTo({
            from: 0,
            to: max,
            speed: 1500,
            refreshInterval: 50
        });

    }

    /**
     * Init Pie Chart shortcode
     */
    function mkdfInitPieChartDoughnut() {

        var pieCharts = $('.mkdf-pie-chart-doughnut-holder, .mkdf-pie-chart-pie-holder');

        pieCharts.each(function() {

            var pieChart = $(this),
                canvas = pieChart.find('canvas'),
                chartID = canvas.attr('id'),
                chart = document.getElementById(chartID).getContext('2d'),
                data = [],
                jqChart = $(chart.canvas); //Convert canvas to JQuery object and get data parameters

            for(var i = 1; i <= 10; i++) {

                var chartItem,
                    value = jqChart.data('value-' + i),
                    color = jqChart.data('color-' + i);

                if(typeof value !== 'undefined' && typeof color !== 'undefined') {
                    chartItem = {
                        value: value,
                        color: color
                    };
                    data.push(chartItem);
                }

            }

            if(canvas.hasClass('mkdf-pie')) {
                new Chart(chart).Pie(data,
                    {segmentStrokeColor: 'transparent'}
                );
            } else {
                new Chart(chart).Doughnut(data,
                    {segmentStrokeColor: 'transparent'}
                );
            }

        });

    }

    /*
     **	Init tabs shortcode
     */
    function mkdfInitTabs() {

        var tabs = $('.mkdf-tabs');
        if(tabs.length) {
            tabs.each(function() {
                var thisTabs = $(this);

                thisTabs.children('.mkdf-tab-container').each(function(index) {
                    index = index + 1;
                    var that = $(this),
                        link = that.attr('id'),
                        navItem = that.parent().find('.mkdf-tabs-nav li:nth-child(' + index + ') a'),
                        navLink = navItem.attr('href');

                    link = '#' + link;

                    if(link.indexOf(navLink) > -1) {
                        navItem.attr('href', link);
                    }
                });

                if(thisTabs.hasClass('mkdf-horizontal') || thisTabs.hasClass('mkdf-horizontal-boxed')) {
                    thisTabs.tabs();
                }
                else if(thisTabs.hasClass('mkdf-vertical')) {
                    thisTabs.tabs().addClass('ui-tabs-vertical ui-helper-clearfix');
                    thisTabs.find('.mkdf-tabs-nav > ul >li').removeClass('ui-corner-top').addClass('ui-corner-left');
                }   

                //horizontal tabs
                if(thisTabs.hasClass('mkdf-horizontal')){
                    var tab = thisTabs.find('li'),
                        tabLine = thisTabs.find('.mkdf-tab-line');

                    tabLine.css({width: tab.first().find('> a').outerWidth()});
                    tabLine.css({left: 0});

                    if (tab.height() == tab.parent('ul').height()) { //tabs are in the same line, default layout
                        tab.each(function(){
                            var thisTab = $(this);
                            thisTab.mouseenter(function(){
                                tabLine.css({width: thisTab.find('> a').outerWidth()});
                                tabLine.css({left: thisTab.offset().left - thisTab.parent().offset().left});
                            });
                        });

                        thisTabs.find('> ul').mouseleave(function(){
                            tabLine.css({width: tab.filter('.ui-tabs-active').find('> a').outerWidth()});
                            tabLine.css({left: tab.filter('.ui-tabs-active').find('> a').offset().left - tab.filter('.ui-tabs-active').parent().offset().left});
                        });
                    } else { //tabs are on top of each other, responsive layout
                        tab.each(function(){
                            tabLine.css({width: '100%'});
                            var thisTab = $(this);
                            thisTab.click(function(){
                                tabLine.css({top: thisTab.offset().top - thisTab.parent().offset().top + thisTab.height() - 3}); // 3 tabLine height
                            });
                        });
                    }
                }
                //vertical tabs
                if(thisTabs.hasClass('mkdf-vertical')){
                    var tab = thisTabs.find('li'),
                        tabLineV = thisTabs.find('.mkdf-tab-line');
    
                    tabLineV.css({height: tab.first().find('> a').outerHeight()});
                    tabLineV.css({top: 0});

                    tab.each(function(){
                        var thisTab = $(this);
                        thisTab.mouseenter(function(){
                            tabLineV.css({height: thisTab.find('> a').outerHeight()});
                            tabLineV.css({top: thisTab.find('> a').offset().top - thisTab.parent().offset().top});
                        });
                    });

                    thisTabs.find('> ul').mouseleave(function(){
                        tabLineV.css({height: tab.filter('.ui-tabs-active').find('> a').outerHeight()});
                        tabLineV.css({top: tab.filter('.ui-tabs-active').find('> a').offset().top - tab.filter('.ui-tabs-active').parent().offset().top});
                    });
                }

            });
        }
    }

    /*
     **	Generate icons in tabs navigation
     */
    function mkdfInitTabIcons() {

        var tabContent = $('.mkdf-tab-container');
        if(tabContent.length) {

            tabContent.each(function() {
                var thisTabContent = $(this);

                var id = thisTabContent.attr('id');
                var icon = '';
                if(typeof thisTabContent.data('icon-html') !== 'undefined' || thisTabContent.data('icon-html') !== 'false') {
                    icon = thisTabContent.data('icon-html');
                }

                var tabNav = thisTabContent.parents('.mkdf-tabs').find('.mkdf-tabs-nav > li > a[href="#' + id + '"]');

                if(typeof(tabNav) !== 'undefined') {
                    tabNav.children('.mkdf-icon-frame').append(icon);
                }
            });
        }
    }

    /**
     * Button object that initializes whole button functionality
     * @type {Function}
     */
    var mkdfButton = mkdf.modules.shortcodes.mkdfButton = function() {
        //all buttons on the page
        var buttons = $('.mkdf-btn');

        /**
         * Initializes button hover color
         * @param button current button
         */
        var buttonHoverColor = function(button) {
            if(typeof button.data('hover-color') !== 'undefined') {
                var changeButtonColor = function(event) {
                    event.data.button.css('color', event.data.color);
                };

                var originalColor = button.css('color');
                var hoverColor = button.data('hover-color');

                button.on('mouseenter', {button: button, color: hoverColor}, changeButtonColor);
                button.on('mouseleave', {button: button, color: originalColor}, changeButtonColor);
            }
        };


        /**
         * Initializes button hover background color
         * @param button current button
         */
        var buttonHoverBgColor = function(button) {
            if(typeof button.data('hover-bg-color') !== 'undefined') {
                var changeButtonBg = function(event) {
                    event.data.button.css('background-color', event.data.color);
                };

                var originalBgColor = button.css('background-color');
                var hoverBgColor = button.data('hover-bg-color');

                button.on('mouseenter', {button: button, color: hoverBgColor}, changeButtonBg);
                button.on('mouseleave', {button: button, color: originalBgColor}, changeButtonBg);
            }
        };

        /**
         * Initializes button border color
         * @param button
         */
        var buttonHoverBorderColor = function(button) {
            if(typeof button.data('hover-border-color') !== 'undefined') {
                var changeBorderColor = function(event) {
                    event.data.button.css('border-color', event.data.color);
                };

                var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
                var hoverBorderColor = button.data('hover-border-color');

                button.on('mouseenter', {button: button, color: hoverBorderColor}, changeBorderColor);
                button.on('mouseleave', {button: button, color: originalBorderColor}, changeBorderColor);
            }
        };

        return {
            init: function() {
                if(buttons.length) {
                    buttons.each(function() {
                        buttonHoverColor($(this));
                        buttonHoverBgColor($(this));
                        buttonHoverBorderColor($(this));
                    });
                }
            }
        };
    };

    /*
     **	Init blog list masonry type
     */
    function mkdfInitBlogListMasonry() {
        var blogList = $('.mkdf-blog-list-holder.mkdf-masonry .mkdf-blog-list');
        if(blogList.length) {
            blogList.each(function() {
                var thisBlogList = $(this);
                thisBlogList.animate({opacity: 1});
                thisBlogList.isotope({
                    itemSelector: '.mkdf-blog-list-masonry-item',
                    masonry: {
                        columnWidth: '.mkdf-blog-list-masonry-grid-sizer',
                        gutter: '.mkdf-blog-list-masonry-grid-gutter'
                    }
                });
            });

        }
    }

    /*
     **	Custom Font resizing
     */
    function mkdfCustomFontResize() {
        var customFont = $('.mkdf-custom-font-holder');
        if(customFont.length) {
            customFont.each(function() {
                var thisCustomFont = $(this);
                var fontSize;
                var lineHeight;
                var coef1 = 1;
                var coef2 = 1;

                if(mkdf.windowWidth < 1200) {
                    coef1 = 0.8;
                }

                if(mkdf.windowWidth < 1000) {
                    coef1 = 0.7;
                }

                if(mkdf.windowWidth < 768) {
                    coef1 = 0.6;
                    coef2 = 0.7;
                }

                if(mkdf.windowWidth < 600) {
                    coef1 = 0.5;
                    coef2 = 0.6;
                }

                if(mkdf.windowWidth < 480) {
                    coef1 = 0.4;
                    coef2 = 0.5;
                }

                if(typeof thisCustomFont.data('font-size') !== 'undefined' && thisCustomFont.data('font-size') !== false) {
                    fontSize = parseInt(thisCustomFont.data('font-size'));

                    if(fontSize > 70) {
                        fontSize = Math.round(fontSize * coef1);
                    }
                    else if(fontSize > 35) {
                        fontSize = Math.round(fontSize * coef2);
                    }

                    thisCustomFont.css('font-size', fontSize + 'px');
                }

                if(typeof thisCustomFont.data('line-height') !== 'undefined' && thisCustomFont.data('line-height') !== false) {
                    lineHeight = parseInt(thisCustomFont.data('line-height'));

                    if(lineHeight > 70 && mkdf.windowWidth < 1200) {
                        lineHeight = '1.2em';
                    }
                    else if(lineHeight > 35 && mkdf.windowWidth < 768) {
                        lineHeight = '1.2em';
                    }
                    else {
                        lineHeight += 'px';
                    }

                    thisCustomFont.css('line-height', lineHeight);
                }
            });
        }
    }

    /*
     **	Show Google Map
     */
    function mkdfShowGoogleMap() {

        if($('.mkdf-google-map').length) {
            $('.mkdf-google-map').each(function() {

                var element = $(this);

                var customMapStyle;
                if(typeof element.data('custom-map-style') !== 'undefined') {
                    customMapStyle = element.data('custom-map-style');
                }

                var colorOverlay;
                if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
                    colorOverlay = element.data('color-overlay');
                }

                var saturation;
                if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
                    saturation = element.data('saturation');
                }

                var lightness;
                if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
                    lightness = element.data('lightness');
                }

                var zoom;
                if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
                    zoom = element.data('zoom');
                }

                var pin;
                if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
                    pin = element.data('pin');
                }

                var mapHeight;
                if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
                    mapHeight = element.data('height');
                }

                var uniqueId;
                if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
                    uniqueId = element.data('unique-id');
                }

                var scrollWheel;
                if(typeof element.data('scroll-wheel') !== 'undefined') {
                    scrollWheel = element.data('scroll-wheel');
                }

                var addresses;
                if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
                    addresses = element.data('addresses');
                }
    
                var locationMap;
                if(typeof element.data('location-map') !== 'undefined' && element.data('location-map') !== false && element.data('location-map') === 'yes') {
                    locationMap = true;
                }

                var map = "map_" + uniqueId;
                var geocoder = "geocoder_" + uniqueId;
                var holderId = "mkdf-map-" + uniqueId;

                mkdfInitializeGoogleMap(customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin, map, geocoder, addresses, locationMap);
            });
        }

    }

    /*
     **	Init Google Map
     */
    function mkdfInitializeGoogleMap(customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin, map, geocoder, data, locationMap) {

	    if(locationMap) {
		    var mapStyles = [{"featureType":"landscape.natural","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#e0efef"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"hue":"#1900ff"},{"color":"#c0e8e8"}]},{"featureType":"road","elementType":"geometry","stylers":[{"lightness":100},{"visibility":"simplified"}]},{"featureType":"road","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"visibility":"on"},{"lightness":700}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#7dcdcd"}]}];
	    } else {
		    var mapStyles = [
			    {
				    stylers: [
					    {hue: color},
					    {saturation: saturation},
					    {lightness: lightness},
					    {gamma: 1}
				    ]
			    }
		    ];
	    }
	    
        var googleMapStyleId;

        if(customMapStyle) {
            googleMapStyleId = 'mkdf-style';
        } else {
            googleMapStyleId = google.maps.MapTypeId.ROADMAP;
        }

        var qoogleMapType = new google.maps.StyledMapType(mapStyles,
            {name: "Mikado Google Map"});

        geocoder = new google.maps.Geocoder();
        var latlng = new google.maps.LatLng(-34.397, 150.644);

        if(!isNaN(height)) {
            height = height + 'px';
        }

        var myOptions = {

            zoom: zoom,
            scrollwheel: wheel,
            center: latlng,
            zoomControl: true,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.SMALL,
                position: google.maps.ControlPosition.RIGHT_CENTER
            },
            scaleControl: false,
            scaleControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            streetViewControl: false,
            streetViewControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            panControl: false,
            panControlOptions: {
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeControl: false,
            mapTypeControlOptions: {
                mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'mkdf-style'],
                style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
                position: google.maps.ControlPosition.LEFT_CENTER
            },
            mapTypeId: googleMapStyleId
        };

        map = new google.maps.Map(document.getElementById(holderId), myOptions);
        map.mapTypes.set('mkdf-style', qoogleMapType);

        var index;

        for(index = 0; index < data.length; ++index) {
            mkdfInitializeGoogleAddress(data[index], pin, map, geocoder);
        }

        var holderElement = document.getElementById(holderId);
        holderElement.style.height = height;
    }

    /*
     **	Init Google Map Addresses
     */
    function mkdfInitializeGoogleAddress(data, pin, map, geocoder) {
        if(data === '')
            return;
        var contentString = '<div id="content">' +
            '<div id="siteNotice">' +
            '</div>' +
            '<div id="bodyContent">' +
            '<p>' + data + '</p>' +
            '</div>' +
            '</div>';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        geocoder.geocode({'address': data}, function(results, status) {
            if(status === google.maps.GeocoderStatus.OK) {
                map.setCenter(results[0].geometry.location);
                var marker = new google.maps.Marker({
                    map: map,
                    position: results[0].geometry.location,
                    icon: pin,
                    title: data['store_title']
                });
                google.maps.event.addListener(marker, 'click', function() {
                    infowindow.open(map, marker);
                });

                google.maps.event.addDomListener(window, 'resize', function() {
                    map.setCenter(results[0].geometry.location);
                });

            }
        });
    }

    /**
     * Button object that initializes icon list with animation
     * @type {Function}
     */
    var mkdfInitIconList = mkdf.modules.shortcodes.mkdfInitIconList = function() {
        var iconList = $('.mkdf-animate-list');

        /**
         * Initializes icon list animation
         * @param list current slider
         */
        var iconListInit = function(list) {
            setTimeout(function(){
                list.appear(function(){
                    list.addClass('mkdf-appeared');
                },{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            },30);
        };

        return {
            init: function() {
                if(iconList.length) {
                    iconList.each(function() {
                        iconListInit($(this));
                    });
                }
            }
        };
    };

    function mkdfInitAccordions() {
        var accordion = $('.mkdf-accordion-holder');
        if(accordion.length) {
            accordion.each(function() {

                var thisAccordion = $(this);

                if(thisAccordion.hasClass('mkdf-accordion')) {

                    thisAccordion.accordion({
                        animate: "swing",
                        collapsible: false,
                        active: 0,
                        icons: "",
                        heightStyle: "content"
                    });
                }

                if(thisAccordion.hasClass('mkdf-toggle')) {

                    var toggleAccordion = $(this);
                    var toggleAccordionTitle = toggleAccordion.find('.mkdf-title-holder');
                    var toggleAccordionContent = toggleAccordionTitle.next();

                    toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
                    toggleAccordionTitle.addClass("ui-accordion-header ui-helper-reset ui-state-default ui-corner-top ui-corner-bottom");
                    toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

                    toggleAccordionTitle.each(function() {
                        var thisTitle = $(this);
                        thisTitle.hover(function() {
                            thisTitle.toggleClass("ui-state-hover");
                        });

                        thisTitle.on('click', function() {
                            thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
                            thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
                        });
                    });
                }
            });
        }
    }

    function mkdfInitImageGallery() {

        var galleries = $('.mkdf-image-gallery');

        if(galleries.length) {
            galleries.each(function() {
                var gallery = $(this).children('.mkdf-image-gallery-slider'),
                    autoplay = false,
                    autoplayInterval = gallery.data('autoplay'),
                    animation,
                    animateIn,
                    animateOut,
                    navigation = (gallery.data('navigation') == 'yes'),
                    pagination = (gallery.data('pagination') == 'yes');

                if (autoplayInterval !== '') {
                    autoplay = true;
                }

                if (animation = (gallery.data('animation') == 'slide')) {
                    animateIn = 'fadeInRight';
                    animateOut = 'fadeOutLeft';
                } else if (animation = (gallery.data('animation') == 'fade'))  {
                    animateIn = 'fadeIn';
                    animateOut = 'fadeOut';
                } else if (animation = (gallery.data('animation') == 'fadeUp'))  {
                    animateIn = 'fadeInUp';
                    animateOut = 'fadeOutUp';
                } else if (animation = (gallery.data('animation') == 'backSlide'))  {
                    animateIn = 'zoomInRight';
                    animateOut = 'zoomOutLeft';
                } else if (animation = (gallery.data('animation') == 'goDown'))  {
                    animateIn = 'slideInDown';
                    animateOut = 'slideOutDown';
                }

                if (!gallery.hasClass('owl-carousel')) {
                    gallery.addClass('owl-carousel');
                }

                gallery.waitForImages(function(){
                    gallery.css('visibility','visible');
                });

                gallery.owlCarousel({
                    items: 1,
                    autoplay: autoplay,
                    autoplayInterval: autoplayInterval * 1000,
                    autoplayHoverPause: true,
                    loop:true,
                    nav: navigation,
                    dots: pagination,
                    transitionStyle: animation,
                    autoHeight: true,
                    smartSpeed: 600,
                    navText: [
                        '<span class="mkdf-prev-icon"><i class="lnr lnr-chevron-left"></i></span>',
                        '<span class="mkdf-next-icon"><i class="lnr lnr-chevron-right"></i></span>'
                    ],
                    animateIn: animateIn,
                    animateOut: animateOut,
                    onTranslate: function() {
                        gallery.find('.owl-nav > div').css({'pointer-events':'none','cursor':'pointer'});
                    },
                    onTranslated: function() {
                        gallery.find('.owl-nav > div').css('pointer-events','initial');
                    }
                });
            });
        }

    }


    function mkdfConvertHTML(html) {
        var newHtml = $.trim(html),
            $html = $(newHtml),
            $empty = $();

        $html.each(function(index, value) {
            if(value.nodeType === 1) {
                $empty = $empty.add(this);
            }
        });

        return $empty;
    }


    function mkdfInfoBox() {
        var infoBoxes = $('.mkdf-info-box-holder');

        var getBottomHeight = function(bottomHolder) {
            if(bottomHolder.length) {
                return bottomHolder.height();
            }

            return false;
        };

        var infoBoxesHeight = function() {
            if(infoBoxes.length) {
                var maxHeight = 0;
                var heightestBox;

                infoBoxes.each(function() {
                    var bottomHolder = $(this).find('.mkdf-ib-bottom-holder');
                    var topHolder = $(this).find('.mkdf-ib-top-holder');

                    var currentHeight = getBottomHeight(bottomHolder) + topHolder.height();

                    maxHeight = Math.max(maxHeight, currentHeight);

                    if(maxHeight <= currentHeight) {
                        heightestBox = $(this);
                        maxHeight = currentHeight;
                    }
                });

                infoBoxes.height(maxHeight);
            }
        };

        var initHover = function(infoBox) {
            var timeline = new TimelineLite({paused: true}),
                topHolder = infoBox.find('.mkdf-ib-top-holder'),
                bottomHolder = infoBox.find('.mkdf-ib-bottom-holder'),
                bottomHeight = getBottomHeight(bottomHolder);

            timeline.to(topHolder, 0.6, {y: -(bottomHeight / 2), ease: Back.easeInOut.config(2)});
            timeline.to(bottomHolder, 0.4, {y: -(bottomHeight / 2), opacity: 1, ease: Back.easeOut}, '-=0.3');

            infoBox.hover(function() {
                timeline.restart();
            }, function() {
                timeline.reverse();
            });
        };

        if(infoBoxes.length) {
            infoBoxesHeight();

            $(mkdf.window).resize(function() {
                infoBoxesHeight();
            });

            infoBoxes.each(function() {
                var thisInfoBox = $(this);
                initHover(thisInfoBox);

                $(mkdf.window).resize(function() {
                    initHover(thisInfoBox);
                });
            });
        }
    }

    function mkdfProcess() {
        var processes = $('.mkdf-process-holder');

        var setProcessItemsPosition = function(process) {
            var items = process.find('.mkdf-process-item-holder');
            var highlighted = items.filter('.mkdf-pi-highlighted');

            if(highlighted.length) {
                if(highlighted.length === 1) {
                    var afterHighlighed = highlighted.nextAll();

                    if(afterHighlighed.length) {
                        afterHighlighed.addClass('mkdf-pi-push-right');
                    }
                } else {
                    process.addClass('mkdf-process-multiple-highlights');
                }
            }
        };

        var processAnimation = function(process) {
            if(!mkdf.body.hasClass('mkdf-no-animations-on-touch')) {
                var items = process.find('.mkdf-process-item-holder');
                var background = process.find('.mkdf-process-bg-holder');

                process.appear(function() {
                    var tl = new TimelineLite();
                    tl.fromTo(background, 0.2, {y: 50, opacity: 0, delay: 0.1}, {opacity: 1, y: 0, delay: 0.1});
                    tl.staggerFromTo(items, 0.3, {opacity: 0, y: 50, ease: Back.easeOut.config(2)}, {
                        opacity: 1,
                        y: 0,
                        ease: Back.easeOut.config(2)
                    }, 0.2);
                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            }
        };

        return {
            init: function() {
                if(processes.length) {
                    processes.each(function() {
                        setProcessItemsPosition($(this));
                        processAnimation($(this));
                    });
                }
            }
        };
    };

    function mkdfComparisonPricingTables() {
        var pricingTablesHolder = $('.mkdf-comparision-pricing-tables-holder');

        var alterPricingTableColumn = function(holder) {
            var featuresHolder = holder.find('.mkdf-cpt-features-item');
            var pricingTables = holder.find('.mkdf-comparision-table-holder');

            if(pricingTables.length) {
                pricingTables.each(function() {
                    var currentPricingTable = $(this);
                    var pricingItems = currentPricingTable.find('.mkdf-cpt-table-content li');

                    if(pricingItems.length) {
                        pricingItems.each(function(i) {
                            var pricingItemFeature = featuresHolder[i];
                            var pricingItem = this;
                            var pricingItemContent = pricingItem.innerHTML;

                            if(typeof pricingItemFeature !== 'undefined') {
                                pricingItem.innerHTML = '<span class="mkdf-cpt-table-item-feature">' + $(pricingItemFeature).text() + ': </span>' + pricingItemContent;
                            }
                        });
                    }
                });
            }
        };

        return {
            init: function() {
                if(pricingTablesHolder.length) {
                    pricingTablesHolder.each(function() {
                        alterPricingTableColumn($(this));
                    });
                }
            }
        };
    }

    function mkdfProgressBarVertical() {
        var progressBars = $('.mkdf-vertical-progress-bar-holder');

        var animateProgressBar = function(progressBar) {

            progressBar.appear(function() {
                var barHolder = progressBar.find('.mkdf-vpb-bar');
                var activeBar = progressBar.find('.mkdf-vpb-active-bar');
                var percentage = barHolder.data('percent');

                activeBar.animate({
                    height: percentage + '%'
                }, 1500);

            }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
        };

        var animatePercentageNumber = function(progressBar) {
            progressBar.appear(function() {
                var barHolder = progressBar.find('.mkdf-vpb-bar');
                var percentage = barHolder.data('percent');
                var percentHolder = progressBar.find('.mkdf-vpb-percent-number');

                percentHolder.countTo({
                    from: 0,
                    to: percentage,
                    speed: 1500,
                    refreshInterval: 50
                });
            });
        };

        return {
            init: function() {

                if(progressBars.length) {
                    progressBars.each(function() {
                        animateProgressBar($(this));
                        animatePercentageNumber($(this));
                    });
                }
            }
        };
    }

    function mkdfIconProgressBar() {
        var progressBars = $('.mkdf-icon-progress-bar');

        var animateActiveIcons = function(progressBar) {
            var timeouts = [];
            progressBar.appear(function() {
                var numberOfActive = parseInt(progressBar.data('number-of-active-icons'));
                var icons = progressBar.find('.mkdf-ipb-icon');
                var customColor = progressBar.data('icon-active-color');

                if(typeof numberOfActive !== 'undefined') {

                    icons.each(function(i) {
                        if(i < numberOfActive) {
                            var time = (i + 1) * 150;
                            var currentIcon = $(this);

                            timeouts[i] = setTimeout(function() {
                                animateSingleIcon(currentIcon, customColor);
                                $(icons[i]).addClass('active');
                            }, time);
                        }
                    });
                }
            }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
        };

        var animateSingleIcon = function(icon, customColor) {
            icon.addClass('mkdf-ipb-active');

            if(typeof customColor !== 'undefined' && customColor !== '') {
                icon.find('.mkdf-ipb-icon-elem').css('color', customColor);
            }
        };

        return {
            init: function() {
                if(progressBars.length) {
                    progressBars.each(function() {
                        animateActiveIcons($(this));
                    });
                }
            }
        };
    }

    function mkdfBlogSlider() {
        var blogSliders = $('.mkdf-blog-slider-holder');

        if(blogSliders.length) {
            blogSliders.each(function() {
                var thisSlider = $(this);

                if (!thisSlider.hasClass('owl-carousel')) {
                    thisSlider.addClass('owl-carousel');
                }

                thisSlider.owlCarousel({
                    items: 1,
                    nav: true,
                    autoHeight: true,
                    dots: false,
                    smartSpeed: 600,
                    navText: [
                        '<span class="mkdf-prev-icon"><i class="lnr lnr-chevron-left"></i></span>',
                        '<span class="mkdf-next-icon"><i class="lnr lnr-chevron-right"></i></span>'
                    ],
                    animateIn: 'fadeIn',
                    animateOut: 'fadeOut',
                    onInitialized: function() {
                        thisSlider.css('opacity', 1);
                    }
                });
            });
        }
    }

    function blogCarousel() {
        var blogCarousels = $('.mkdf-blog-carousel');

        if(blogCarousels.length) {
            blogCarousels.each(function() {
                var currentCarousel = $(this);

                if (!currentCarousel.hasClass('owl-carousel')) {
                    currentCarousel.addClass('owl-carousel');
                }

                currentCarousel.waitForImages(function(){
                    currentCarousel.animate({opacity:1});
                });

                currentCarousel.owlCarousel({
                    autoplay:true,
                    autoplayHoverPause:true,
                    loop:true,
                    responsive:{
                        0:{
                            items:1,
                        },
                        769:{
                            items:2,
                        },
                        1025:{
                            items:3,
                        }
                    },
                    dots: false,
                    smartSpeed: 400,
                    nav: true,
                    navText: [
                        '<span class="mkdf-prev-icon"><i class="lnr lnr-chevron-left"></i></span>',
                        '<span class="mkdf-next-icon"><i class="lnr lnr-chevron-right"></i></span>'
                    ]
                });
            });
        }
    }

    function emptySpaceResponsive() {
        var emptySpaces = $('.vc_empty_space');

        var sizes = {
            'large_laptop': 1560,
            'laptop': 1280,
            'tablet_landscape': 1024,
            'tablet_portrait': 768,
            'phone_landscape': 600,
            'phone_portrait': 480
        };

        var sizeValues = function() {
            var values = [];
            for(var size in sizes) {
                values.push(sizes[size]);
            }
            ;

            return values;
        }();

        var getHeights = function(emptySpace) {
            var heights = {};

            for(var size in sizes) {
                var dataValue = emptySpace.data(size);
                if(typeof dataValue !== 'undefined' && dataValue !== '') {
                    heights[size] = dataValue;
                }
            }

            return heights;
        };

        var usedSizes = function(emptySpace) {
            var usedSizes = [];

            for(var size in sizes) {
                var dataValue = emptySpace.data(size);
                if(typeof dataValue !== 'undefined' && dataValue !== '') {
                    usedSizes.push(sizes[size]);
                }
            }

            return usedSizes;
        };

        var resizeEmptySpace = function(heights, emptySpace) {
            if(typeof heights !== 'undefined') {
                var originalHeight = emptySpace.data('original-height');
                var sizeValues = usedSizes(emptySpace);
                var heightestSize = Math.max.apply(null, sizeValues);

                for(var size in sizes) {
                    if(mkdf.windowWidth <= sizes[size]) {
                        emptySpace.height(heights[size]);
                    } else if(mkdf.windowWidth > heightestSize) {
                        emptySpace.height(originalHeight);
                    }
                }
            }
        };

        return {
            init: function() {
                if(emptySpaces.length) {
                    emptySpaces.each(function() {
                        var heights = getHeights($(this));

                        resizeEmptySpace(heights, $(this));

                        var thisEmptySpace = $(this);

                        $(window).resize(function() {
                            resizeEmptySpace(heights, thisEmptySpace);
                        });
                    });
                }
            }
        };
    }

})(jQuery);