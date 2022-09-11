<?php include 'header.php'?>
<?php

if(isset($_SESSION['uid'])){
    $uid=$_SESSION['uid'];
}else{
    echo "<script>window.location.replace('index.php')</script>";
}
$quer=$conn->prepare("select fav from users where id = :uid");
$quer->bindParam(":uid",$uid);
$quer->execute();
$res1=$quer->fetchAll(PDO::FETCH_ASSOC);
$fa=explode(",",$res1[0]['fav']);
array_pop($fa);
?>
<div class="container-fluid">

                <?php
                if(count($fa) == 0){
                    echo '   <div class="npfound container-fluid ">
                    <img class="img-fluid" src="admin/img/nproduct.png" alt="" class="img-flude">
                    </div>';
                }else{
                   echo'        <div class="row px-xl-5">
                   
                   <div class="col-12 pb-1">
                   <div class="d-flex align-items-center justify-content-between mb-4">
                       <p class="h3">Your Favorit list</p>
                   </div>
               </div>
       
                   <!-- Shop Product Start -->
                   <div class="col-12 getcdata"> <div class="row pb-3"> <div class="col-12 table-responsive mb-5">
                   <table class="table table-light table-borderless table-hover text-center mb-0">
                       <thead class="thead-dark">
                           <tr>
                              <th>SI</th>
                               <th>Products</th>
                               <th>Price</th>
                               <th>Remove</th>
                           </tr>
                       </thead>
                       <tbody class="align-middle">
                   ';
                   $i=1;
                    foreach ($fa as $key => $value) {
                        $pid=$value;
                        $qu=$conn->prepare("select * from pdetails inner join product on pdetails.pid=product.pid where product.pid =:pid");
                        $qu->bindParam(":pid",$pid);
                        $qu->execute();
                        $res=$qu->fetchAll(PDO::FETCH_ASSOC);
                        
                        echo '            
                                <tr>
                                <td class="align-middle">'.$i.'</td>
                                    <td class="align-middle"><img src="admin/img/products/'.$res[0]['pp'].'" alt="" style="width: 50px;"> <a href="single.php?pid='.$res[0]['pid'].'">'.$res[0]['pname'].'</a></td>
                                    <td class="align-middle">';
                                    $price=$res[0]['price'];
                                    $off=$res[0]['off'];
                                    $disprice=$price/100*$off;
                                    echo $disprice='৳'.$price-$disprice;
                                    echo'</td>
                                    <td class="align-middle"><button class="btn btn-sm btn-danger favremove" data-attr="'.$res[0]['pid'].'"><i class="fa fa-times"></i></button></td>
                                </tr>

                            ';
                            $i++;
                    }
                   
                    echo '</tbody>
                    </table>
                </div><div class="col-12">';
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
<?php include 'footer.php'?>