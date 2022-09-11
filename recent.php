<?php include 'header.php';?>
<?php $quer=$conn->prepare("select * from pdetails inner join product on pdetails.pid=product.pid order by adate");
$quer->execute();
$res=$quer->fetchAll(PDO::FETCH_ASSOC);
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
                       <h2>All recent products</h2>
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
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="fa fa-shopping-cart"></i></a>
                                    <a class="btn btn-outline-dark btn-square" href=""><i class="far fa-heart"></i></a>
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

            
<script>
        $(document).on("change",'.fbp',function(){
           var val=$(this).val();
           $.ajax({
            url:'response.php',
            type:'post',
            data:{rfilter:val},
            success:function(e){
                $('.getcdata').html(e)
            }
           })
        })
    </script>

<?php include 'footer.php';?>