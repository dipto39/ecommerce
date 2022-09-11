<?php include 'header.php'?>
<?php 
$mcata;
$subcata;
$supcata;
$ajaxval="";
$res;
if(isset($_GET['cid'])){
    $mcata= $_GET['cid'];
    $ajaxval="cid-".$mcata;
    $que=$conn->prepare("select * from product inner join pdetails on product.pid=pdetails.pid where m = :cid");
    $que->bindParam(":cid",$mcata );
    $que->execute();
    $res=$que->fetchAll(PDO::FETCH_ASSOC);
}
if(isset($_GET['sid'])){
    $subcata= $_GET['sid'];
    $ajaxval="sid-".$subcata;
    $que=$conn->prepare("select * from product  inner join pdetails on product.pid=pdetails.pid where s = :sid");
    $que->bindParam(":sid",$subcata );
    $que->execute();
    $res=$que->fetchAll(PDO::FETCH_ASSOC);
}
   

if(isset($_GET['suid'])){
    $supcata= $_GET['suid'];
    $ajaxval="suid-,".$supcata;
    $que=$conn->prepare("select * from product  inner join pdetails on product.pid=pdetails.pid where su = :suid");
    $que->bindParam(":suid",$supcata );
    $que->execute();
    $res=$que->fetchAll(PDO::FETCH_ASSOC);
}

if(!isset($_GET['cid']) and !isset($_GET['sid']) and !isset($_GET['suid'])){
    echo "<script>window.location.replace('index.php')</script>";
}
?>
<div class="container-fluid">

                <?php
                if(count($res) <= 0){
                    echo '   <div class="npfound container-fluid ">
                    <img class="img-fluid" src="admin/img/nproduct.png" alt="" class="img-flude">
                    </div>';
                }else{
                   echo'        <div class="row px-xl-5">
                   
                   <div class="col-12 pb-1">
                   <div class="d-flex align-items-center justify-content-between mb-4">
                       <div>
                           <button class="btn btn-sm btn-light"><i class="fa fa-th-large"></i></button>
                           <button class="btn btn-sm btn-light ml-2"><i class="fa fa-bars"></i></button>
                       </div>
                       <div class="ml-2">
                           <div class="btn-group">
                               <select class="btn btn-sm btn-light dropdown-toggle fbp" data-toggle="dropdown">
                               <option value="" selected> <a class="dropdown-item" href="#">Default</a></option>
                               <option value="lth"> <a class="dropdown-item" href="#">Low to High</a></option>
                               <option value="htl"> <a class="dropdown-item" href="#">Hige to low</a></option>
                               </select>
                           </div>
                       </div>
                   </div>
               </div>
       
                   <!-- Shop Product Start -->
                   <div class="col-12 getcdata"> <div class="row pb-3">
                   ';
                    foreach ($res as $key => $value) {
                        echo ' <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                        <div class="product-item bg-light mb-4">
                            <div class="product-img position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="admin/img/products/'.$value['pp'].'" alt="'.$value['pname'].'">
                                <div class="product-action">
                                <a class="btn btn-outline-dark btn-square add_carti" data-attr="'.$value['pid'].'" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square add_favi" data-attr="'.$value['pid'].'" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="single.php?pid='.$value['pid'].'"><i class="fa fa-search"></i></a>
                                </div>
                            </div>
                            <div class="text-center py-4">
                                <a class="h6 text-decoration-none text-truncate" href="">'.$value['pname'].'</a>
                                <div class="d-flex align-items-center justify-content-center mt-2">
                                    <h5>৳';
                                    $price=$value['price'];
                                    $off=$value['off'];
                                    $disprice=$price/100*$off;
                                    echo $disprice=$price-$disprice;
                                    
                                    echo '</h5><h6 class="text-muted ml-2"><del>৳'.$value['price'].'</del></h6>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-1">
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small class="fa fa-star text-primary mr-1"></small>
                                    <small>'.$value['rv'].'</small>
                                </div>
                            </div>
                        </div>
                    </div>';
                    }
                   
                    echo '<div class="col-12">';
                    if(count($res) > 9){
                        echo ' <nav>
                        <ul class="pagination justify-content-center">
                          <li class="page-item disabled"><a class="page-link" href="#">Previous</span></a></li>
                          <li class="page-item active"><a class="page-link" href="#">1</a></li>
                          <li class="page-item"><a class="page-link" href="#">2</a></li>
                          <li class="page-item"><a class="page-link" href="#">3</a></li>
                          <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                      </nav>';
                       
                    }else{

                    }
                       
                    echo '</div>
                </div></div>
                <!-- Shop Product End -->
            </div>';
                }
                ?>

            
    </div>
    <script>
        $(document).on("change",'.fbp',function(){
           var val=$(this).val();
           var cid="<?php echo $ajaxval; ?>";
           $.ajax({
            url:'response.php',
            type:'post',
            data:{sbyp:val,cid:cid},
            success:function(e){
                $('.getcdata').html(e)
            }
           })
        })
    </script>
<?php include 'footer.php'?>