
<?php include 'header.php'?>

<div class="container">
        <div class="row">
            <div class="col">
                <p class="text-white mt-5 mb-5">Welcome back, <b>Admin</b></p>
            </div>
        </div>
        <!-- row -->
        <div class="row tm-content-row">

            <div class="col-12 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-taller tm-block-scroll">
                    <h2 class="tm-block-title">Orders List</h2>

                    <table class="table ortable">
                        <thead>
                            <tr class="text-right w-100 p-0 ">
                                <th class="p-0" colspan="8">
                                    <div class="search_order w-100">
                                        <div class="input-gorup d-flex mb-2 w-100">
                                            <input class="form-control w-100" type="search" name="orsearch" id="orsearch"
                                                placeholder="search by order id">
                                            <span class="input-group-text">
                                                <i class="fa fa-search"></i>
                                            </span>
                                        </div>

                                    </div>
                                </th>
                            </tr>
                            <tr class="p-0 ">
                                <th colspan="8" class="text-right p-0 pr-5">
                                    <p class="csorder">x</p>
                                </th>
                            </tr>
                            <tr>
                                <th scope="col">SI</th>
                                <th scope="col">ORDER NO.</th>
                                <th scope="col">STATUS</th>
                                <th scope="col">Customer</th>
                                <th scope="col">LOCATION</th>
                                <th scope="col">PRODUCT</th>
                                <th scope="col">START DATE</th>
                                <th scope="col">EST DELIVERY DUE</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="model">
<!-- Modal -->
        <div class="modal fade" id="changes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Change order Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body chsta">
                        <div class="d-flex justify-content-around">
                            <button type="button" id="confirm" class="btn btn-success" data-attr=''>Confirm</button>
                            <button type="button" id="cnacel" class="btn btn-danger" data-attr=''>Cancel</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
<script>
    // get all order
function geto() {
  $.ajax({
    url: 'res.php',
    type: "post",
    data: {
      geto: "success"
    },
    success: function (d) {
      $('.ortable tbody').html(d)
    }
  })
}
geto()
///
$(document).on("click",".pointer",function(e){
    var data=$(this).data('attr');
    $('#confirm').data('attr',data);
    $.ajax({
        url:'res.php',
        type:"post",
        data:{sta :data},
        success:function(d){
            $('.chsta').html(d)

        }
    })
})
/// change status
$(document).on("click","#confirm",function(){
    var data=$(this).data('attr');
    $.ajax({
        url:'res.php',
        type:"post",
        data:{conf :data},
        success:function(d){
            $.each($('.pointer'),function(){
                    if($(this).data('attr') == data){
                $(this).html(d)
                  }
                }) 
            $('#changes').modal('hide')
        }
    })
})
$(document).on("click","#cnacel",function(){
    var data=$(this).data('attr');
    $.ajax({
        url:'res.php',
        type:"post",
        data:{canc :data},
        success:function(d){
                $.each($('.pointer'),function(){
                    if($(this).data('attr') == data){
                $(this).html(d)
                  }
                })               
            $('#changes').modal('hide')
        }
    })
})

$(document).on("keyup", '#orsearch', function () {
  $('.csorder').fadeIn();
  var val = $(this).val()
  $.ajax({
    url: 'res.php',
    type: 'post',
    data: {
      orserarch: val
    },
    success: function (d) {
      $('.ortable tbody').html(d)
    }
  })
})
/// cancel search

$(document).on("click", '.csorder', function () {
  $('.csorder').fadeOut();
  geto()

})
</script>
<?php include 'footer.php'?>