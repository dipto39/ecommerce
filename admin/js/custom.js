// var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
// var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
//   return new bootstrap.Tooltip(tooltipTriggerEl)
// })
// $(document).ready(function () {
//   $('[data-toggle="tooltip"]').tooltip();
// });
$('#confirm').on("click", function () {
  $('#changes').modal('hide');
})
$('.ball').on("click", function () {

  console.log($(".ball").html())
})
$(document).on("click", ".show_sub", function (e) {
  var dd = $(this).parent()
  dd.siblings().fadeToggle()

})
$(document).on("click", ".show_sup", function (e) {
  var dd = $(this).parent()
  dd.siblings().fadeToggle()
})
/// delete main category
$(document).on("click", '.dmcata', function (e) {
  var val = $(this).data('attr');
  $.ajax({
    url: "res.php",
    type: 'post',
    data: {
      dmcata: val
    },
    success: function (data) {
      alert(data)
      window.location.reload()
    }
  })
})
/// delete Sub category
$(document).on("click", '.dsubcata', function (e) {
  var val = $(this).data('attr');
  $.ajax({
    url: "res.php",
    type: 'post',
    data: {
      dsubcata: val
    },
    success: function (data) {
      alert(data)
      window.location.reload()
    }
  })
})
/// delete sup category
$(document).on("click", '.dsupcata', function (e) {
  var val = $(this).data('attr');
  $.ajax({
    url: "res.php",
    type: 'post',
    data: {
      dsupcata: val
    },
    success: function (data) {
      alert(data)
      window.location.reload()
    }
  })
})
/// preview product image
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#blah').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$(document).on('change', "#imgInp", function () {
  readURL(this);
});
//show hide catagory
$(document).on("change", "#category", function () {
  var val = $(this).val();

  $.ajax({
    url: "res.php",
    type: 'post',
    data: {
      subcata: val
    },
    success: function (d) {
      $('.cata1').html(d)
    }
  })
  $(".cata1").fadeIn();
  $('#subcategory').prop('selectedIndex', 0);
  $(".cata2").fadeOut();

})
$(document).on("change", "#subcategory", function () {
  var val = $(this).val();
  $.ajax({
    url: "res.php",
    type: 'post',
    data: {
      supcata: val
    },
    success: function (d) {
      $('.cata2').html(d)
    }
  })
  $(".cata2").fadeIn();
  $('#supcategory').prop('selectedIndex', 0);

})

//admin login 
$(document).on("submit", "#lform", function (e) {
  e.preventDefault();
  var email = $('#lemail').val();
  var pass = $('#lpass').val();
  if (email == "" || pass == "") {
    alert("pleace enter all filed");
  } else {
    $.ajax({
      url: "res.php",
      type: "post",
      data: {
        email: email,
        pass: pass,
        login: "login"
      },
      success: function (d) {
        if (d == "") {
          window.location.replace("dashboard.php");
        } else {
          $('.ems').html("Email or password are not match");
          $(".ems").fadeIn()
        }
      }
    })
  }
})

//logout
$('.logout').on("click", function () {
  $.ajax({
    url: 'res.php',
    type: 'post',
    data: {
      logout: "logout"
    },
    success: function (e) {
      if (e == 'logout') {
        window.location.reload();
      }
    }
  })
})

//add product 
$(document).on('submit', '#addProduct', function (e) {
  e.preventDefault();
  var err = [];
  if ($('#pname').val().length < 5) {
    err.push('Product name must be longer than 5 characters.')
  }
  if ($('#des').val().length < 20) {
    err.push('description must be longer than 20 characters.')
  }
  if ($('#ainfo').val().length < 20) {
    err.push('additional information must be longer than 20 characters.')
  }
  var colors = []
  $('.scolor:checkbox:checked').each(function () {
    var color = (this.checked ? $(this).val() : "");
    colors.push(color)
  });
  var sizes = []

  $('.size:checkbox:checked').each(function () {
    var size = (this.checked ? $(this).val() : "");
    sizes.push(size);

  });
  if (sizes.length === 0) {
    err.push("pleace select size")
  }
  if (colors.length === 0) {
    err.push("pleace select color")
  }
  if ($('#imgInp')[0].files.length === 0) {
    err.push("No image selected");
  }
  if (err.length == 0) {
    var fdata = new FormData(this);
    fdata.append("addp", "success")
    fdata.append("colors", colors)
    fdata.append("sizes", sizes)

    $.ajax({
      url: "res.php",
      type: "post",
      processData: false,
      contentType: false,
      data: fdata,
      success: function (d) {
        alert(d)
      }
    })
  } else {
    var data = '';
    err.forEach(element => {
      data += "<li>" + element + "</li>";
    });
    $('.errbody').html("<ul class='text-danger'>" + data) + "</ul>";
    $('#adderror').modal('show')
  }

})

