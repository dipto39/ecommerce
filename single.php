<?php 
  if(isset($_GET['pid'])){

  }else{
    echo '<script>window.location.assign("index.php")</script>';
    
  }  
    
?>
<?php include 'header.php';
$pid=$_GET['pid'];
$que=$conn->prepare("select * from product inner join pdetails on product.pid = pdetails.pid where product.pid = :pid");
    $que->bindParam(":pid",$pid);
    $que->execute();
    $prod= $que->fetchAll(PDO::FETCH_ASSOC);
    $cata=$prod[0]['catagory'];
    $cata=explode(",",$cata);
    $size=$prod[0]['size'];
    $size=explode(",",$size);
    $color=$prod[0]['color'];
    $color=explode(",",$color);
    $ainfo=$prod[0]['addinfo'];
    $ainfo=explode("*",$ainfo);

?>

    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="index.php">Home</a>
                    <?php
                    $i=0;
                        foreach ($cata as $key => $value) {
                            if($i == 0){
                                $va=$cata[$i];
                                $query=$conn->prepare("select cname from category where cid =:cid");
                                $query->bindParam(":cid",$va);
                                $query->execute();
                                $res=$query->fetchAll(PDO::FETCH_ASSOC);
                            echo '<a class="breadcrumb-item text-dark" href="category.php?cid='.$va.'">'.$res[0]['cname'].'</a>';

                            }
                            if($i == 1){
                                $va=$cata[$i];
                                $query=$conn->prepare("select subname from subcata where sid =:cid");
                                $query->bindParam(":cid",$va);
                                $query->execute();
                                $res=$query->fetchAll(PDO::FETCH_ASSOC);
                            echo '<a class="breadcrumb-item text-dark" href="category.php?sid='.$va.'">'.$res[0]['subname'].'</a>';
                            }
                            if($i == 2){
                                $va=$cata[$i];
                                $query=$conn->prepare("select supname from sup where suid =:cid");
                                $query->bindParam(":cid",$va);
                                $query->execute();
                                $res=$query->fetchAll(PDO::FETCH_ASSOC);
                                echo '<a class="breadcrumb-item text-dark" href="category.php?suid='.$va.'">'.$res[0]['supname'].'</a>';

                            }
                            $i++;
                        }
                                           
                    ?>
                    <span class="breadcrumb-item active"><?php echo $prod[0]['pname'] ?></span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->


    <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                        <div class="carousel-item active">
                            <img class="w-100 h-100" src="admin/img/products/<?php echo $prod[0]['pp'] ?>" alt="Image">
                        </div>
                        hare
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3><?php echo $prod[0]['pname'] ?></h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">(<?php echo $prod[0]['rv'] ?>)</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">৳<?php echo $prod[0]['price'] ?></h3>
                    <p class="mb-4"><?php echo $prod[0]['dis'] ?></p>
                    <div class="d-flex mb-3">
                        <strong class="text-dark mr-3">Sizes:</strong>
                        <form>
                            <?php 
                             $s=1;
                             foreach ($size as $key => $value) {
                                 echo '<div class="custom-control custom-radio custom-control-inline">
                                 <input type="radio" class="custom-control-input" id="size-'.$s.'" name="size">
                                 <label class="custom-control-label" for="size-'.$s.'">'.$value.'</label>
                             </div>';
                             $s++;
                            } ?>
                        </form>
                    </div>
                    <div class="d-flex mb-4">
                        <strong class="text-dark mr-3">Colors:</strong>
                        <form>
                        <?php 
                             $c=1;
                             foreach ($color as $key => $value) {
                                 echo '<div class="custom-control custom-radio custom-control-inline">
                                 <input type="radio" class="custom-control-input" id="color-'.$c.'" name="size">
                                 <label class="custom-control-label" for="color-'.$c.'">'.$value.'</label>
                             </div>';
                             $c++;
                            } ?>
                        </form>
                    </div>
                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center quant-val" value="1">
                            <div class="input-group-btn">
                                <button class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button class="btn btn-primary px-3 add_carti" data-attr="<?php echo $prod[0]['pid'] ?>"><i class="fa fa-shopping-cart mr-1"></i> Add To
                            Cart</button>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                        <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="tab-pane-1">
                            <h4 class="mb-3">Product Description</h4>
                            <p><?php echo $prod[0]['dis'];?></p>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-2">
                            <h4 class="mb-3">Additional Information</h4>
                            <div class="row">
                                <?php 
                                
                                    echo '<div class="col-12">
                                    <ul class="list-group list-group-flush">';
                                    foreach ($ainfo as $key => $value) {
                                        echo '<li class="list-group-item px-0">
                                        '.$value.'
                                    </li>';
                                    }
                                    echo '</ul> 
                                    </div>';
                                
                                ?>
                                
                               
                            </div>
                        </div>
                        <div class="tab-pane fade" id="tab-pane-3">
                            <div class="row">
                                <!-- <div class="col-md-6">
                                    <h4 class="mb-4">1 review for "Product Name"</h4>
                                    <div class="media mb-4">
                                        <img src="admin/img/users/" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                                        <div class="media-body">
                                            <h6>John Doe<small> - <i>01 Jan 2045</i></small></h6>
                                            <div class="text-primary mb-2">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <i class="far fa-star"></i>
                                            </div>
                                            <p>Diam amet duo labore stet elitr ea clita ipsum, tempor labore accusam ipsum et no at. Kasd diam tempor rebum magna dolores sed sed eirmod ipsum.</p>
                                        </div>
                                    </div>
                                </div> -->
                                <div class="col-md-6">
                                    <h3>No review found !</h3>
                                </div>
                                <div class="col-md-6">
                                    <h4 class="mb-4">Leave a review</h4>
                                    <small>Your email address will not be published. Required fields are marked *</small>
                                    <div class="d-flex my-3">
                                        <p class="mb-0 mr-2">Your Rating * :</p>
                                        <div class="text-primary">
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                            <i class="far fa-star"></i>
                                        </div>
                                    </div>
                                    <form>
                                        <div class="form-group">
                                            <label for="message">Your Review *</label>
                                            <textarea id="message" cols="30" rows="5" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">Your Name *</label>
                                            <input type="text" class="form-control" id="name">
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Your Email *</label>
                                            <input type="email" class="form-control" id="email">
                                        </div>
                                        <div class="form-group mb-0">
                                            <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Shop Detail End -->


    <!-- Products Start -->
    <div class="container-fluid pt-5 pb-3">
        <h2 class="section-title position-relative text-uppercase mx-xl-5 mb-4"><span class="bg-secondary pr-3">You may like</span></h2>
        <div class="row px-xl-5">
        <?php
            // print_r($res);
            $query=$conn->prepare("select product.pid,pp,pname,price,off,rv,adate from product inner join pdetails on product.pid = pdetails.pid order by rv desc limit 8");
            $query->execute();
            $get_rev=$query->fetchAll(PDO::FETCH_ASSOC);
            if(count($get_rev) > 0){
                foreach ($get_rev as $key => $value) {
                    echo '<div class="col-lg-3 col-md-4 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="admin/img/products/'.$value['pp'].'" alt="">
                            <div class="product-action">
                                <a class="btn btn-outline-dark btn-square add_carti" data-attr="'.$value['pid'].'" href=""><i class="fa fa-shopping-cart"></i></a>
                                <a class="btn btn-outline-dark btn-square add_favi" data-attr="'.$value['pid'].'" href=""><i class="far fa-heart"></i></a>
                                <a class="btn btn-outline-dark btn-square" href="single.php?pid='.$value['pid'].'"><i class="fa fa-search"></i></a>
                            </div>
                        </div>
                        <div class="text-center py-4">
                            <a class="h6 text-decoration-none text-truncate" href="single.php?pid='.$value['pid'].'">'.$value['pname'].'</a>
                            <div class="d-flex align-items-center justify-content-center mt-2">
                                <h5>$';
                                $off = $value['off'];
                                $price = $value['price'];
                                $disprice=($price / 100) * $off;
                                $disprice=$price-$disprice;
                                echo $disprice;
                                echo '</h5>
                                <h6 class="text-muted ml-2"><del>$'.$value['price'].'</del></h6>
                            </div>
                            <div class="d-flex align-items-center justify-content-center mb-1">
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small class="fa fa-star text-primary mr-1"></small>
                                <small>('.$value['rv'].')</small>
                            </div>
                        </div>
                    </div>
                </div>';
                }
            }else{
                echo "No record found..!";
            }
            ?>
        </div>
        <div class="text-right">
        <a href="recent.php" class="btn btn-primary text-center">Show more...</a>
        </div>
    </div>
    <!-- Products End -->


<?php include 'footer.php'?>