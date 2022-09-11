<?php
include 'con.php';
session_start();
if(isset($_POST['sbyp'])){
    $val= $_POST['sbyp'];
    $cid= $_POST['cid'];
    $arr=explode('-',$cid);
    $cname=$arr[0];
    $cid=$arr[1];
    $res;
    $data='';
    if($val == ""){
        if($cname == "cid"){
            $que=$conn->prepare('select * from product inner join pdetails on product.pid=pdetails.pid where m = :cid ');
            $que->bindParam(":cid",$cid);
            $que->execute();
            $res=$que->fetchAll(PDO::FETCH_ASSOC);
        }
        if($cname == "sid"){
            $que=$conn->prepare('select * from product inner join pdetails on product.pid=pdetails.pid where s = :cid ');
            $que->bindParam(":cid",$cid);
            $que->execute();
            $res=$que->fetchAll(PDO::FETCH_ASSOC);
        }
        if($cname == "suid"){
            $que=$conn->prepare('select * from product inner join pdetails on product.pid=pdetails.pid where su = :cid ');
            $que->bindParam(":cid",$cid);
            $que->execute();
            $res=$que->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    if($val == "lth"){
        if($cname == "cid"){
            $que=$conn->prepare('select * from product inner join pdetails on product.pid=pdetails.pid where m = :cid order by price');
            $que->bindParam(":cid",$cid);
            $que->execute();
            $res=$que->fetchAll(PDO::FETCH_ASSOC);
        }
        if($cname == "sid"){
            $que=$conn->prepare('select * from product inner join pdetails on product.pid=pdetails.pid where s = :cid order by price');
            $que->bindParam(":cid",$cid);
            $que->execute();
            $res=$que->fetchAll(PDO::FETCH_ASSOC);
        }
        if($cname == "suid"){
            $que=$conn->prepare('select * from product inner join pdetails on product.pid=pdetails.pid where su = :cid order by price');
            $que->bindParam(":cid",$cid);
            $que->execute();
            $res=$que->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    if($val == "htl"){
        if($cname == "cid"){
            $que=$conn->prepare('select * from product inner join pdetails on product.pid=pdetails.pid where m = :cid order by price desc');
            $que->bindParam(":cid",$cid);
            $que->execute();
            $res=$que->fetchAll(PDO::FETCH_ASSOC);
        }
        if($cname == "sid"){
            $que=$conn->prepare('select * from product inner join pdetails on product.pid=pdetails.pid where s = :cid order by price desc');
            $que->bindParam(":cid",$cid);
            $que->execute();
            $res=$que->fetchAll(PDO::FETCH_ASSOC);
        }
        if($cname == "suid"){
            $que=$conn->prepare('select * from product inner join pdetails on product.pid=pdetails.pid where su = :cid order by price desc');
            $que->bindParam(":cid",$cid);
            $que->execute();
            $res=$que->fetchAll(PDO::FETCH_ASSOC);
        }
    }


    $data.='<div class="row pb-3">
    ';
     foreach ($res as $key => $value) {
         $data.= ' <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
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
                     $data.= $disprice=$price-$disprice;
                     
                     $data.= '</h5><h6 class="text-muted ml-2"><del>৳'.$value['price'].'</del></h6>
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
    
     $data.= '<div class="col-12">';
     if(count($res) > 9){
         $data.= ' <nav>
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
        
     $data.= '</div>
 </div>';
 echo $data;
}

if(isset($_POST['ftday'])){
    $res;
    $data='';
    $val=$_POST['ftday'];
    if($val == ""){
        $que=$conn->prepare('select * from eve inner join product on eve.pid=product.pid inner join pdetails on eve.pid=pdetails.pid ');
        $que->bindParam(":cid",$val);
        $que->execute();
        $res=$que->fetchAll(PDO::FETCH_ASSOC);
    }
    if($val == "lth"){
        $que=$conn->prepare('select * from eve inner join product on eve.pid=product.pid inner join pdetails on eve.pid=pdetails.pid order by price');
        $que->bindParam(":cid",$val);
        $que->execute();
        $res=$que->fetchAll(PDO::FETCH_ASSOC);
    }
    if($val == "htl"){
        $que=$conn->prepare('select * from eve inner join product on eve.pid=product.pid inner join pdetails on eve.pid=pdetails.pid order by price desc');
        $que->bindParam(":cid",$val);
        $que->execute();
        $res=$que->fetchAll(PDO::FETCH_ASSOC);
    }
    $data.='<div class="row pb-3">
    ';
     foreach ($res as $key => $value) {
         $data.= ' <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
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
                     $off=$value['ooff'];
                     $disprice=$price/100*$off;
                     $data.= $disprice=$price-$disprice;
                     
                     $data.= '</h5><h6 class="text-muted ml-2"><del>৳'.$value['price'].'</del></h6>
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
    
     $data.= '<div class="col-12">';
     if(count($res) > 9){
         $data.= ' <nav>
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
        
     $data.= '</div>
 </div>';
 echo $data;
}
if(isset($_POST['foffer'])){
    $res;
    $data='';
    $val=$_POST['foffer'];
    if($val == ""){
        $que=$conn->prepare('select * from off inner join product on off.pid=product.pid inner join pdetails on off.pid=pdetails.pid ');
        $que->bindParam(":cid",$val);
        $que->execute();
        $res=$que->fetchAll(PDO::FETCH_ASSOC);
    }
    if($val == "lth"){
        $que=$conn->prepare('select * from off inner join product on off.pid=product.pid inner join pdetails on off.pid=pdetails.pid order by price');
        $que->bindParam(":cid",$val);
        $que->execute();
        $res=$que->fetchAll(PDO::FETCH_ASSOC);
    }
    if($val == "htl"){
        $que=$conn->prepare('select * from off inner join product on off.pid=product.pid inner join pdetails on off.pid=pdetails.pid order by price desc');
        $que->bindParam(":cid",$val);
        $que->execute();
        $res=$que->fetchAll(PDO::FETCH_ASSOC);
    }
    $data.='<div class="row pb-3">
    ';
     foreach ($res as $key => $value) {
         $data.= ' <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
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
                     $data.= $disprice=$price-$disprice;
                     
                     $data.= '</h5><h6 class="text-muted ml-2"><del>৳'.$value['price'].'</del></h6>
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
    
     $data.= '<div class="col-12">';
     if(count($res) > 9){
         $data.= ' <nav>
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
        
     $data.= '</div>
 </div>';
 echo $data;
}
if(isset($_POST['rfilter'])){
    $res;
    $data='';
    $val=$_POST['rfilter'];

    if($val == "lth"){
        $que=$conn->prepare('select * from pdetails inner join product on pdetails.pid=product.pid order by rv');
        $que->bindParam(":cid",$val);
        $que->execute();
        $res=$que->fetchAll(PDO::FETCH_ASSOC);
    }
    if($val == "htl"){
        $que=$conn->prepare('select * from pdetails inner join product on pdetails.pid=product.pid order by rv desc');
        $que->bindParam(":cid",$val);
        $que->execute();
        $res=$que->fetchAll(PDO::FETCH_ASSOC);
    }
    $data.='<div class="row pb-3">
    ';
     foreach ($res as $key => $value) {
         $data.= ' <div class="col-lg-3 col-md-4 col-sm-6 pb-1">
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
                     $data.= $disprice=$price-$disprice;
                     
                     $data.= '</h5><h6 class="text-muted ml-2"><del>৳'.$value['price'].'</del></h6>
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
    
     $data.= '<div class="col-12">';
     if(count($res) > 9){
         $data.= ' <nav>
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
        
     $data.= '</div>
 </div>';
 echo $data;
}

/// show chart modal

if(isset($_POST['getamod'])){
    if(isset($_SESSION['uid'])){
        echo "success";
    }else{
    echo "not";
    }
}
if(isset($_POST['getmod1'])){
    if(isset($_SESSION['uid'])){
        echo "success";
    }else{
    echo "not";
    }
}
/// add to chart 

if(isset($_POST['addcart'])){
    $val=$_POST['addcart'];
    $uid=$_SESSION['uid'];
    $que=$conn->prepare("select cart from users where id = :uid");
    $que->bindParam(":uid",$uid);
    $que->execute();
    $res=$que->fetchAll(PDO::FETCH_ASSOC);
    $res=$res[0]['cart'];
    $arr=explode(",",$res);
    if(in_array($val,$arr)){
        echo "already";
    }else{
        $value=$res.$val.",";
        $query=$conn->prepare("update users set cart = :cart where id = :uid");
        $query->bindParam(":cart",$value);
        $query->bindParam(":uid",$uid);
        if($query->execute()){
            echo "success";
        }
    }
    
}
if(isset($_POST['addfav'])){
    $val=$_POST['addfav'];
    $uid=$_SESSION['uid'];
    $que=$conn->prepare("select fav from users where id = :uid");
    $que->bindParam(":uid",$uid);
    $que->execute();
    $res=$que->fetchAll(PDO::FETCH_ASSOC);
    $res=$res[0]['fav'];
    $arr=explode(",",$res);
    if(in_array($val,$arr)){
        echo "already";
    }else{
        $value=$res.$val.",";
        $query=$conn->prepare("update users set fav = :cart where id = :uid");
        $query->bindParam(":cart",$value);
        $query->bindParam(":uid",$uid);
        if($query->execute()){
            echo "success";
        }
    }
    
}


/// delete favorite
if(isset($_POST['favremove'])){
    $val=$_POST['favremove'];
    $uid=$_SESSION['uid'];
    $que=$conn->prepare("select fav from users where id =:uid");
    $que->bindParam(":uid",$uid);
    $que->execute();
    $res=$que->fetchAll(PDO::FETCH_ASSOC);
    $fa=explode(",",$res[0]['fav']);
    if (($key = array_search($val, $fa)) !== false) {
        unset($fa[$key]);
    }
    $fa=implode(",",$fa);
    $que1=$conn->prepare("update users set fav =:fav where id = :uid");
    $que1->bindParam(":uid",$uid);
    $que1->bindParam(":fav",$fa);
    if($que1->execute()){
        echo "success";
    }
}
/// Get all cart option
if(isset($_POST['cartload'])){
    $data="";
    $arr="";
    if(isset($_POST['quant'])){
        $arr=$_POST['quant'];

    }
    if($arr == ""){

    }else{
        $arr=explode(",",$arr);
    }
    $uid=$_SESSION['uid'];
    $quer=$conn->prepare("select cart from users where id = :uid");
    $quer->bindParam(":uid",$uid);
    $quer->execute();
    $getc=$quer->fetchAll(PDO::FETCH_ASSOC);
    $getc=explode(",",$getc[0]['cart']);
    array_pop($getc);
    $toorder="";
        if(count($getc) > 0){
            $data.=' <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead><tbody class="align-middle">';
                $toprice=0;
                $i=0;
            foreach ($getc as $key => $value) {
                        $pid=$value;
                        $toorder.=$pid.":";
                        if($arr == ""){
                        }else{
                            $toorder=$toorder.$arr[$i].",";

                        }
                        $qu=$conn->prepare("select * from pdetails inner join product on pdetails.pid=product.pid where product.pid =:pid");
                        $qu->bindParam(":pid",$pid);
                        $qu->execute();
                        $res=$qu->fetchAll(PDO::FETCH_ASSOC);
                $data.=' <tr>
                <td class="align-middle"><img src="admin/img/products/'.$res[0]['pp'].'" alt="" style="width: 50px;"> <a href="single.php?pid='.$res[0]['pid'].'"> '.$res[0]['pname'].'</a> </td>
                <td class="align-middle">';
                                    $price=$res[0]['price'];
                                    $off=$res[0]['off'];
                                    $disprice=$price/100*$off;
                                    $sprice=$price - $disprice;
                                    if($arr == ""){
                                        
                                    }else{
                                        $sprice=$sprice * (int)$arr[$i];
                                    } 
                                    $toprice=$toprice+$sprice;
                                    $data.= $disprice='৳'.$price-$disprice;
                                    $data.='</td>
                <td class="align-middle">
                    <div class="input-group quantity mx-auto" style="width: 100px;">
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-primary btn-minus" >
                            <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center quant-val" value="';
                        if($arr == ""){
                                $data.= 1;      
                        }else{
                            $data.= $arr[$i];
                        } 
                        $data.='" disabled>
                        <div class="input-group-btn">
                            <button class="btn btn-sm btn-primary btn-plus">
                                <i class="fa fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </td>
                <td class="align-middle">৳'.$sprice.'</td>
                <td class="align-middle"><button class="btn btn-sm btn-danger rmcart" data-attr="'.$res[0]['pid'].'"><i class="fa fa-times"></i></button></td>
            </tr>';
            $i++;

            }
                $data.='</tbody>
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
                            <h6>৳'.$toprice.'</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Shipping</h6>
                            <h6 class="font-weight-medium">৳50</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5>৳'.($toprice + 50).'</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3 place_order" data-attr="'.$toorder.'">Proceed To Checkout</button>
                    </div>
                </div>
            </div>';
        }else{
            $data.= '<div class="npfound container-fluid ">
            <img class="img-fluid" src="admin/img/nproduct.png" alt="" class="img-flude">
            </div>';
        }

    echo $data;
}
if(isset($_POST['rmcart'])){
    $val=$_POST['rmcart'];
    $uid=$_SESSION['uid'];
    $que=$conn->prepare("select cart from users where id =:uid");
    $que->bindParam(":uid",$uid);
    $que->execute();
    $res=$que->fetchAll(PDO::FETCH_ASSOC);
    $fa=explode(",",$res[0]['cart']);
    if (($key = array_search($val, $fa)) !== false) {
        unset($fa[$key]);
    }
    $fa=implode(",",$fa);
    $que1=$conn->prepare("update users set cart =:cart where id = :uid");
    $que1->bindParam(":uid",$uid);
    $que1->bindParam(":cart",$fa);
    if($que1->execute()){
        echo "success";
    }else{
        echo "unsuccess";
    }
}
/// place order
if(isset($_POST['placeo'])){
    $val =$_POST['placeo'];
    $addr=$_POST['addr'];
    $uid=$_SESSION['uid'];
    $va=[];

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
        $ordata="";
        $tprice=0;
        foreach ($va as $key => $value) {
            $pid=$value[0];
            $querey=$conn->prepare("select pcode,price,off from product where pid = :pid");
            $querey->bindParam(":pid",$pid);
            $querey->execute();
            $res=$querey->fetchAll(PDO::FETCH_ASSOC);
            $price=$res[0]['price'];
                            $off=$res[0]['off'];
                            $disprice=$price/100*$off;
                              $disprice=$price-$disprice * $value[1];
                            $tprice=$tprice+$disprice * $value[1];
            $pcode=$res[0]['pcode'];
            $ordata=$ordata.$pcode."(".$value[1]."),";
          

        }
        $querey1=$conn->prepare("insert into orders(pcode,addr,uid,tprice) values(:pcode,:addr,:uid,:tprice)");
        $querey1->bindParam(":pcode",$ordata);
        $querey1->bindParam(":addr",$addr);
        $querey1->bindParam(":uid",$uid);
        $querey1->bindParam(":tprice",$tprice);
        
        if($querey1->execute()){
            echo "success";
        }
    }
?>