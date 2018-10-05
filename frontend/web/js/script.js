
/*-----accordion-in-search-page--------*/
$('.filter-header').on('click', function () {
    $(this).find( ".toggle" ).toggle(1,function() {
        $(this).find('.fa-plus').show();
        $(this).find('.fa-minus').hide();
    });
});

/*-----tabs-login-signup-forms--------*/
$(document).ready(function () {
    $('.dws-form').on('click', '.tab', function () {
        $('.dws-form').find('.active').removeClass('active');
        $(this).addClass('active');
        $('.tab-form').eq($(this).index()).addClass(' active');
    });
});

//mask
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a("object"==typeof exports?require("jquery"):jQuery)}(function(a){var b,c=navigator.userAgent,d=/iphone/i.test(c),e=/chrome/i.test(c),f=/android/i.test(c);a.mask={definitions:{9:"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"},autoclear:!0,dataName:"rawMaskFn",placeholder:"_"},a.fn.extend({caret:function(a,b){var c;if(0!==this.length&&!this.is(":hidden"))return"number"==typeof a?(b="number"==typeof b?b:a,this.each(function(){this.setSelectionRange?this.setSelectionRange(a,b):this.createTextRange&&(c=this.createTextRange(),c.collapse(!0),c.moveEnd("character",b),c.moveStart("character",a),c.select())})):(this[0].setSelectionRange?(a=this[0].selectionStart,b=this[0].selectionEnd):document.selection&&document.selection.createRange&&(c=document.selection.createRange(),a=0-c.duplicate().moveStart("character",-1e5),b=a+c.text.length),{begin:a,end:b})},unmask:function(){return this.trigger("unmask")},mask:function(c,g){var h,i,j,k,l,m,n,o;if(!c&&this.length>0){h=a(this[0]);var p=h.data(a.mask.dataName);return p?p():void 0}return g=a.extend({autoclear:a.mask.autoclear,placeholder:a.mask.placeholder,completed:null},g),i=a.mask.definitions,j=[],k=n=c.length,l=null,a.each(c.split(""),function(a,b){"?"==b?(n--,k=a):i[b]?(j.push(new RegExp(i[b])),null===l&&(l=j.length-1),k>a&&(m=j.length-1)):j.push(null)}),this.trigger("unmask").each(function(){function h(){if(g.completed){for(var a=l;m>=a;a++)if(j[a]&&C[a]===p(a))return;g.completed.call(B)}}function p(a){return g.placeholder.charAt(a<g.placeholder.length?a:0)}function q(a){for(;++a<n&&!j[a];);return a}function r(a){for(;--a>=0&&!j[a];);return a}function s(a,b){var c,d;if(!(0>a)){for(c=a,d=q(b);n>c;c++)if(j[c]){if(!(n>d&&j[c].test(C[d])))break;C[c]=C[d],C[d]=p(d),d=q(d)}z(),B.caret(Math.max(l,a))}}function t(a){var b,c,d,e;for(b=a,c=p(a);n>b;b++)if(j[b]){if(d=q(b),e=C[b],C[b]=c,!(n>d&&j[d].test(e)))break;c=e}}function u(){var a=B.val(),b=B.caret();if(o&&o.length&&o.length>a.length){for(A(!0);b.begin>0&&!j[b.begin-1];)b.begin--;if(0===b.begin)for(;b.begin<l&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}else{for(A(!0);b.begin<n&&!j[b.begin];)b.begin++;B.caret(b.begin,b.begin)}h()}function v(){A(),B.val()!=E&&B.change()}function w(a){if(!B.prop("readonly")){var b,c,e,f=a.which||a.keyCode;o=B.val(),8===f||46===f||d&&127===f?(b=B.caret(),c=b.begin,e=b.end,e-c===0&&(c=46!==f?r(c):e=q(c-1),e=46===f?q(e):e),y(c,e),s(c,e-1),a.preventDefault()):13===f?v.call(this,a):27===f&&(B.val(E),B.caret(0,A()),a.preventDefault())}}function x(b){if(!B.prop("readonly")){var c,d,e,g=b.which||b.keyCode,i=B.caret();if(!(b.ctrlKey||b.altKey||b.metaKey||32>g)&&g&&13!==g){if(i.end-i.begin!==0&&(y(i.begin,i.end),s(i.begin,i.end-1)),c=q(i.begin-1),n>c&&(d=String.fromCharCode(g),j[c].test(d))){if(t(c),C[c]=d,z(),e=q(c),f){var k=function(){a.proxy(a.fn.caret,B,e)()};setTimeout(k,0)}else B.caret(e);i.begin<=m&&h()}b.preventDefault()}}}function y(a,b){var c;for(c=a;b>c&&n>c;c++)j[c]&&(C[c]=p(c))}function z(){B.val(C.join(""))}function A(a){var b,c,d,e=B.val(),f=-1;for(b=0,d=0;n>b;b++)if(j[b]){for(C[b]=p(b);d++<e.length;)if(c=e.charAt(d-1),j[b].test(c)){C[b]=c,f=b;break}if(d>e.length){y(b+1,n);break}}else C[b]===e.charAt(d)&&d++,k>b&&(f=b);return a?z():k>f+1?g.autoclear||C.join("")===D?(B.val()&&B.val(""),y(0,n)):z():(z(),B.val(B.val().substring(0,f+1))),k?b:l}var B=a(this),C=a.map(c.split(""),function(a,b){return"?"!=a?i[a]?p(b):a:void 0}),D=C.join(""),E=B.val();B.data(a.mask.dataName,function(){return a.map(C,function(a,b){return j[b]&&a!=p(b)?a:null}).join("")}),B.one("unmask",function(){B.off(".mask").removeData(a.mask.dataName)}).on("focus.mask",function(){if(!B.prop("readonly")){clearTimeout(b);var a;E=B.val(),a=A(),b=setTimeout(function(){B.get(0)===document.activeElement&&(z(),a==c.replace("?","").length?B.caret(0,a):B.caret(a))},10)}}).on("blur.mask",v).on("keydown.mask",w).on("keypress.mask",x).on("input.mask paste.mask",function(){B.prop("readonly")||setTimeout(function(){var a=A(!0);B.caret(a),h()},0)}),e&&f&&B.off("input.mask").on("input.mask",u),A()})}})});


((function ($) {
    $(function(){

        $(document).ready(function() {
            $("[data-mask='callback-catalog-phone']").mask("+3 80 9 9  9 9 9  9 9  9 9");
        });
    })
})(jQuery));


$('.open-popup-more_md').magnificPopup({
    type:'inline',
    midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
});

$('.open-popup-phones_md').magnificPopup({
    type:'inline',
    midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
});

/*-----gallery-in-company-page--------*/
$('.center').slick({
    centerMode: true,
    infinite: true,
    centerPadding: '60px',
    slidesToShow: 3,
    speed: 300,
    prevArrow: $('.gallery-prev'),
    nextArrow: $('.gallery-next'),
    variableWidth: false,
    autoplay:true,
    autoplaySpeed: 2000,
    responsive: [
        {
            breakpoint: 768,
            settings: {
                arrows: false,
                centerMode: true,
                centerPadding: '40px',
                slidesToShow: 1
            }
        }
    ],
});

/*-----open-images-in-popup--------*/
$('.clip a').magnificPopup({
    type: 'image'
    // other options
});


$('.accordion-title').on('click', function () {
    $(this).find( ".toggle" ).toggle(10,function() {
        $(this).find('.fa-angle-up').show();
        $(this).find('.fa-angle-down').hide();
    });
});


/*-----related-courses--------*/
$('.course-related-carousel').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    speed: 300,
    prevArrow: $('.related-prev'),
    nextArrow: $('.related-next'),
    variableWidth: false,
    autoplay:true,
    autoplaySpeed: 2000,
    responsive: [
        {
            breakpoint: 1200,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
            }
        },
        {
            breakpoint: 992,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1,
                infinite: true,
            }
        },
        {
            breakpoint: 500,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});