// get all product

function getp() {
  $.ajax({
    url: 'res.php',
    type: "post",
    data: {
      getp: "success"
    },
    success: function (d) {
      $('.otabel tbody').html(d)
    }
  })
}
getp()
/// serarch product
$(document).on("keyup", '#osearch', function () {
  $('.closeose').fadeIn();
  var val = $(this).val()
  $.ajax({
    url: 'res.php',
    type: 'post',
    data: {
      oserarch: val
    },
    success: function (d) {
      $('.otabel tbody').html(d)
    }
  })
})
/// cancel search

$(document).on("click", '.csorder', function () {
  $('.closeose').fadeOut();
  getp()

})

/// delete product
$(document).on("click", ".tm-product-delete-link", function () {

})
$(document).on("click", ".tm-product-delete-icon", function (e) {
  e.preventDefault();
  var da = $(this).parent().data('attr');
  var t = $(this);
  $.ajax({
    url: 'res.php',
    type: 'post',
    data: {
      delete: da
    },
    success: function (d) {
      if (d == 'delete') {
        t.parent().parent().parent().remove()
      }


    }
  })
})
/// update product
$(document).on("submit", "#upform", function (e) {
  e.preventDefault();
  var err = [];
  if ($('#pname').val().length < 5) {
    err.push('Product name must be longer than 5 characters.')
  }
  if ($('#des').val().length < 20) {
    err.push('description must be longer than 20 characters.')
  }
  if ($('#ainfo').val().length < 20) {
    err.push('additional information must be longer than 20 characters.')
  }
  var colors = []
  $('.scolor:checkbox:checked').each(function () {
    var color = (this.checked ? $(this).val() : "");
    colors.push(color)
  });
  var sizes = []

  $('.size:checkbox:checked').each(function () {
    var size = (this.checked ? $(this).val() : "");
    sizes.push(size);

  });
  if (sizes.length === 0) {
    err.push("pleace select size")
  }
  if (colors.length === 0) {
    err.push("pleace select color")
  }

  if (err.length == 0) {
    var fdata = new FormData(this);
    fdata.append("upproduct", "success")
    fdata.append("colors", colors)
    fdata.append("sizes", sizes)

    $.ajax({
      url: "res.php",
      type: "post",
      processData: false,
      contentType: false,
      data: fdata,
      success: function (d) {
        if (d == 'success' || d == "Product Update successfully") {
          window.location.href = 'products.php'
        }
      }
    })
  } else {
    var data = '';
    err.forEach(element => {
      data += "<li>" + element + "</li>";
    });
    $('.errbody').html("<ul class='text-danger'>" + data) + "</ul>";
    $('#adderror').modal('show')
  }
})

// add catagory section
$(document).on('change', '#acategory', function () {
  var val = $(this).val();
  if (!val == "") {

    $.ajax({
      url: "res.php",
      type: "post",
      data: {
        mcata: val
      },
      success: function (d) {
        $('.asubcata').html(d);
        $('.asubcata').show()
      }
    })
    $('.cnamee').html('<label for="category">Add sub catatory</label><input type="text" class="form-control" id="aval" required placeholder="Category name">');
  } else {
    $('.asubcata').hide()
    $('.cnamee').html('<label for="category">Add main catatory</label><input type="text" class="form-control" id="aval" required placeholder="Category name">');
  }


})
$(document).on('change', '#asubcata', function () {
  var val = $(this).val();
  if (!val == "") {
    $('.asubcata').show()
    $('.cnamee').html('<label for="category">Add sub catatory</label><input type="text" class="form-control" id="aval" required placeholder="Category name">');
  } else {
    $('.asubcata').hide()
    $('.cnamee').html('<label for="category">Add sup catatory</label><input type="text" class="form-control" id="aval" required placeholder="Category name">');
  }


})
$(document).on("submit", '.aform', function (e) {
  e.preventDefault();
  var cate = $('#acategory').val();
  var sub = $('#asubcata').val();
  var val = $('#aval').val();
  if (cate == "") {
    $.ajax({
      url: 'res.php',
      type: 'post',
      data: {
        amcata: val
      },
      success: function (e) {
        alert(e);
        window.location.reload();

      }
    })
  } else {
    if (sub == "") {

      $.ajax({
        url: 'res.php',
        type: 'post',
        data: {
          ascata: val,
          cid: cate
        },
        success: function (e) {
          alert(e);
          window.location.reload();
        }
      })
    } else {
      $.ajax({
        url: 'res.php',
        type: 'post',
        data: {
          asucata: val,
          cid: cate,
          sid: sub
        },
        success: function (e) {
          alert(e);
          window.location.reload();

        }
      })
    }
  }

})

// delete 