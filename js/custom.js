// for form validition
(function () {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.querySelectorAll('.needs-validation')

    // Loop over them and prevent submission
    Array.prototype.slice.call(forms)
        .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }

                form.classList.add('was-validated')
            }, false)
        })
})()

// show search input on responcive time
$('.res_s_btn').on("click", function () {
    var windowsize = $(window).width();
    if (windowsize < 591) {
        $('.res_s_in').show();
        $(".res_search").css("right", "2px")
        $(".res_s_btn").css("position", "relative")
        $(".res_s_btn").css("top", "0")
        $(".res_search").css("width", "100%")
        $(".res_s_in").css("width", "100%")
        // $(".res_logo_search a").hide();
        // $(".res_logo_search a").removeClass("d-block")
        $(".res_logo_search button").fadeOut();
    }
})
var container = $(".res_search");
var container1 = $(".search_res1");
var container2 = $(".search_res2");

$(document).on("mouseup", function (e) {
    var windowsize = $(window).width();
    if (!container1.is(e.target) && container1.has(e.target).length === 0) {
        if ($(e.target).is($(".search_res1 li"))) {
            $(".search_res1").show();
        } else {
            $(".search_res1").hide();

        }
    }
    if (!container2.is(e.target) && container2.has(e.target).length === 0) {
        if ($(e.target).is($(".search_res2 li"))) {
            $(".search_res2").show();
        } else {
            $(".search_res2").hide();

        }
    }
    if (windowsize < 590) {
        if (!container.is(e.target) && container.has(e.target).length === 0) {
            if ($(e.target).is($(".manu"))) {} else {
                // container.hide();
                $('.res_s_in').hide();
                $(".res_s_btn").css("position", "absolute")
                $(".res_logo_search button").fadeIn();
                $(".res_search").css("right", "70px")
                $(".res_s_btn").css("top", "5px")


            }
        }
    }
})
$(window).on("resize", function () {
    var windowsize = $(window).width();
    if (windowsize > 590) {
        // $(".res_s_btn").css("position", "relative")
        $(".res_s_btn").css("right", "0")
        $(".res_s_btn").css("z-index", "4")

        $(".res_search").css("width", "50%");
        $('.res_s_in').show();
        $(".res_search").css("right", "60px")
        if (windowsize < 990) {
            $(".res_logo_search button").show();
        }
    }


})
// check foucus and sohow searche list
$(document).on("keyup", ".for_focus1", function () {
    $('.search_res1').css("display", "block")
    var val = $('.for_focus1').val();
    // alert(val)
    $.ajax({
        url: "gets.php",
        type: "post",
        data: {
            val: val,
            search: "search"
        },
        success: function (data) {

            $('.search_res1 ul').html(data);
        }
    })

})
$(document).on("keyup", ".for_focus2", function () {
    // if ($(".for_foucs").is(":focus")) {
    // console.log($('.res_search'))
    $('.search_res2').fadeIn()
    // }
})
$(".for_focus1").focusout(function () {
    // $('.search_res1').fadeOut()

});
$(".for_focus2").focusout(function () {
    // $('.search_res2').fadeOut()

});
// password show and hide
function myFunction() {
    var x = $("#lpassword")
    console.log(x)
    if (x.attr('type') === "password") {
        x.attr('type', 'text');
        $('.pass_show').html('<i class="fa fa-eye-slash"></i>');
    } else {
        x.attr('type', 'password')
        $('.pass_show').html('<i class="fa fa-eye"></i>')
    }
}

function myFunction2() {
    var x = $("#rpass")
    console.log(x)
    if (x.attr('type') === "password") {
        x.attr('type', 'text');
        $('.pass_show').html('<i class="fa fa-eye-slash"></i>');
    } else {
        x.attr('type', 'password')
        $('.pass_show').html('<i class="fa fa-eye"></i>')
    }
}
// Prevent closing from click inside dropdown
$(document).on('click', '.dropdown-menu', function (e) {

    e.stopPropagation();
});

// make it as accordion for smaller screens
if ($(window).width() < 992) {
    $('.dropdown-menu .not_li').click(function (e) {
        e.preventDefault();
        if ($(this).next('.submenu').length) {
            $(this).next('.submenu').toggle();
        }
        $('.dropdown').on('hide.bs.dropdown', function () {
            $(this).find('.submenu').hide();
        })
    });
}

//login user
$(document).on('submit', '#login_form', function (e) {
    // alert("bqall")
    e.preventDefault();
    var lemail = $('#lemail').val();
    var lpass = $('#lpassword').val();
    var success = "y";
    if (lemail == "" || lpass == "") {
        $(".error_l").html("Please fill up all field")
        $('.error_l').fadeIn(500);
    } else {
        $.ajax({
            url: "log_reg.php",
            type: "post",
            data: {
                lemail: lemail,
                lpass: lpass,
                login: success
            },
            beforeSend: function () {
                $('.loader_sec').show();
            },
            success: function (data) {
                if (data == "") {
                    location.reload();
                } else {
                    $('.loader_sec').hide();
                    $(".error_l").html(data)
                    $('.error_l').fadeIn(500);
                }

            }
        })
    }

})