$('.create-review').magnificPopup({
    type:'inline',
    midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
});


/*-----favorite-toggle--------*/
$('.favorite-toggle').on('click', function () {
    if ($(this).html().trim() == '<i class="fa fa-heart-o"></i>') {
        $(this).html('<i class="fa fa-heart"></i>');
    }
    else {
        $(this).html('<i class="fa fa-heart-o"></i>');
    }
    return false;
});


//feedback-form
$( ".feedback-form" ).submit(function( event ) {
    event.preventDefault();
    $.magnificPopup.open({
        items: {
            src: '#feedback_modal'
        },
        type: 'inline'
    });
});

/*-----tabs-cabinet-company--------*/
$(document).ready(function () {
    $('.cabinet-company').on('click', '.tab-company', function () {
        $('.cabinet-company').find('.active').removeClass('active');
        $(this).addClass('active');
        $('.tab-cabinet-container').eq($(this).index()).addClass(' active');
    });
});


/*-----add-course-form--------*/

$(document).ready(function(){
    $('#btn_main_info').click(function(){
        var error_photo = '';
        var error_name = '';
        var error_city = '';
        var error_category = '';
        var error_price = '';
        var error_type_education = '';
        var error_form_education = '';
        var error_quantity_group = '';
        var error_level = '';
        var error_result = '';

        // var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        var filter_price = /^[0-9.]{1,}$/;

        if($.trim($('.photo_course').val()).length == 0) {
            error_photo = 'Загрузите пожалуйста фото курса';
            $('#error_photo').text(error_photo);
        } else {
            error_photo = '';
            $('#error_photo').text(error_photo);
        }

        if($.trim($('#name').val()).length == 0) {
            error_name = 'Введите названия курса';
            $('#error_name').text(error_name);
        } else {
            error_name = '';
            $('#error_name').text(error_name);
        }

        if($('#city').val() == '0') {
            error_city = 'Выберите город';
            $('#error_city').text(error_city);
        } else {
            error_city = '';
            $('#error_city').text(error_city);
        }

        if($('#category').val() == '0') {
            error_category = 'Выберите категорию';
            $('#error_category').text(error_category);
        } else {
            error_category = '';
            $('#error_category').text(error_category);
        }

        if($.trim($('#price').val()).length == 0) {
            error_price = 'Введите цену курса';
            $('#error_price').text(error_price);
        } else {
            if (!filter_price.test($('#price').val())) {
                error_price = 'Введите коректную цену';
                $('#error_price').text(error_price);
            } else {
                error_price = '';
                $('#error_price').text(error_price);
            }
        }

        if($('#type_education').val() == '0') {
            error_type_education = 'Выберите тип курса';
            $('#error_type_education').text(error_type_education);
        } else {
            error_type_education = '';
            $('#error_type_education').text(error_type_education);
        }

        if($('#form_education').val() == '0') {
            error_form_education = 'Выберите форму курса';
            $('#error_form_education').text(error_form_education);
        } else {
            error_form_education = '';
            $('#error_form_education').text(error_form_education);
        }

        if($('#quantity_group').val() == '0') {
            error_quantity_group = 'Выберите групу';
            $('#error_quantity_group').text(error_quantity_group);
        } else {
            error_quantity_group = '';
            $('#error_quantity_group').text(error_quantity_group);
        }

        if($('#level').val() == '0') {
            error_level = 'Выберите уровень подготовки';
            $('#error_level').text(error_level);
        } else {
            error_level = '';
            $('#error_level').text(error_level);
        }

        if($('#result').val() == '0') {
            error_result = 'Выберите документ';
            $('#error_result').text(error_result);
        } else {
            error_result = '';
            $('#error_result').text(error_result);
        }


        if(error_photo != '' || error_name != '' || error_category != '' || error_city != '' || error_price != ''
            || error_type_education != '' || error_form_education != '' || error_quantity_group != ''
            || error_level != '' || error_result != '')
        {
            return false;
        }
        else
        {
            $('#list_main_info').removeClass('active active_tab1');
            $('#list_main_info').removeAttr('href data-toggle');
            $('#main_info').removeClass('active');
            $('#list_main_info').addClass('inactive_tab1');
            $('#list_description_info').removeClass('inactive_tab1');
            $('#list_description_info').addClass('active_tab1 active');
            $('#list_description_info').attr('href', '#description_info');
            $('#list_description_info').attr('data-toggle', 'tab');
            $('#description_info').addClass('active in');
        }
    });

    $('#previous_btn_description').click(function(){
        $('#list_description_info').removeClass('active active_tab1');
        $('#list_description_info').removeAttr('href data-toggle');
        $('#description_info').removeClass('active in');
        $('#list_description_info').addClass('inactive_tab1');
        $('#list_main_info').removeClass('inactive_tab1');
        $('#list_main_info').addClass('active_tab1 active');
        $('#list_main_info').attr('href', '#main_info');
        $('#list_main_info').attr('data-toggle', 'tab');
        $('#main_info').addClass('active in');
    });

    $('#btn_description').click(function(){
        var error_description = '';

        if($.trim($('#description').val()).length == 0) {
            error_description = 'Введите описание о курсе';
            $('#error_description').text(error_description);
        } else {
            error_description = '';
            $('#error_description').text(error_description);
        }

        if(error_description != '')
        {
            return false;
        }
    });

});

