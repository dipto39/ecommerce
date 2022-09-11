<?php include 'header.php'?>
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
              <h2 class="tm-block-title d-inline-block">Add Product</h2>
            </div>
          </div>
          <div class="row tm-edit-product-row">
            <div class="col-xl-6 col-lg-6 col-md-12">
              <form  class="tm-edit-product-form" id="addProduct">
                <div class="form-group mb-3">
                  <label for="pname">Product Name
                  </label>
                  <input id="pname" name="pname" type="text" class="form-control validate" required />
                </div>
                <div class="form-group mb-3">
                  <label for="description">Description</label>
                  <textarea class="form-control validate" rows="3" id='des' name="des" required></textarea>
                </div>
                <div class="form-group mb-3">
                  <label for="ainfo">Additional info</label>
                  <textarea class="form-control validate" rows="3" id="ainfo" name="ainfo" required></textarea>
                </div>
                <div class="form-group mb-3">
                  <label for="category">Category</label>
                  <select class="custom-select tm-select-accounts" name="category" id="category" required>
                    <option value="" selected disabled>Select category</option>
                    <?php $quer=$conn->prepare("select * from category");
                    $quer->execute();
                    $getc=$quer->fetchAll(PDO::FETCH_ASSOC);
                    // print_r($getc);
                    foreach ($getc as $key => $value) {
                      echo '<option value="'.$value['cid'].'">'.$value['cname'].'</option>';
                    }?>
                    
                  </select>
                </div>
                <div class="form-group mb-3 cata1">
                  
                </div>
                <div class="form-group mb-3 cata2">
                 
                </div>
                <div class="row">
                  <div class="form-group mb-3 col-xs-12 col-sm-6">
                    <label for="price">Price
                    </label>
                    <input id="price" name="price" type="number" class="form-control validate" data-large-mode="true" required/>
                  </div>
                  <div class="form-group mb-3 col-xs-12 col-sm-6">
                    <label for="off">Off
                    </label>
                    <input id="off" name="off" type="number" class="form-control validate" required />
                  </div>
                </div>
                <div class="row">
                  <div class="form-group mb-3 col-12">
                    <label for="scolor">Select Color
                    </label>
                    <div class="form-check d-flex justify-content-around overflow-auto text-light">
                    <input type="checkbox" name="scolor" class="scolor" value="Red">Red<br>          
                    <input type="checkbox" name="scolor" class="scolor" value="green">green<br>          
                    <input type="checkbox" name="scolor" class="scolor" value="Blue">Blue<br>          
                    <input type="checkbox" name="scolor" class="scolor" value="Black">Black<br>          
                    <input type="checkbox" name="scolor" class="scolor" value="Gray">Gray<br>          
                    </div>
                  </div>
                  <div class="form-group mb-3 col-12">
                    <label for="ssize">Select size
                    </label>
                    <div class="form-check d-flex justify-content-around overflow-auto text-light">
                    <input type="checkbox" name="size" class="size" value="S">S<br>          
                    <input type="checkbox" name="size" class="size" value="M">M<br>          
                    <input type="checkbox" name="size" class="size" value="XL">Xl<br>          
                    <input type="checkbox" name="size" class="size" value="XXl">XXl<br>          
                    </div>
                  </div>
                  <div class="form-group mb-3 col-12">
                    <label for="stock">Units In Stock
                    </label>
                    <input id="stock" name="stock" type="number" class="form-control validate" required />
                  </div>
                </div>

            </div>
            <div class="col-xl-6 col-lg-6 col-md-12 mx-auto mb-4">
              <div class="tm-product-img-dummy mx-auto">
                <img id="blah" src="#" alt=" ">
              </div>
              <div class="custom-file mt-3 mb-3">
                <input id="imgInp" type="file" style="display:none;" name="photo" accept="image/*" />
                <input type="button" class="btn btn-primary btn-block mx-auto" value="UPLOAD PRODUCT IMAGE"
                  onclick="document.getElementById('imgInp').click();" required />
              </div>
            </div>
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block text-uppercase">Add Product Now</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
<?php include 'footer.php'?>