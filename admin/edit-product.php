<?php include 'header.php';
if(!isset($_GET['pid'])){
  echo '<script>window.location.replace("'.$domain.'/admin")</script>';
}else{
  $pid=$_GET['pid'];
  $quer=$conn->prepare("select * from product inner join pdetails on product.pid = pdetails.pid where product.pid=:pid");
  $quer->bindParam(":pid",$pid);
  $quer->execute();
  $res=$quer->fetchAll(PDO::FETCH_ASSOC);
  if(!count($res) > 0){
    echo '<script>window.location.replace("'.$domain.'/admin")</script>';
  }
}

?>
<div class="modal fade" id="adderror" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">You have some eroor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body errbody">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="container tm-mt-big tm-mb-big">
      <div class="row">
        <div class="col-xl-9 col-lg-10 col-md-12 col-sm-12 mx-auto">
          <div class="tm-bg-primary-dark tm-block tm-block-h-auto">
            <div class="row">
              <div class="col-12">
                <h2 class="tm-block-title d-inline-block">Edit Product</h2>
              </div>
            </div>
            <div class="row tm-edit-product-row">
              <div class="col-xl-6 col-lg-6 col-md-12">
                <form id="upform" class="tm-edit-product-form">
                  <div class="form-group mb-3">
                    <input type="text" name="id" id="id" value="<?php echo $res[0]['pid']?>" hidden>
                    <input type="text" name="pcode" id="pcode" value="<?php echo $res[0]['pcode']?>" hidden>
                    <label
                      for="pname"
                      >Product Name
                    </label>
                    <input
                      id="pname"
                      name="pname"
                      type="text"
                      value="<?php echo $res[0]['pname']?>"
                      class="form-control validate"
                    />
                  </div>
                  <div class="form-group mb-3">
                    <label
                      for="description"
                      >Description</label
                    >
                    <textarea    
                      name="des"
                      id="des"                
                      class="form-control validate tm-small"
                      rows="5"
                      required
                    ><?php echo $res[0]['dis']?></textarea>
                  </div>
                  <div class="form-group mb-3">
                  <label for="ainfo">Additional info</label>
                  <textarea class="form-control validate" rows="3" id="ainfo" name="ainfo" required><?php echo $res[0]['addinfo']?></textarea>
                </div>
                  <div class="row">
                  <div class="form-group mb-3 col-xs-12 col-sm-6">
                    <label for="price">Price
                    </label>
                    <input id="price" name="price" type="number" value="<?php echo $res[0]['price']?>" class="form-control validate" data-large-mode="true" required/>
                  </div>
                  <div class="form-group mb-3 col-xs-12 col-sm-6">
                    <label for="off">Off
                    </label>
                    <input id="off" name="off" type="number" value="<?php echo $res[0]['off']?>" class="form-control validate" required />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group mb-3 col-12">
                    <label for="scolor">Select Color
                    </label>
                    <div class="form-check d-flex justify-content-around overflow-auto text-light">
                    <?php 
                    $color=explode(",",$res[0]['color']);
                    $size=explode(",",$res[0]['size']);
                    ?>
                    <input type="checkbox" name="scolor" class="scolor" <?php if(in_array("Red",$color)){echo "checked";}?> value="Red">Red<br>          
                    <input type="checkbox" name="scolor" class="scolor" <?php if(in_array("green",$color)){echo "checked";}?> value="green">green<br>          
                    <input type="checkbox" name="scolor" class="scolor" <?php if(in_array("Blue",$color)){echo "checked";}?> value="Blue">Blue<br>          
                    <input type="checkbox" name="scolor" class="scolor" <?php if(in_array("Black",$color)){echo "checked";}?> value="Black">Black<br>          
                    <input type="checkbox" name="scolor" class="scolor" <?php if(in_array("Green",$color)){echo "checked";}?> value="Gray">Gray<br>          
                    </div>
                  </div>
                  <div class="form-group mb-3 col-12">
                    <label for="ssize">Select size
                    </label>
                    <div class="form-check d-flex justify-content-around overflow-auto text-light">
                    <input type="checkbox" name="size" class="size" <?php if(in_array("S",$size)){echo "checked";}?> value="S">S<br>          
                    <input type="checkbox" name="size" class="size" <?php if(in_array("M",$size)){echo "checked";}?> value="M">M<br>          
                    <input type="checkbox" name="size" class="size" <?php if(in_array("XL",$size)){echo "checked";}?> value="XL">Xl<br>          
                    <input type="checkbox" name="size" class="size" <?php if(in_array("XXl",$size)){echo "checked";}?> value="XXl">XXl<br>          
                    </div>
                  </div>
                  <div class="form-group mb-3 col-12">
                    <label for="stock">Units In Stock
                    </label>
                    <input id="stock" name="stock" type="number" value="<?php echo $res[0]['stock']?>" class="form-control validate" required />
                  </div>
                </div>

                  
              </div>
              <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
              <div class="tm-product-img-dummy mx-auto">
                <img id="blah" src="<?php echo "img/products/". $res[0]['pp']?>" alt=" ">
              </div>
              <div class="custom-file mt-3 mb-3">
                <input id="imgInp" type="file" style="display:none;" name="photo" accept="image/*" />
                <input type="button" class="btn btn-primary btn-block mx-auto" value="UPLOAD PRODUCT IMAGE"
                  onclick="document.getElementById('imgInp').click();" required />
              </div>
              </div>
              <div class="col-12">
                <button type="submit" class="btn btn-primary btn-block text-uppercase">Update Now</button>
              </div>
            </form>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php include 'footer.php'?>