/*-----add-course-photo-course--------*/
if ($('div').is('#photo_course')) {
    $("#photo_course").spartanMultiImagePicker({
        fieldName:  'photo_course',
        maxCount : 1,
        rowHeight : '150px',
        groupClassName : 'col-sm-4 col-xs-6',
        dropFileLabel:    'Drop file here',
    });
}

/*-----add-course-photo-gallery--------*/
if ($('div').is('#gallery')) {
    $("#gallery").spartanMultiImagePicker({
        fieldName:  'galleryPhotos[]',
        maxCount : 10,
        rowHeight : '170px',
        groupClassName : 'col-sm-3 col-xs-6',
        dropFileLabel:    'Drop file here',
    });
}

/*-----company-add-photo-profile--------*/
if ($('div').is('#photo_profile_company')) {
    $("#photo_profile_company").spartanMultiImagePicker({
        fieldName:  'photo_profile_company',
        maxCount : 1,
        rowHeight : '170px',
        groupClassName : 'col-sm-4 col-xs-7',
        dropFileLabel:    'Drop file here',
    });
}

/*-----carousel in orders small-screen--------*/
// $('.orders-slider').slick({
//     dots: true,
//     infinite: true,
//     speed: 300,
//     slidesToShow: 1,
//     adaptiveHeight: true
// });

