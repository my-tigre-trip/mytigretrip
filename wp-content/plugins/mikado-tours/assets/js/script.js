window.mkdfToursFront = (function($) {
    'use strict';

    var tours = {};
    if(typeof mkdf !== 'undefined' && typeof mkdf === '' ){
        mkdf.modules.tours = tours;
    }
    
    tours.mkdfOnDocumentReady = mkdfOnDocumentReady;
    tours.mkdfOnWindowLoad = mkdfOnWindowLoad;
    tours.mkdfOnWindowResize = mkdfOnWindowResize;
    tours.mkdfOnWindowScroll = mkdfOnWindowScroll;

    tours.mkdfInitTourItemTabs = mkdfInitTourItemTabs;
    tours.mkdfTourTabsMapTrigger = mkdfTourTabsMapTrigger;
    tours.mkdfTourReviewsInit = mkdfTourReviewsInit;
    tours.toursList = toursList;
    tours.tourCarousel = tourCarousel;
    tours.initTopReviewsCarousel = initTopReviewsCarousel;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);
    $(window).resize(mkdfOnWindowResize);
    $(window).scroll(mkdfOnWindowScroll);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        if(typeof mkdf === 'undefined' || typeof mkdf === '' ){
            //if theme is not installed, generate single items manualy
           mkdfInitTourItemTabs();
        }

        if(typeof mkdf !== 'undefined' ){
            //if theme is installed, trigger google map loading on location tab on single pages
            mkdfTourTabsMapTrigger();
        }
    
        mkdfTourGalleryMasonry();
	    mkdfTrigerTourGalleryMasonry();
	    
        // For now, regardless of whether the theme is installed, initiate reviews
        mkdfTourReviewsInit();
        tourCarousel();

        initTopReviewsCarousel();

        searchTours().fieldsHelper.init();
        searchTours().handleSearch.init();
	
	    destinationShortcodeSearchFilters().fieldsHelper.init();

        mkdfToursGalleryAnimation();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        toursList().init();
    }

    /*
     All functions to be called on $(window).resize() should be in this function
     */
    function mkdfOnWindowResize() {
	    mkdfTourGalleryMasonry();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {

    }

    function themeInstalled() {
        return typeof mkdf !== 'undefined';
    }
	
	function mkdfTourGalleryMasonry(){
		var masonryList = $('.mkdf-tour-masonry-gallery-holder .mkdf-tour-masonry-gallery');
		
		if(masonryList.length){
			masonryList.each(function(){
				var thisMasonry = $(this),
					thisMasonrySize = thisMasonry.find('.mkdf-tour-grid-sizer').width();
				
				mkdfTourGalleryMasonryResize(thisMasonry, thisMasonrySize);
				
				thisMasonry.waitForImages(function() {
					thisMasonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.mkdf-tour-gallery-item',
						percentPosition: true,
						packery: {
							gutter: '.mkdf-tour-grid-gutter',
							columnWidth: '.mkdf-tour-grid-sizer'
						}
					});
					
					thisMasonry.css('opacity', '1');
				});
			});
		}
	}
    
    function mkdfTourGalleryMasonryResize(container, size){
        var defaultMasonryItem = container.find('.mkdf-default-masonry-item'),
	        largeWidthMasonryItem = container.find('.mkdf-large-width-masonry-item'),
            largeHeightMasonryItem = container.find('.mkdf-large-height-masonry-item'),
            largeWidthHeightMasonryItem = container.find('.mkdf-large-width-height-masonry-item');
        
        defaultMasonryItem.css('height', size - 26); // 26 is space between columns
	    largeWidthMasonryItem.css('height', size - 26);
        largeHeightMasonryItem.css('height', Math.round(2*size - 26));
	    largeWidthHeightMasonryItem.css('height', Math.round(2*size - 26));
    }
	
	function mkdfTrigerTourGalleryMasonry(){
		var holder = $('.mkdf-tour-item-single-holder');
		var tourNavItems = holder.find('.mkdf-tour-item-wrapper ul li a');
		tourNavItems.on('click', function(){
			var thisNavItem  = $(this);
			var thisNavItemId = thisNavItem.attr('href');
			
			if(thisNavItemId === '#tour-item-gallery-id'){
				mkdfTourGalleryMasonry();
			}
		});
	}

    function mkdfInitTourItemTabs(){
        var holder = $('.mkdf-tour-item-single-holder');
        var tourNavItems = holder.find('.mkdf-tour-item-wrapper ul li a');
        var tourSectionsItems  = holder.find('.mkdf-tour-item-section');
        tourNavItems.first().addClass('mkdf-active-item');

        tourNavItems.on('click', function(){
            tourNavItems.removeClass('mkdf-active-item');

            var thisNavItem  = $(this);
            var thisNavItemId = thisNavItem.attr('href');
            thisNavItem.addClass('mkdf-active-item');

            if( tourSectionsItems.length ){
                tourSectionsItems.each(function(){

                    var thisSectionItem = $(this);
                    if(thisSectionItem.attr('id') === thisNavItemId){
                        thisSectionItem.show();
                        if(thisNavItemId === '#tour-item-location-id'){
                              mkdfToursReInitGoogleMap();
                        }
                    }else{
                        thisSectionItem.hide();
                    }
                });
            }
        });
    }
    
    function mkdfTourTabsMapTrigger(){
        var holder = $('.mkdf-tour-item-single-holder');
        var tourNavItems = holder.find('.mkdf-tour-item-wrapper ul li a');
        tourNavItems.on('click', function(){
            var thisNavItem  = $(this);
            var thisNavItemId = thisNavItem.attr('href');

            if(thisNavItemId === '#tour-item-location-id'){
                mkdfToursReInitGoogleMap();
            }
        });
    }
    
    function mkdfToursReInitGoogleMap(){

        if(typeof mkdf !== 'undefined' && typeof mkdf !== '' ){
            mkdf.modules.shortcodes.mkdfShowGoogleMap();
        }
    }

    function mkdfTourReviewsInit() {
        var reviewWrappers = $('.mkdf-tour-reviews-input-wrapper');
        if (reviewWrappers.length) {

            var emptyStarClass = 'icon_star_alt',
                fullStarClass = 'icon_star';
            
            var setCriteriaCommands = function(criteriaHolder) {
                criteriaHolder.find('.mkdf-tour-reviews-star-holder')
                .mouseenter(function () {
                    $(this).add($(this).prevAll()).find('.mkdf-tour-reviews-star').removeClass(emptyStarClass).addClass(fullStarClass);
                    $(this).nextAll().find('.mkdf-tour-reviews-star').removeClass(fullStarClass).addClass(emptyStarClass);
                })
                .click(function() {
                    criteriaHolder.find('.mkdf-tour-reviews-hidden-input').val($(this).index()+1);
                });

                criteriaHolder.find('.mkdf-tour-reviews-rating-holder')
                .mouseleave(function() {
                    var inputValue = criteriaHolder.find('.mkdf-tour-reviews-hidden-input').val();
                    inputValue = inputValue === "" ? 0 : parseInt(inputValue,10);
                    $(this).find('.mkdf-tour-reviews-star-holder').each(function(i) {
                        $(this).find('.mkdf-tour-reviews-star').removeClass((i < inputValue) ? emptyStarClass : fullStarClass).addClass((i < inputValue) ? fullStarClass : emptyStarClass);
                    });
                }).trigger('mouseleave');
            };
            
            reviewWrappers.each(function() {

                var reviewWrapper = $(this);
                var criteriaHolders = reviewWrapper.find('.mkdf-tour-reviews-criteria-holder');

                criteriaHolders.each(function() {
                    setCriteriaCommands($(this));
                });
            });
        }
    }

    function tourCarousel() {
        var tourCarousels = $('.mkdf-tours-carousel');

        if(tourCarousels.length) {
            tourCarousels.each(function() {
                var currentCarousel = $(this);


                if (!currentCarousel.hasClass('owl-carousel')) {
                    currentCarousel.addClass('owl-carousel');
                }

                currentCarousel.waitForImages(function(){
                    currentCarousel.animate({opacity : 1});
                });

                currentCarousel.owlCarousel({
                    autoplay:true,
                    autoplayHoverPause: true,
                    dots: false,
                    nav: true,
                    smartSpeed: 400,
                    loop:true,
                    navText: [
                        '<span class="mkdf-prev-icon"><i class="lnr lnr-chevron-left"></i></span>',
                        '<span class="mkdf-next-icon"><i class="lnr lnr-chevron-right"></i></span>'
                    ],
                    responsive:{
                        0:{
                            items:1,
                        },
                        768:{
                            items:2,
                        },
                        1025:{
                            items:3
                        }
                    },
                });
            });
        }
    }

    function toursList() {
        var listItem = $('.mkdf-tours-list-holder'),
            listObject;

        var initList = function(listHolder) {
            listHolder.animate({opacity: 1});

            listObject = listHolder.isotope({
                percentPosition: true,
                itemSelector: '.mkdf-tour-list-item-inner',
                transitionDuration: '0.4s',
                isInitLayout: true,
                hiddenStyle: {
                    opacity: 0
                },
                visibleStyle: {
                    opacity: 1
                },
                masonry: {
                    columnWidth: '.mkdf-tours-list-grid-sizer'
                }
            });

            if(themeInstalled()) {
                mkdf.modules.common.mkdfInitParallax();
            }
        };

        var initFilter = function(listFeed) {
            var filters = listFeed.find('.mkdf-tour-list-filter-item');

            filters.on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                var currentFilter = $(this);
                var type = currentFilter.data('type');

                filters.removeClass('mkdf-tour-list-current-filter');
                currentFilter.addClass('mkdf-tour-list-current-filter');

                type = typeof type === 'undefined' ? '*' : '.' + type;

                listFeed.find('.mkdf-tours-list-holder-inner').isotope({
                    filter: type
                });
            });
        };

        var resetFilter = function(listFeed) {
            var filters = listFeed.find('.mkdf-tour-list-filter-item');

            filters.removeClass('mkdf-tour-list-current-filter');
            filters.eq(0).addClass('mkdf-tour-list-current-filter');

            listFeed.find('.mkdf-tours-list-holder-inner').isotope({
                filter: '*'
            });
        };

        var initPagination = function($listObject) {
            var $paginationDataHolder = $listObject.find('.mkdf-tours-list-pagination-data');
            var $itemsHolder = $listObject.find('.mkdf-tours-list-holder-inner');

            var fetchData = function(callback) {
                var data = {
                    action: 'mkdf_tours_list_ajax_pagination',
                    fields: $paginationDataHolder.find('input').serialize()
                };

                $.ajax({
                    url: mkdfToursAjaxURL,
                    data: data,
                    dataType: 'json',
                    type: 'POST',
                    success: function(response) {
                        if(response.havePosts) {
                            $paginationDataHolder.find('[name="next_page"]').val(response.nextPage);
                        }

                        if(themeInstalled()) {
                            mkdf.modules.common.mkdfInitParallax();
                        }

                        callback.call(this, response);
                    }
                });
            };
            
            var loadMorePagination = function() {
                var $loadMoreButton = $listObject.find('.mkdf-tours-load-more-button');
                var $paginationHolder = $listObject.find('.mkdf-tours-pagination-holder');
                var loadingInProgress = false;

                if($loadMoreButton.length) {
                    $loadMoreButton.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();

                        var loadingLabel = $loadMoreButton.data('loading-label');
                        var originalText = $loadMoreButton.text();
                        
                        $loadMoreButton.text(loadingLabel);
                        resetFilter($listObject);

                        if(!loadingInProgress) {
                            loadingInProgress = true;

                            fetchData(function(response) {
                                if(response.havePosts === true) {
                                    $loadMoreButton.text(originalText);

                                    var $responseHTML = $(response.html);

                                    $itemsHolder.append($responseHTML);

                                    $itemsHolder.waitForImages(function() {
                                        $itemsHolder.isotope('appended', $responseHTML).isotope('reloadItems');
                                        mkdfToursGalleryAnimation();
                                    });
                                } else {
                                    $loadMoreButton.remove();

                                    $paginationHolder.html(response.message);
                                }

                                loadingInProgress = false;
                            });
                        }

                    });
                }
            };

            loadMorePagination();
        };

        return {
            init: function() {
                if(listItem.length && typeof $.fn.isotope !== 'undefined') {
                    listItem.each(function() {
                        initList($(this).find('.mkdf-tours-list-holder-inner'));
                        initFilter($(this));
                        initPagination($(this));
                    });
                }
            }
        }
    }

    function searchTours() {
        var $searchForms = $('.mkdf-tours-search-main-filters-holder form');
        
        var fieldsHelper = function() {
            var initRangeSlider = function() {
                var $rangeSliders = $searchForms.find('.mkdf-tours-range-input');
                var $priceRange = $searchForms.find('.mkdf-tours-price-range-field');
                var $minPrice = $searchForms.find('[name="min_price"]');
                var $maxPrice = $searchForms.find('[name="max_price"]');
                var minValue = $priceRange.data('min-price');
                var maxValue = $priceRange.data('max-price');
                var chosenMinValue = $priceRange.data('chosen-min-price');
                var chosenMaxValue = $priceRange.data('chosen-max-price');
                
                if($rangeSliders.length) {
                    $rangeSliders.each(function() {
                        var thisSlider = this;
                        
                        var slider = noUiSlider.create(thisSlider, {
                            start: [chosenMinValue, chosenMaxValue],
                            connect: true,
                            step: 1,
                            range: {
                                'min': [ minValue ],
                                'max': [ maxValue ]
                            },
                            format: {
                                to: function(value) {
                                    return Math.floor(value);
                                },
                                from: function(value) {
                                    return value;
                                }
                            }
                        });
                        
                        slider.on('update', function(values) {
                            var firstValue = values[0];
                            var secondValue = values[1];
                            var currencySymbol = $priceRange.data('currency-symbol');
                            var currencySymbolPosition = $priceRange.data('currency-symbol-position');
                            
                            var firstPrice = currencySymbolPosition === 'left' ? currencySymbol + firstValue : firstValue + currencySymbol;
                            var secondPrice = currencySymbolPosition === 'left' ? currencySymbol + secondValue : firstValue + secondValue;
                            
                            $priceRange.val(firstPrice + ' - ' + secondPrice);
                            
                            $minPrice.val(firstValue);
                            $maxPrice.val(secondValue);
                        });
                    });
                }
            };
            
            var initKeywordSearch = function() {
                var tours = typeof mkdfToursSearchData !== 'undefined' ? mkdfToursSearchData.tours : [];
                
                var tours = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: tours
                });
                
                $searchForms.find('.mkdf-tours-keyword-search').typeahead({
                        hint: true,
                        highlight: true,
                        minLength: 1
                    },
                    {
                        name: 'tours',
                        source: tours
                    });
            };
            
            var initDestinationSearch = function() {
                var destinations = typeof mkdfToursSearchData !== 'undefined' ? mkdfToursSearchData.destinations : [];
                
                var destinations = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: destinations
                });
                
                $searchForms.find('.mkdf-tours-destination-search').typeahead({
                        hint: true,
                        highlight: true,
                        minLength: 1
                    },
                    {
                        name: 'destinations',
                        source: destinations
                    });
            };
            
            var initSelectPlaceholder = function() {
                var $selects = $('.mkdf-tours-select-placeholder');
                
                var changeState = function($select) {
                    var selectVal = $select.val();
                    
                    if(selectVal === '') {
                        $select.addClass('mkdf-tours-select-default-option');
                    } else {
                        $select.removeClass('mkdf-tours-select-default-option');
                    }
                };
                
                if($selects.length) {
                    $selects.each(function() {
                        var $select = $(this);
                        
                        changeState($(this));
                        
                        $select.on('change', function() {
                            changeState($(this));
                        });
                    })
                }
            };
            
            return {
                init: function() {
                    initRangeSlider();
                    initKeywordSearch();
                    initDestinationSearch();
                    initSelectPlaceholder();
                }
            }
        }();
        
        var handleSearch = function() {
            var rewriteURL = function(queryString) {
                //init variables
                var currentPage = '';
                
                //does current url has query string
                if (location.href.match(/\?.*/) && document.referrer) {
                    //get clean current url
                    currentPage = location.href.replace(/\?.*/, '');
                }
                
                //rewrite url with current page and new url string
                window.history.replaceState({page: currentPage + '?' + queryString}, '', currentPage + '?' + queryString);
            };
            
            var sendRequest = function($form, changeLabel, resetPagination, animate) {
                var $submitButton = $form.find('input[type="submit"]');
                var $searchContent = $('.mkdf-tours-search-content');
                var $searchPageContent = $('.mkdf-tours-search-page-holder');
                var searchInProgress = false;
                
                changeLabel = typeof changeLabel !== 'undefined' ? changeLabel : true;
                resetPagination = typeof resetPagination !== 'undefined' ? resetPagination : true;
                animate = typeof animate !== 'undefined' ? animate : false;
                
                var searchingLabel = $submitButton.data('searching-label');
                var originalLabel = $submitButton.val();
                
                if(!searchInProgress) {
                    if(changeLabel) {
                        $submitButton.val(searchingLabel);
                    }
                    
                    if(resetPagination) {
                        $form.find('[name="page"]').val(1);
                    }
                    
                    searchInProgress = true;
                    $searchContent.addClass('mkdf-tours-searching');
                    
                    var data = {
                        action: 'tours_search_handle_form_submission'
                    };
                    
                    data.fields = $form.serialize();
                    
                    $.ajax({
                        type: 'GET',
                        url: mkdfToursAjaxURL,
                        dataType: 'json',
                        data: data,
                        success: function(response) {
                            if(changeLabel) {
                                $submitButton.val(originalLabel);
                            }
                            
                            $searchContent.removeClass('mkdf-tours-searching');
                            searchInProgress = false;
                            
                            $searchContent.find('.mkdf-grid-row').html(response.html);
                            rewriteURL(response.url);
                            
                            $('.mkdf-tours-search-pagination').remove();
                            
                            $searchContent.append(response.paginationHTML);
                            
                            if(animate) {
                                $('html, body').animate({scrollTop: $searchPageContent.offset().top - 80}, 700);
                            }
                            mkdfToursGalleryAnimation();
                        }
                    });
                }
            };
            
            var formHandler = function($form) {
                
                if($('body').hasClass('post-type-archive-tour-item')) {
                    $form.on('submit', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        sendRequest($form);
                    });
                }
            };
            
            var handleOrderBy = function($searchForms) {
                var $orderingItems = $('.mkdf-search-ordering-item');
                var $orderByField = $searchForms.find('[name="order_by"]');
                var $orderTypeField = $searchForms.find('[name="order_type"]');
                
                if($orderingItems.length) {
                    $orderingItems.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        var $thisItem = $(this);
                        
                        $orderingItems.removeClass('mkdf-search-ordering-item-active');
                        $thisItem.addClass('mkdf-search-ordering-item-active');
                        
                        var orderBy = $thisItem.data('order-by');
                        var orderType = $thisItem.data('order-type');
                        
                        if(typeof orderBy !== 'undefined' && typeof orderType !== 'undefined') {
                            $orderByField.val(orderBy);
                            $orderTypeField.val(orderType);
                        }
                        
                        sendRequest($searchForms, false, false);
                    });
                }
            };
            
            var handleViewType = function($searchForms) {
                var $viewTypeItems = $('.mkdf-tours-search-view-item');
                var $typeField = $searchForms.find('[name="view_type"]');
                
                if($viewTypeItems.length) {
                    $viewTypeItems.on('click', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        var $thisView = $(this);
                        
                        $viewTypeItems.removeClass('mkdf-tours-search-view-item-active');
                        $thisView.addClass('mkdf-tours-search-view-item-active');
                        
                        var viewType = $thisView.data('type');
                        
                        if(typeof viewType !== 'undefined') {
                            $typeField.val(viewType);
                        }
                        
                        sendRequest($searchForms, false, false);
                    });
                }
            };
            
            var handlePagination = function($searchForms) {
                var $paginationHolder = $('.mkdf-tours-search-pagination');
                var $pageField = $searchForms.find('[name="page"]');
                
                if($paginationHolder.length) {
                    $(document).on('click', '.mkdf-tours-search-pagination li', function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        
                        var $thisItem = $(this);
                        
                        var page = $thisItem.data('page');
                        
                        if(typeof page !== 'undefined') {
                            $pageField.val(page);
                        }
                        
                        sendRequest($searchForms, true, false, true);
                    });
                }
            }
            
            return {
                init: function() {
                    formHandler($searchForms);
                    handleOrderBy($searchForms);
                    handleViewType($searchForms);
                    handlePagination($searchForms);
                }
            }
        }();
        
        return {
            fieldsHelper: fieldsHelper,
            handleSearch: handleSearch
        }
    }
    
    function destinationShortcodeSearchFilters() {
        var $searchForms = $('.mkdf-tours-swf-filter-holder.mkdf-tours-swf-filter-horizontal form');
        
        var fieldsHelper = function() {
            
            var initDestinationSearch = function() {
                var destinations = typeof mkdfToursSearchData !== 'undefined' ? mkdfToursSearchData.destinations : [];
                
                var destinations = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.whitespace,
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: destinations
                });
                
                $searchForms.find('.mkdf-tours-destination-search').typeahead({
                        hint: true,
                        highlight: true,
                        minLength: 1
                    },
                    {
                        name: 'destinations',
                        source: destinations
                    });
            };
            
            return {
                init: function() {
                    initDestinationSearch();
                }
            }
        }();
        
        return {
            fieldsHelper: fieldsHelper
        }
    }

    /*
    * Tours Gallery animation
    */
    function mkdfToursGalleryAnimation() {
        var toursGalleryItems = $('.mkdf-tours-gallery-item');

        if (toursGalleryItems.length) {
            toursGalleryItems.each(function(){
                var toursGalleryItem = $(this),
                    contentHolder = toursGalleryItem.find('.mkdf-tours-gallery-item-content-holder'),
                    excerpt = contentHolder.find('.mkdf-tours-gallery-item-excerpt'),
                    deltaY = Math.ceil(excerpt.height());

                contentHolder.css('transform','translate3d(0,'+deltaY+'px,0)');

                toursGalleryItem.mouseenter(function(){
                    contentHolder.css('transform','translate3d(0,0,0)');
                });

                toursGalleryItem.mouseleave(function(){
                    deltaY = Math.ceil(excerpt.height());
                    contentHolder.css('transform','translate3d(0,'+deltaY+'px,0)');
                });
            });
        }
    }

    function initTopReviewsCarousel() {
        var $carousels = $('.mkdf-tours-top-reviews-carousel');
        
        if($carousels.length && typeof $.fn.owlCarousel !== 'undefined') {
            $carousels.each(function() {
                var $thisCarousel = $(this),
                    carouselItem = $thisCarousel.find('.mkdf-tours-top-reviews-carousel-item');;

                if (!$thisCarousel.hasClass('owl-carousel')) {
                    $thisCarousel.addClass('owl-carousel');
                }
    
                var $loop = true;
                if(carouselItem.length <= 1) {
                    $loop = false;
                }

                var fadeSlides = function () {
                    var slides = $thisCarousel.find('.owl-item');

                    slides.removeClass('mkdf-slide-fade-in mkdf-slide-fade-out');
                    slides.each(function () {
                        var currentSlide = $(this),
                            sliderWindowOffsetLeft = $thisCarousel.find('.owl-stage-outer').offset().left,
                            sliderWindowWidth = $thisCarousel.find('.owl-stage-outer').outerWidth(),
                            currentSlideOffsetLeft = currentSlide.offset().left,
                            currentSlideWidth = currentSlide.outerWidth();
                            
                        if (currentSlideOffsetLeft >= sliderWindowOffsetLeft && currentSlideOffsetLeft + currentSlideWidth <= sliderWindowOffsetLeft + sliderWindowWidth){
                            currentSlide.removeClass('mkdf-slide-fade-in').addClass('mkdf-slide-fade-out'); //fade out currently active slide
                            currentSlide.next().removeClass('mkdf-slide-fade-out').addClass('mkdf-slide-fade-in'); //fade in only first siblings - that might come into active state
                            currentSlide.prev().removeClass('mkdf-slide-fade-out').addClass('mkdf-slide-fade-in'); //fade in only first siblings - that might come into active state
                        }
                    });
                };
                
                $thisCarousel.owlCarousel({
                    items: 1,
                    loop: $loop,
                    autoplay: true,
                    autoplayTimeout:3000,
                    smartSpeed: 500,
                    autoplayHoverPause:true,
                    nav: true,
                    dots: false,
                    mouseDrag: false,
                    touchDrag: false,
                    navText: [
                        '<span class="mkdf-prev-icon"><span class="lnr lnr-chevron-left"></span></span>',
                        '<span class="mkdf-next-icon"><span class="lnr lnr-chevron-right"></span></span>'
                    ],
                    onInitialized: function(){
                        $thisCarousel.css('visibility','visible');
                        $thisCarousel.find('.owl-item').not('.active').addClass('mkdf-slide-fade-out');
                        $thisCarousel.find('.owl-item').filter('.active').addClass('mkdf-slide-fade-in');
                    },
                    onChange: function() {
                        fadeSlides();
                    }
                });
            });
        }
    }
    
    return tours;
})(jQuery);
