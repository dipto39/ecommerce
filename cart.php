<?php 
include "header.php";
?>



    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5 loadcart">
            <!-- <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0">
                    <thead class="thead-dark">
                        <tr>
                            <th>Products</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                      
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-30" action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-0 p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form>
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>$150</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">$10</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>$160</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </div>
                </div>
            </div> -->
        </div>
    </div>
   <script>
    var data="";
    function load(quant){
        $.ajax({
            url:"response.php",
            type:"post",
            data:{cartload : data,quant:quant},
            success:function(d){
                $('.loadcart').html(d);
            }
        })
    }
    load();
    $(document).on("click",".rmcart",function(){
        var val=$(this).data('attr');
        $.ajax({
            url:'response.php',
            type:'post',
            data:{rmcart:val},
            success:function(d){
                if(d == 'success'){
                    load();
                }else{
                    alert('something went to wrong...')
                }
            }
        })
    })
    $(document).on("click",".quantity button",function(){
        var val=[];
        var inputs=$('.quant-val');
        for(var i = 0; i < inputs.length; i++){
                val.push($(inputs[i]).val())
            }
    var str=val.toString();
    load(str);
    })

    $(document).on("click",'.place_order',function(){
        var val=$(this).data('attr');
        var inputs=$('.quant-val');
        var err="";
        for(var i = 0; i < inputs.length; i++){
                
                if($(inputs[i]).val() > 5){
                    err="max quantity is 5";
                }
            }
            if(err == ""){
               window.location.href="checkout.php?order="+val
            }else{
                alert(err);
            }
            
    })
   </script>

    <!-- Cart End -->
<?php include "footer.php"?>