//reg form
$(document).on('submit', '#reg_form', function (e) {
    e.preventDefault();

    var fdata = new FormData(this);
    fdata.append("regs", "success")

    $.ajax({
        url: "log_reg.php",
        type: "post",
        processData: false,
        contentType: false,
        data: fdata,
        beforeSend: function () {
            $('.loader_sec').show();
        },
        success: function (data) {
            if (data == "") {
                $('.loader_sec').hide();

                // $(".error_r").html("We have sent a verification code to your email…check it…");
                // $('#reg_form').trigger("reset");
                window.location.reload();
            }
            if (data == 'email is already here..') {
                $('.loader_sec').hide();
                $(".error_r").html(data)
                $('.error_r').fadeIn(500);

            }

        }
    })


})
//log out
$(document).on("click", ".logout", function () {
    $.ajax({
        url: "log_reg.php",
        type: 'post',
        data: {
            logout: "log"
        },
        beforeSend: function () {
            var lodd = '<div class="loader_sec"><div class="box"><div class="loader-30"></div></div> </div>'
            $('body').append(lodd)
        },
        success: function (d) {
            location.reload();
        }
    })
})
//open modal for cart and favorit
$(".show_cart a").on("click", function (e) {
    e.preventDefault()
    if ($(this).hasClass("cart_icon")) {
        $.ajax({
            url: 'log_reg.php',
            type: "post",
            data: {
                ses: "s"
            },
            success: function (d) {
                if (d == "unsuccessful") {
                    $('#lmodel').modal('show')
                } else {
                    window.location.href = 'cart.php'
                }
            }
        })
    }
    if ($(this).hasClass("fav_icon")) {
        $.ajax({
            url: 'log_reg.php',
            type: "post",
            data: {
                ses: "s"
            },
            success: function (d) {
                if (d == "unsuccessful") {
                    $('#lmodel').modal('show')
                } else {
                    window.location.href = 'fav.php'
                }
            }
        })
    }

})
// add to chart
$(document).on("click", '.add_favi', function (e) {
    e.preventDefault();
    var val = $(this).data('attr');

    $.ajax({
        url: "response.php",
        type: "post",
        data: {
            getamod: val
        },
        success: function (d) {
            if (d == "success") {
                $('.ambody').html('Are you sure ?')
                $('.maction').html('Add to favorit')
                $('.maction').attr("data-attr", val);
                $('.maction').addClass('afav');
                $('#adcartm').modal('show')
            } else {
                $('#lmodel').modal('show')
            }
        }
    })
})


$(document).on("click", '.add_carti', function (e) {
    e.preventDefault();
    var val = $(this).data('attr');

    $.ajax({
        url: "response.php",
        type: "post",
        data: {
            getmod1: val
        },
        success: function (d) {
            if (d == "success") {
                $('.ambody').html('Are you sure ?')
                $('.maction').html('Add to cart')
                $('.maction').attr("data-attr", val);
                $('.maction').addClass('atca');
                $('#adcartm').modal('show')
            } else {
                $('#lmodel').modal('show')
            }
        }
    })
})
// add chart and fav
$(document).on("click", '.atca', function (e) {
    e.preventDefault()
    var val = $(this).attr('data-attr');
    $.ajax({
        url: "response.php",
        type: "post",
        data: {
            addcart: val
        },
        success: function (d) {
            if (d == "success") {
                alert("product added successfully...");
                $('#adcartm').modal('hide');
                var f = Number($('.cart_icon span').html()) + 1;
                $('.cart_icon span').html(f)
            } else {
                alert("product already on your cart.");
                $('#adcartm').modal('hide')


            }
        }
    })
})
$(document).on("click", '.afav', function (e) {
    e.preventDefault()
    var val = $(this).attr('data-attr');
    $.ajax({
        url: "response.php",
        type: "post",
        data: {
            addfav: val
        },
        success: function (d) {
            if (d == "success") {
                alert("product added successfully...");
                $('#adcartm').modal('hide')
                var f = Number($('.fav_icon span').html()) + 1;
                $('.fav_icon span').html(f)

            } else {
                alert("product already on your favorit.");
                $('#adcartm').modal('hide')

            }
        }
    })
})

// remove from favorit
$(document).on("click", '.favremove', function () {
    var val = $(this).data('attr');
    var thiss = $(this);
    $.ajax({
        url: "response.php",
        type: "post",
        data: {
            favremove: val
        },
        success: function (d) {
            if (d == 'success') {
                thiss.parent().parent().remove()
            } else {
                alert(d)
            }
        }
    })
})