<?php
// $cookie_name = "user";
// $cookie_value = "John Doe";
// setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/","",true,true); // 86400 = 1 day 
// if(!isset($_COOKIE[$cookie_name])) {
//     echo "Cookie named '" . $cookie_name . "' is not set!";
// } else {
//     echo "Cookie '" . $cookie_name . "' is set!<br>";
//     echo "Value is: " . $_COOKIE[$cookie_name];
// }
include 'con.php';
session_start();
$finame=$_SERVER['PHP_SELF'];
    $finame= basename($finame);?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>YourShop - Online Shop Website Template</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/castom.css" rel="stylesheet">

</head>

<body>
    <!-- popup windo for add cart -->

    <div class="modal fade" id="adcartm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body ambody h3"> </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary maction">Add to Cart</button>
      </div>
    </div>
  </div>
</div>

        <!-- Topbar Start -->
        <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center h-100">
                    <a class="text-body mr-3" href="">About</a>
                    <a class="text-body mr-3" href="">Contact</a>
                    <a class="text-body mr-3" href="">Help</a>
                    <a class="text-body mr-3" href="">FAQs</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
                            <?php if(isset($_SESSION['uid'])){
                                echo "Hi ".$_SESSION['uname'];
                            }else{
                                echo 'My
                            Account';}
                            ?></button>
                        <div class="dropdown-menu dropdown-menu-right px-1">
                            <?php if(isset($_SESSION['uid'])){
                                echo '<a class="dropdown-item" type="button" href="profile.php">Profile Setting</a>
                                <button class="dropdown-item btn bg-danger logout" type="button">Logout</button>';
                            }else{
                                echo '<button class="dropdown-item" type="button" data-bs-toggle="modal"
                                data-bs-target="#lmodel">Sign in</button>
                            <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                data-bs-target="#rmodel">Sign up</button>';
                            }?>
                        </div>
                    </div>
                    <div class="btn-group mx-2">
                        <select type="button" id="currency" class="btn btn-sm btn-light form-select"
                            data-toggle="dropdown">
                            <option value="bdt">BDT</option>
                            <option value="inr">INR</option>
                            <option value="usd">USD</option>

                        </select>
                    </div>
                    <div class="btn-group">
                        <select type="button" id="languge" class="btn btn-sm btn-light form-select"
                            data-toggle="dropdown">
                            <option value="en">EN</option>
                            <option value="bn">BN</option>

                        </select>
                    </div>
                </div>
                <div class="d-inline-flex align-items-center d-block d-lg-none show_cart">
                    <a href="" class="btn px-0 ml-2 fav_icon">
                        <i class="fas fa-heart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle"
                            style="padding-bottom: 2px;"> <?php 
                                    if(isset($_SESSION['uid'])){
                                        $uid=$_SESSION['uid'];
                                        $quer=$conn->prepare('select fav from users where id = :uid');
                                        $quer->bindParam(':uid',$uid);
                                        $quer->execute();
                                        $get_fav=$quer->fetchAll(PDO::FETCH_ASSOC);
                                        if(!$get_fav[0]['fav'] == ""){
                                            $fa=explode(",",$get_fav[0]['fav']);
                                            echo count($fa) -1;

                                        }else{
                                            echo 0;
                                        }
                                    }else{
                                        echo 0;
                                    }
                                    ?></span>
                    </a>
                    <a href="" class="btn px-0 ml-2 cart_icon">
                        <i class="fas fa-shopping-cart text-dark "></i>
                        <span class="badge text-dark border border-dark rounded-circle"
                            style="padding-bottom: 2px;"> <?php 
                                    if(isset($_SESSION['uid'])){
                                        $uid=$_SESSION['uid'];
                                        $quer=$conn->prepare('select cart from users where id = :uid');
                                        $quer->bindParam(':uid',$uid);
                                        $quer->execute();
                                        $get_fav=$quer->fetchAll(PDO::FETCH_ASSOC);
                                        if(count($get_fav) > 0){
                                            $fa=explode(",",$get_fav[0]['cart']);
                                            echo count($fa)-1;

                                        }else{
                                            echo 0;
                                        }
                                    }else{
                                        echo 0;
                                    }
                                    ?></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="index.php" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">Your</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control for_focus1" placeholder="Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                    <div class="search_res search_res1">
                        <ul class="list-unstyled text-center">
                           
                        </ul>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Customer Service</p>
                <h5 class="m-0">+8801234567890</h5>
            </div>
        </div>
        <div class="lrform">
            <div class="lform">
                <div class="modal fade" id="lmodel" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Login Form</h5>
                                <a type="button" class="bnt btn-link" data-bs-dismiss="modal" aria-label="Close"><i
                                        class="fa fa-minus"></i></a>
                            </div>
                            <div class="modal-body">
                            <div class="alert alert-danger error_l" role="alert"></div>
                                <form id="login_form">
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" class="form-control" name="lemail" id="lemail"
                                            aria-describedby="emailHelp">
                                        <div id="emailHelp" class="form-text">We'll never share your email with anyone
                                            else.</div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="input-group">
                                            <input type="password" name="lpassword" id="lpassword" class="form-control"
                                                data-toggle="password">
                                            <div class="input-group-append">
                                                <span class="input-group-text pass_show" onclick="myFunction()">
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                                <div class="container text-center px-5">
                                    <div class="h">Login with</div>
                                    <div class="logicon d-flex justify-content-around">
                                        <i class="fa-brands fa-google"></i>
                                        <i class="fa-brands fa-facebook-square"></i>
                                        <i class="fa-brands fa-linkedin-in"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="rform">
                <div class="modal fade" id="rmodel" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">

                    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-body">
                                <div class="text-right">
                                    <a type="button" class="bnt btn-link text-right" data-bs-dismiss="modal"
                                    aria-label="Close"><i class="fa fa-xmark"></i></a>
                                </div>
                                
                                <!-- <div class="main-container">
                                    <div class="check-container">
                                        <div class="check-background">
                                            <svg viewBox="0 0 65 51" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7 25L27.3077 44L58.5 7" stroke="white" stroke-width="13"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </div>
                                        <div class="check-shadow"> </div>
                                    </div>
                                    <p>Successfull..........</p>

                                </div> -->
                                <div class="alert alert-danger error_r" role="alert"></div>
                                
                                <form class="row needs-validation" novalidate id="reg_form">
                                    
                                    <div class="col-6">
                                        <label for="rfname" class="form-label">First Name</label>
                                        <input pattern="[a-zA-Z]{2,15}" type="text" class="form-control" name="rfname" id="validationTooltip01"
                                            required >
                                            <div class="invalid-feedback">
                                                    Please choose a valid First name.
                                                </div>
                                    </div>
                                    <div class="col-6">
                                        <label for="rlname" class="form-label">Lname Name</label>
                                        <input type="text" pattern="[a-zA-Z]{3,20}" class="form-control" name="rlname" id="rlname" required>
                                        <div class="invalid-feedback">
                                            Please provide a valid last name.
                                            </div>
                                    </div>

                                    <div class="col-12">
                                        <label for="exampleInputEmail1" class="form-label">Email address</label>
                                        <input type="email" pattern="(.+)@(.+){2,}\.(.+){2,}" class="form-control" name="remail" id="remail"
                                            aria-describedby="emailHelp" required>
                                            <div class="invalid-feedback">
                                            Please provide a valid email.
                                            </div>
                                    </div>
                                    <div class="col-12">
                                        <label for="lpass" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password"  name="rpass" id="rpass" class="form-control"
                                                data-toggle="password" required>
                                                <span class="input-group-text pass_show" onclick="myFunction2()">
                                                    <i class="fa fa-eye"></i>
                                                </span>
                                                <div class="invalid-feedback">
                                        Minimum eight characters, at least one letter, one number and one special character
                                            </div>
                                                
                                        </div>
                                        
                                    </div>
                                    <div class="col-12">
                                        <label for="rphone" class="form-label">Phone</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <select name="rphone" id="rphone">
                                                    <option value="">+88</option>
                                                </select>
                                            </div>
                                            <input pattern="(^(\+88|0088)?(01){1}[3456789]{1}(\d){8})$" type="text"  name="rphone" id="rphone" class="form-control" required>
                                            <div class="invalid-feedback">
                                            Please provide a valid phone number.
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary mt-3 ml-3">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Topbar End -->


    <!-- Navbar Start -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5 ">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn d-flex align-items-center justify-content-between bg-primary w-100" data-toggle="collapse"
                    href="#navbar-vertical" style="height: 65px; padding: 0 30px;">
                    <h6 class="text-dark m-0"><i class="fa fa-bars mr-2"></i>Categories</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse position-absolute navbar navbar-vertical navbar-light align-items-start p-0 bg-light"
                    id="navbar-vertical" style="width: calc(100% - 30px); z-index: 999;">
                    <div class="navbar-nav w-100">
                    <?php 
                    $quere=$conn->prepare("select * from category");
                    $quere->execute();
                    $res=$quere->fetchAll(PDO::FETCH_ASSOC);
                    // echo "<pre>";
                    // // print_r($res);
                    // echo "</pre>";
                    if(count($res) > 0){
                        foreach ($res as $key => $value) {
                            if($value['sub'] > 0){
                                $cid=$value["cid"];
                                // echo $cid;
                                $quere=$conn->prepare("select * from subcata where cid= :cid");
                                $quere->bindParam(':cid',$cid);
                                
                                  $quere->execute();
                                    $subcatas=$quere->fetchAll(PDO::FETCH_ASSOC);

                                    echo '<div class="nav-item dropdown dropright">
                                    <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">'.$value["cname"].' <i
                                    class="fa fa-angle-right float-right mt-1"></i></a><div class="dropdown-menu position-absolute rounded-0 border-0 m-0">';
                                    foreach ($subcatas as $key2 => $value2) {
                                        if($value2['sup'] > 0){
                                            $suid=$value2["sid"];
                                            // echo $suid;
                                            $quere=$conn->prepare("select * from sup where sub= :suid");
                                            $quere->bindParam(':suid',$suid);
                                            
                                              $quere->execute();
                                              $supcatas=$quere->fetchAll(PDO::FETCH_ASSOC);
                                    // print_r($supcatas);

                                              echo '<li><a class="dropdown-item" href="category.php?sid='.$value2['sid'].'">'.$value2['subname'].' &raquo </a>
                                              <ul class="submenu dropdown-menu">';
                                                    foreach($supcatas as $key3 => $value3){
                                                        if(count($supcatas) > 0){
                                                             echo '<li><a class="dropdown-item" href="category.php?suid='.$value3['suid'].'"> '.$value3['supname'].'</a></li>';

                                                        }
                                                    }
                                                    echo '<a href="category.php?sub='.$value['cid'].'" class="dropdown-item">All '.$value2['subname'].'</a>';
                                                    echo '</ul>
                                                    </li>';

                                        }else{
                                        echo '<a href="category.php?sub='.$value['cid'].'" class="dropdown-item">'.$value2['subname'].'</a>';
                                        }
                                    }
                                    echo '<a href="category.php?cid='.$value['cid'].'" class="nav-item nav-link">All '.$value['cname'].'</a>';
                                    echo '  </div>
                                    </div>';
                            }else{
                                echo '<a href="category.php?cid='.$value['cid'].'" class="nav-item nav-link">'.$value['cname'].'</a>';

                            }
                        }
                    }else{
                        echo "No category Found :>(";
                    }
                
                    ?>
                    
                     
                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0 res_logo_search">
                    <div class="res_search">
                        <form action="">
                            <div class="input-group">
                                <input type="text" class="form-control for_focus2 res_s_in"
                                    placeholder="Search for products">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent text-primary res_s_btn">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <div class="search_res search_res2">
                            <ul class="list-unstyled text-center">
                               
                            </ul>
                        </div>
                    </div>
                    <a href="index.php" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">Your</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>

                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link <?php if($finame == "index.php"){echo 'active';} ?>">Home</a>
                            <a href="today.php" class="nav-item nav-link <?php if($finame == "today.php"){echo 'active';} ?>">Today Deal's</a>
                            <a href="offer.php" class="nav-item nav-link <?php if($finame == "offer.php"){echo 'active';} ?>">Special Offer</a>

                            <li class="nav-item dropdown d-lg-none">
                                <a class="nav-link dropdown-toggle <?php if($finame == "contact.php"){echo 'active';} ?>" href="#" data-toggle="dropdown"> catagory </a>
                                <ul class="dropdown-menu"> <?php 
                    $quere=$conn->prepare("select * from category");
                    $quere->execute();
                    $res=$quere->fetchAll(PDO::FETCH_ASSOC);
                    // echo "<pre>";
                    // // print_r($res);
                    // echo "</pre>";
                    if(count($res) > 0){
                        foreach ($res as $key => $value) {
                            if($value['sub'] > 0){
                                $cid=$value["cid"];
                                // echo $cid;
                                $quere=$conn->prepare("select * from subcata where cid= :cid");
                                $quere->bindParam(':cid',$cid);
                                
                                  $quere->execute();
                                    $subcatas=$quere->fetchAll(PDO::FETCH_ASSOC);

                                    echo '<li><a class="dropdown-item not_li" href="category.php?cid='.$value['cid'].'"> '.$value['cname'].' &raquo </a><ul class="submenu dropdown-menu">';
                                    foreach ($subcatas as $key2 => $value2) {
                                        if($value2['sup'] > 0){
                                            $suid=$value2["sid"];
                                            // echo $suid;
                                            $quere=$conn->prepare("select * from sup where sub= :suid");
                                            $quere->bindParam(':suid',$suid);
                                            
                                              $quere->execute();
                                              $supcatas=$quere->fetchAll(PDO::FETCH_ASSOC);
                                    // print_r($supcatas);

                                              echo '<li><a class="dropdown-item not_li" href="#">'.$value2['subname'].' &raquo </a>
                                              <ul class="submenu dropdown-menu">';
                                                    foreach($supcatas as $key3 => $value3){
                                                        if(count($supcatas) > 0){
                                                             echo '<li><a class="dropdown-item" href="category.php?suid='.$value3['suid'].'"> '.$value3['supname'].'</a></li>';

                                                        }
                                                    }
                                                    echo '<li><a class="dropdown-item" href="category.php?sid='.$value2['sid'].'">All '.$value2['subname'].'</a></li>';
                                                    echo '</ul>
                                                    </li>';

                                        }else{
                                        echo '<li><a class="dropdown-item" href="category.php?sid='.$value2['sid'].'"> '.$value2['subname'].'</a></li>';
                                        }
                                    }
                                    echo '<li><a class="dropdown-item" href="category.php?cid='.$value['cid'].'"> All '.$value['cname'].' </a></li>';
                                    echo '  </ul>
                                    </li>';
                            }else{
                                echo '<li><a class="dropdown-item" href="category.php?cid='.$value['cid'].'"> '.$value['cname'].' </a></li>';

                            }
                        }
                    }else{
                        echo "No category Found :>(";
                    }
                
                    ?>
                                                              </ul>
                            </li>
                            <a href="contact.php" class="nav-item nav-link <?php if($finame == "contact.php"){echo 'active';} ?>">Contact</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block show_cart">
                            <a href="" class="btn px-0 fav_icon" >
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle"
                                    style="padding-bottom: 2px;">
                                    <?php 
                                    if(isset($_SESSION['uid'])){
                                        $uid=$_SESSION['uid'];
                                        $quer=$conn->prepare('select fav from users where id = :uid');
                                        $quer->bindParam(':uid',$uid);
                                        $quer->execute();
                                        $get_fav=$quer->fetchAll(PDO::FETCH_ASSOC);
                                        if(count($get_fav) > 0){
                                            $fa=explode(",",$get_fav[0]['fav']);
                                            echo count($fa) -1;

                                        }else{
                                            echo 0;
                                        }
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </span>
                            </a>
                            <a href="" class="btn px-0 ml-3 cart_icon">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle"
                                    style="padding-bottom: 2px;">
                                    <?php 
                                    if(isset($_SESSION['uid'])){
                                        $uid=$_SESSION['uid'];
                                        $quer=$conn->prepare('select cart from users where id = :uid');
                                        $quer->bindParam(':uid',$uid);
                                        $quer->execute();
                                        $get_fav=$quer->fetchAll(PDO::FETCH_ASSOC);
                                        if(count($get_fav) > 0){
                                            $fa=explode(",",$get_fav[0]['cart']);
                                            echo count($fa) -1;

                                        }else{
                                            echo 0;
                                        }
                                    }else{
                                        echo 0;
                                    }
                                    ?>
                                </span>
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
        </div>

    </div>
    <!-- Navbar End -->
  <!-- Back to Top -->
  <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>
<!-- loder -->
<div class="loader_sec">
        <div class="box">
            <div class="loader-30"></div>
        </div>
    </div>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
</script>

<!-- <script src="js/jquery.js"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Contact Javascript File -->
<script src="mail/jqBootstrapValidation.min.js"></script>
<script src="mail/contact.js"></script>

<!-- Template Javascript -->
<script src="js/main.js"></script>
<script src="js/custom.js"></script>
<script></script>
</body>

</html>