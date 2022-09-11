<?php include "header.php";?>
    <!-- Checkout Start -->
    <?php 
    if(!isset($_SESSION['uid'])){
        echo "<script>window.location.replace('index.php')</script>";
    } 
    if(isset($_GET['order'])){
        $va=[];

        $val=$_GET['order'];
        if(count(explode(",",$val)) == 1){
            $ex=explode(",",$val);
            $id=explode(":",$ex[0]);
            array_pop($id);
            $str='';
            foreach ($id as $key => $value) {
            
                $str.=$value.":1,";
           
            }
            $val =$str;

            //   array_push($va,$id);
        }
        $produ=explode(",",$val);
        
      
            array_pop($produ);
            foreach ($produ as $key => $value) {
                $id=explode(":",$value);
              array_push($va,$id);
            }
    }else{
        echo "<script>window.location.replace('index.php')</script>";
    }
    $uid=$_SESSION['uid'];
    $query=$conn->prepare("select * from users where id = :uid");
    $query->bindParam(":uid",$uid);
    $query->execute();
    $udetails=$query->fetchAll(PDO::FETCH_ASSOC);
    $fn=explode(' ',$udetails[0]['name']);
    
    ?>

    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Billing Address</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>First Name</label>
                            <input class="form-control" type="text" placeholder="John" value="<?php echo $fn[0] ?>" disabled>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Last Name</label>
                            <input class="form-control" type="text" placeholder="Doe" value="<?php echo $fn[1] ?>" disabled>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>E-mail</label>
                            <input class="form-control" type="text" placeholder="example@email.com" value="<?php echo $udetails[0]['email'] ?>" disabled>
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Mobile No</label>
                            <input class="form-control" type="text" placeholder="+123 456 789" value="<?php echo $udetails[0]['phone'] ?>">
                        </div>
                        <div class="col-12 form-group">
                            <label>Address Line 1</label>
                            <input class="form-control" type="text" placeholder="Area - road no, thana,city" id="addr">
                        </div>

                        <!-- <div class="col-md-12 form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="newaccount">
                                <label class="custom-control-label" for="newaccount">Create an account</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="shipto">
                                <label class="custom-control-label" for="shipto"  data-toggle="collapse" data-target="#shipping-address">Ship to different address</label>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="collapse mb-5" id="shipping-address">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Shipping Address</span></h5>
                    <div class="bg-light p-30">
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>First Name</label>
                                <input class="form-control" type="text" placeholder="John">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Last Name</label>
                                <input class="form-control" type="text" placeholder="Doe">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>E-mail</label>
                                <input class="form-control" type="text" placeholder="example@email.com">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Mobile No</label>
                                <input class="form-control" type="text" placeholder="+123 456 789">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address Line 1</label>
                                <input class="form-control" type="text" placeholder="123 Street">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Address Line 2</label>
                                <input class="form-control" type="text" placeholder="123 Street">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Country</label>
                                <select class="custom-select">
                                    <option selected>United States</option>
                                    <option>Afghanistan</option>
                                    <option>Albania</option>
                                    <option>Algeria</option>
                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>City</label>
                                <input class="form-control" type="text" placeholder="New York">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>State</label>
                                <input class="form-control" type="text" placeholder="New York">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>ZIP Code</label>
                                <input class="form-control" type="text" placeholder="123">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Total</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom">
                        <h6 class="mb-3">Products</h6>
                        <?php 
                        $i=0;
                        $tprice=0;
                        foreach ($va as $key => $value) {
                            $pid=$value[0];
                            $querey=$conn->prepare("select * from product where pid = :pid");
                            $querey->bindParam(":pid",$pid);
                            $querey->execute();
                            $pdetail=$querey->fetchAll(PDO::FETCH_ASSOC);
                           
                           echo '<div class="d-flex justify-content-between">
                            <p>'.$pdetail[0]['pname']. '  ('.$value[1].')'.'</p>
                            <p>৳';
                             $price=$pdetail[0]['price'];
                            $off=$pdetail[0]['off'];
                            $disprice=$price/100*$off;
                            echo  $disprice=$price-$disprice * $value[1];
                            $tprice=$tprice+$disprice * $value[1];

                            echo '</p>
                        </div>';
                        $i++;
                        }
                        ?>
                    </div>
                    <div class="border-bottom pt-3 pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6>৳<?php echo $tprice ?></h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">৳50</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>৳<?php echo $tprice + 50 ?></h5>
                        </div>
                    </div>
                </div>
                <div class="mb-5">
                    <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Payment</span></h5>
                    <div class="bg-light p-30">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="paypal" checked>
                                <label class="custom-control-label" for="paypal">Cash on Delivery</label>
                            </div>
                        </div>

                        <button class="btn btn-block btn-primary font-weight-bold py-3 placeo">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Checkout End -->
    <script>
        var sdata= "<?php echo $_GET['order'];?>";
        $(document).on("click",".placeo",function(e){
            var val=$('#addr').val();
            if(val == ""){
                alert("Please Set a Delivary address....")
            }else{
                $.ajax({
                    url:"response.php",
                    type:'post',
                    data:{placeo:sdata,addr:val},
                    success:function(e){
                        if(e == 'success'){
                            alert("your order place successfully...");
                            window.location.href = "index.php";
                        }else{
                            alert(e)
                        }
                    
                    }
                })
            }
        })
    </script>

<?php include "footer.php";?>