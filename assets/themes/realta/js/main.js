// -------------------------------------------------------------------------------------------
// empty links return false

$(document).ready(function(){
    $('a[href=#]').click(function (event) {
        event.preventDefault();
    });
    // fix html5 placeholder attribute for ie7 & ie8
    if ($.browser.msie && $.browser.version.substr(0, 1) < 9) { // ie7&ie8
        $('input[placeholder], textarea[placeholder]').each(function () {
            var input = $(this);

            $(input).val(input.attr('placeholder'));

            $(input).focus(function () {
                if (input.val() == input.attr('placeholder')) {
                    input.val('');
                }
            });

            $(input).blur(function () {
                if (input.val() == '' || input.val() == input.attr('placeholder')) {
                    input.val(input.attr('placeholder'));
                }
            });
        });
    }
});

// -------------------------------------------------------------------------------------------
// superfish menu

$(document).ready(function() {
    $('ul.sf-menu').superfish();
    // -------------------------------------------------------------------------------------------
    // create mobile menu from exist superfish menu

    $(document).ready(function () {
        var $menu = $('.site-navigation > ul'),
            optionsList = '<option value="" selected> - - Main Navigation - - </option>';

        $menu.find('li').each(function () {
            var $this = $(this),
                $anchor = $this.children('a'),
                depth = $this.parents('ul').length - 1,
                indent = '';

            if (depth) {
                while (depth > 0) {
                    indent += ' ::: ';
                    depth--;
                }
            }

            optionsList += '<option value="' + $anchor.attr('href') + '">' + indent + ' ' + $anchor.text() + '</option>';
        }).end().parent().parent().find('#res-menu').append('<select class="res-menu">' + optionsList + '</select><div class="res-menu-title">Navigation <i class="fa fa-angle-down"></i></div>');

        $('.res-menu').on('change', function () {
            window.location = $(this).val();
        });

    });
});

// prettyPhoto
$(document).ready(function(){
    $("a[rel^='prettyPhoto']").prettyPhoto({theme:'dark_square'});
});

// make google map search draggable
$(document).ready(function(){
    if($(".gmap-search").length){
        $(".gmap-search").draggable();
    }
});

// -------------------------------------------------------------------------------------------
// add hover class

var hover = $('.thumbnail');
hover.hover(
    function () {
        $(this).addClass('hover')
    },
    function () {
        $(this).removeClass('hover')
    }
)

// -------------------------------------------------------------------------------------------
// Selectbox

$(window).on('load', function () {
    $('.selectpicker').selectpicker();
});

// -------------------------------------------------------------------------------------------
// Isotope

$(window).resize(function () {
    // relayout on window resize
    $('.projects .items').isotope('reLayout');
});

$(window).load(function () {
    // cache container
    var $container = $('.projects .items');
    // initialize isotope
    $container.isotope({
        // options...
        itemSelector: '.item'
    });
    // filter items when filter link is clicked
    $('#filtrable a').click(function () {
        var selector = $(this).attr('data-filter');
        $("#filtrable li").removeClass("current");
        $(this).parent().addClass("current");
        $container.isotope({ filter: selector });
        return false;
    });
    $container.isotope('reLayout');
});

$(window).resize(function () {
    // relayout on window resize
    $('.gallery .items').isotope('reLayout');
});

$(window).load(function () {
    // cache container
    var $container = $('.gallery .items');
    // initialize isotope
    $container.isotope({
        // options...
        itemSelector: '.item'
    });
    // filter items when filter link is clicked
    $('#filtrable a').click(function () {
        var selector = $(this).attr('data-filter');
        $("#filtrable li").removeClass("current");
        $(this).parent().addClass("current");
        $container.isotope({ filter: selector });
        return false;
    });
});

// -------------------------------------------------------------------------------------------
// Owl Carousel

$(document).ready(function () {
    $("#featured").owlCarousel({
        /*items: 3,
        itemsDesktop: false,
        itemsDesktopSmall: [991, 2],
        itemsTablet: false,
        itemsMobile: [479, 1],*/
		items : 4, //4 items above 1824px browser width
		itemsDesktop : [1823,3], //3 items between 1823px and 1024px
		itemsDesktopSmall : [1023,2], // betweem 1023px and 601px
		itemsTablet: [603,1], //2 items between 603 and 0
		itemsMobile : false, // itemsMobile disabled - inherit from itemsTablet option
        autoPlay: false,
        pagination: false
    });
    $(".featured-next").click(function () {
        $("#featured").trigger('owl.next');
        return false;
    });
    $(".featured-prev").click(function () {
        $("#featured").trigger('owl.prev');
        return false;
    });
    $("#testimonials").owlCarousel({
        items: 2,
        itemsDesktop: false,
        itemsDesktopSmall: [991, 2],
        itemsTablet: [768, 1],
        itemsMobile: [479, 1],
        autoPlay: false,
        pagination: false
    });
    $(".testimonials-next").click(function () {
        $("#testimonials").trigger('owl.next');
        return false;
    });
    $(".testimonials-prev").click(function () {
        $("#testimonials").trigger('owl.prev');
        return false;
    });
    $("#partners").owlCarousel({
        items: 5,
        itemsDesktop: false,
        itemsDesktopSmall: [991, 4],
        itemsTablet: [768, 3],
        itemsMobile: [479, 2],
        autoPlay: false,
        pagination: false
    });
    $(".partners-next").click(function () {
        $("#partners").trigger('owl.next');
        return false;
    });
    $(".partners-prev").click(function () {
        $("#partners").trigger('owl.prev');
        return false;
    });
    $("#last-tweets").owlCarousel({singleItem: true, autoPlay: true, pagination: false });

});