/*-----open-order-popup--------*/
$('.open-order-popup').magnificPopup({
    type:'inline',
    midClick: true // Allow opening popup on middle mouse click. Always set it to true if you don't provide alternative source in href.
});

/*-----carousel in orders small-screen--------*/
if ($('div').is('.owl-carousel')) {
    $(document).ready(function(){
        $(".owl-carousel").owlCarousel({
            items: 1,
            center: true,
            nav: true,
        });
    });
}



/*----custom-select-----*/

var x, i, j, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
    selElmnt = x[i].getElementsByTagName("select")[0];
    /*for each element, create a new DIV that will act as the selected item:*/
    a = document.createElement("DIV");
    a.setAttribute("class", "select-selected");
    a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
    x[i].appendChild(a);
    /*for each element, create a new DIV that will contain the option list:*/
    b = document.createElement("DIV");
    b.setAttribute("class", "select-items select-hide");
    for (j = 1; j < selElmnt.length; j++) {
        /*for each option in the original select element,
        create a new DIV that will act as an option item:*/
        c = document.createElement("DIV");
        c.innerHTML = selElmnt.options[j].innerHTML;
        c.addEventListener("click", function(e) {
            /*when an item is clicked, update the original select box,
            and the selected item:*/
            var y, i, k, s, h;
            s = this.parentNode.parentNode.getElementsByTagName("select")[0];
            h = this.parentNode.previousSibling;
            for (i = 0; i < s.length; i++) {
                if (s.options[i].innerHTML == this.innerHTML) {
                    s.selectedIndex = i;
                    h.innerHTML = this.innerHTML;
                    y = this.parentNode.getElementsByClassName("same-as-selected");
                    for (k = 0; k < y.length; k++) {
                        y[k].removeAttribute("class");
                    }
                    this.setAttribute("class", "same-as-selected");
                    break;
                }
            }
            h.click();
        });
        b.appendChild(c);
    }
    x[i].appendChild(b);
    a.addEventListener("click", function(e) {
        /*when the select box is clicked, close any other select boxes,
        and open/close the current select box:*/
        e.stopPropagation();
        closeAllSelect(this);
        this.nextSibling.classList.toggle("select-hide");
        this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
    /*a function that will close all select boxes in the document,
    except the current select box:*/
    var x, y, i, arrNo = [];
    x = document.getElementsByClassName("select-items");
    y = document.getElementsByClassName("select-selected");
    for (i = 0; i < y.length; i++) {
        if (elmnt == y[i]) {
            arrNo.push(i)
        } else {
            y[i].classList.remove("select-arrow-active");
        }
    }
    for (i = 0; i < x.length; i++) {
        if (arrNo.indexOf(i)) {
            x[i].classList.add("select-hide");
        }
    }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);

if ($('div').is('#price_my_range')) {
    var keypressSlider = document.getElementById('price_my_range');
    var input0 = document.getElementById('min_price');
    var input1 = document.getElementById('max_price');
    var inputs = [input0, input1];

    noUiSlider.create(keypressSlider, {
        start: [100, 10000],
        connect: true,
        // direction: 'rtl',
        // tooltips: [true, wNumb({decimals: 1})],
        range: {
            'min': [100],
            '1%': 200,
            'max': 10000
        }
    });
    function setSliderHandle(i, value) {
        var r = [null, null];
        r[i] = value;
        keypressSlider.noUiSlider.set(r);
    }
// Listen to keydown events on the input field.
    inputs.forEach(function (input, handle) {
        input.addEventListener('change', function () {
            setSliderHandle(handle, this.value);
        });
        input.addEventListener('keydown', function (e) {
            var values = keypressSlider.noUiSlider.get();
            var value = Number(values[handle]);
            // [[handle0_down, handle0_up], [handle1_down, handle1_up]]
            var steps = keypressSlider.noUiSlider.steps();
            // [down, up]
            var step = steps[handle];
            var position;
            // 13 is enter,
            // 38 is key up,
            // 40 is key down.
            switch (e.which) {
                case 13:
                    setSliderHandle(handle, this.value);
                    break;
                case 38:
                    // Get step to go increase slider value (up)
                    position = step[1];
                    // false = no step is set
                    if (position === false) {
                        position = 1;
                    }
                    // null = edge of slider
                    if (position !== null) {
                        setSliderHandle(handle, value + position);
                    }
                    break;
                case 40:
                    position = step[0];
                    if (position === false) {
                        position = 1;
                    }
                    if (position !== null) {
                        setSliderHandle(handle, value - position);
                    }
                    break;
            }
        });
    });
    keypressSlider.noUiSlider.on('update', function (values, handle) {
        inputs[handle].value = values[handle];
    });
}

if ($('ul').is('#main-menu')) {
    $(function() {
        $('#main-menu').smartmenus();
    });
}
