<?php include 'header.php';?>
<div class="container mt-5">
    <div class="row tm-content-row">

      <div class="col-12  tm-block-col">
        <div class="search_order">
          <div class="input-gorup d-flex mb-2">
            <input class="form-control" type="search" name="osearch" id="osearch" placeholder="search by order id">
            <span class="input-group-text">
              <i class="fa fa-search"></i>
            </span>
          </div>

        </div>
        <div class="tm-bg-primary-dark tm-block tm-block-products">
          <div class="tm-product-table-container">

            <table class="table table-hover tm-table-small tm-product-table otabel">
              <thead>
                            <tr class="p-0 closeose">
                                <th colspan="7" class="text-right p-0 pr-5">
                                    <p class="csorder">x</p>
                                </th>
                            </tr>
                <tr>
                  <th scope="col">&nbsp;</th>
                  <th scope="col">PRODUCT NAME</th>
                  <th scope="col">Avatar</th>
                  <th scope="col">UNIT SOLD</th>
                  <th scope="col">IN STOCK</th>
                  <th scope="col">PCODE</th>
                  <th scope="col">&nbsp;</th>
                </tr>
              </thead>
              <tbody>
                
                <!-- <tr>
                  
                  <th scope="row"><input type="checkbox" /></th>
                  <td class="tm-product-name">Lorem Ipsum Product 1</td>
                  <td><img src="img/avatar.png" alt=" "></td>
                  <td>1,450</td>
                  <td>550</td>
                  <td>#fsade</td>
                  <td>
                    <a href="#" class="tm-product-delete-link">
                      <i class="far fa-trash-alt tm-product-delete-icon"></i>
                    </a>
                  </td>
                </tr> -->

              </tbody>
            </table>
          </div>
          <!-- table container -->
          <a href="add-product.php" class="btn btn-primary btn-block text-uppercase mb-3">Add new product</a>
          
        </div>
      </div>
    </div>
  </div>
<?php include 'footer.php';?>
