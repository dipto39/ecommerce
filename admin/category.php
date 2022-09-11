<?php include 'header.php';?>
<div class="container mt-5">
        <div class="row tm-content-row">
            <div class="col-xl-8 col-lg-8 col-md-12 tm-block-col">
                <div class="tm-bg-primary-dark tm-block tm-block-product-categories">
                    <h2 class="tm-block-title">Product Categories</h2>
                    <div class="tm-product-table-container">
                        <table class="table tm-table-small tm-product-table">
                        <ul class="list-unstyled w-100">
                            <?php 
                            $quer=$conn->prepare("select * from category");
                            $quer->execute();
                            $getcata=$quer->fetchAll(PDO::FETCH_ASSOC);
                            $dataa="";
                            foreach ($getcata as $key => $value) {
                                if($value['sub'] > 0){
                                    $dataa.= '<div class="li2">
                                    <li class="d-flex justify-content-between p-3 mb-1 cata_li text-light"><a
                                            href="#">'.$value['cname'].'</a>
                                        <i class="fas fa-plus show_sub"></i></li>
                                        ';
                                        $cid=$value['cid'];
                                        $quer1=$conn->prepare("select * from subcata where cid = :cid");
                                        $quer1->bindParam(":cid",$cid);
                                        $quer1->execute();
                                        $subcata=$quer1->fetchAll(PDO::FETCH_ASSOC);
                                        $dataa.= '<div class="subcata">';
                                        foreach ($subcata as $key => $value1) {
                                            if($value1['sup'] > 0){
                                                $dataa.= '<div class="li">
                                                <li class="d-flex justify-content-between p-3 mb-1 cata_li text-light"><a
                                                        href="#">'.$value1['subname'].'</a> <i class="fas fa-plus show_sup"></i></li>';
                                                        $subid=$value1['sid'];
                                                        $quer2=$conn->prepare("select * from sup where sub = :sid");
                                                        $quer2->bindParam(":sid",$subid);
                                                        $quer2->execute();
                                                        $subcata=$quer2->fetchAll(PDO::FETCH_ASSOC);
                                                        $dataa.= '<div class="supcata">';
                                                        foreach ($subcata as $key => $value2) {
                                                            
                                                            $dataa.= '<li class="d-flex justify-content-between p-3 mb-1 cata_li text-light">
                                                                <a href="#">'.$value2['supname'].'</a>
                                                                <i class="far fa-trash-alt dsupcata" data-attr="'.$value['cid'].','.$value1['sid'].','.$value2['suid'].'"></i></li>';
                                               
                                                        }
                                                        $dataa.= '</div>';
                                                        $dataa.= '</div>';
                                            }else{
                                                $dataa.= '<li class="d-flex justify-content-between p-3 mb-1 cata_li text-light"><a
                                                href="#">'.$value1['subname'].'
                                                </a> <i class="far fa-trash-alt dsubcata" data-attr="'.$value['cid'].','.$value1['sid'].'"></i></li>';
                                            }
                                            
                                        }
                                       
                                        $dataa.= '</div>';
                                        $dataa.= '</div>';
                                        
                                }else{
                                    $dataa.= '<li class="d-flex justify-content-between p-3 mb-1 cata_li text-light"><a
                                    href="#">'.$value['cname'].'</a> <i class="far fa-trash-alt dmcata" data-attr="'.$value['cid'].'"></i></li>';
                                }
                               
                            }
                            echo $dataa;
                            ?>
                                <!-- <div class="li2">
                                    <li class="d-flex justify-content-between p-3 mb-1 cata_li text-light"><a
                                            href="#">cata1</a>
                                        <i class="fas fa-plus show_sub"></i></li>
                                    <div class="subcata">
                                        <li class="d-flex justify-content-between p-3 mb-1 cata_li text-light"><a
                                                href="#">cata1
                                                2nd</a> <i class="far fa-trash-alt dcata"></i></li>
                                        <div class="li">
                                            <li class="d-flex justify-content-between p-3 mb-1 cata_li text-light"><a
                                                    href="#">cata1
                                                    3nd</a> <i class="fas fa-plus show_sup"></i></li>
                                            <div class="supcata">
                                                <li class="d-flex justify-content-between p-3 mb-1 cata_li text-light">
                                                    <a href="#">cata1
                                                        3nd</a>
                                                    <i class="far fa-trash-alt dcata"></i></li>
                                                <li class="d-flex justify-content-between p-3 mb-1 cata_li text-light">
                                                    <a href="#">cata1
                                                        3nd</a>
                                                    <i class="far fa-trash-alt dcata"></i></li>
                                            </div>
                                        </div>
                                        <li class="d-flex justify-content-between p-3 mb-1 cata_li text-light"><a
                                                href="#">cata1
                                                2nd</a> <i class="far fa-trash-alt dcata"></i></li>
                                    </div>
                                </div>
                                <li class="d-flex justify-content-between p-3 mb-1 cata_li text-light"><a
                                        href="#">cata1</a> <i class="far fa-trash-alt dcata"></i></li>
                                <li class="d-flex justify-content-between p-3 mb-1 cata_li text-light"><a
                                        href="#">cata1</a> <i class="far fa-trash-alt dcata"></i></li>
                                <div class="li">
                                    <li class="d-flex justify-content-between p-3 mb-1 cata_li text-light"><a
                                            href="#">cata1</a>
                                        <i class="fas fa-plus show_sub"></i></li>
                                    <div class="subcata">
                                        <li class="d-flex justify-content-between p-3 mb-1 cata_li text-light"><a
                                                href="#">cata1
                                                2nd</a> <i class="far fa-trash-alt dcata"></i></li>
                                        <div class="li">
                                            <li class="d-flex justify-content-between p-3 mb-1 cata_li text-light"><a
                                                    href="#">cata1
                                                    3nd</a> <i class="fas fa-plus show_sup"></i></li>
                                            <div class="supcata">
                                                <li class="d-flex justify-content-between p-3 mb-1 cata_li text-light">
                                                    <a href="#">cata1
                                                        3nd</a>
                                                    <i class="far fa-trash-alt dcata"></i></li>
                                                <li class="d-flex justify-content-between p-3 mb-1 cata_li text-light">
                                                    <a href="#">cata1
                                                        3nd</a>
                                                    <i class="far fa-trash-alt dcata"></i></li>
                                            </div>
                                        </div>
                                        <li class="d-flex justify-content-between p-3 mb-1 cata_li text-light"><a
                                                href="#">cata1
                                                2nd</a> <i class="far fa-trash-alt dcata"></i></li>
                                    </div>
                                </div> -->
                            </ul>
                        </table>
                    </div>
                    <!-- table container -->

                </div>
            </div>
            <div class="col-xl-4 col-lg-4 col-md-12 tm-block-col">
                <h2 class="tm-block-title">Add Categories</h2>

                <form action="" class="tm-edit-product-form aform">
                <div class="form-group mb-3 maincata">
                        <label for="category">Category</label>
                        <select class="custom-select tm-select-accounts" id="acategory">
                        <option selected value="">Select category</option>
                    <?php  
                    foreach ($getcata as $key => $value) {
                       echo '<option value="'.$value['cid'].'">'.$value['cname'].'</option>';
                    }
                    ?>
                    
                    </select>
                    </div> 
                    <div class="form-group mb-3 asubcata">
                    </div>
                    <div class="form-group mb-3 cnamee">
                        <label for="category">Add main catatory</label>
                        <input type="text" class="form-control"  id="aval"  placeholder="Category name" required>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block text-uppercase">Add Product Now</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include 'footer.php';?>
