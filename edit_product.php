<?php
  $page_title = 'Edit product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$product = find_by_id('products',(int)$_GET['id']);
$all_categories = find_all('categories');
$all_photo = find_all('media');
if(!$product){
  $session->msg("d","Missing product id.");
  redirect('product.php');
}
?>
<?php
 if(isset($_POST['product'])){
    $req_fields = array('product-title','product-categorie','product-quantity','buying-price', 'saleing-price' );
    validate_fields($req_fields);

   if(empty($errors)){
      $p_name  = remove_junk($db->escape($_POST['product-title']));
      $p_cat   = (int)$_POST['product-categorie'];
      $p_qty   = remove_junk($db->escape($_POST['product-quantity']));
      $p_buy   = remove_junk($db->escape($_POST['buying-price']));
      $p_sale  = remove_junk($db->escape($_POST['saleing-price']));
      $singleUnit = remove_junk($db->escape($_POST['singleUnit']));
      $itemLink = remove_junk($db->escape($_POST['itemLink']));
      $city = remove_junk($db->escape($_POST['city']));
      $zipcode = remove_junk($db->escape($_POST['zipcode']));
      $phone = remove_junk($db->escape($_POST['phone']));
      $email = remove_junk($db->escape($_POST['email']));
      $delieveryTime = remove_junk($db->escape($_POST['delieveryTime']));
      $freeShipping = remove_junk($db->escape($_POST['freeShipping']));
      $company = remove_junk($db->escape($_POST['company']));
      $website = remove_junk($db->escape($_POST['website']));
      $description = remove_junk($db->escape($_POST['description']));
      $purchaseType = remove_junk($db->escape($_POST['purchaseType']));
       if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
         $media_id = '0';
       } else {
         $media_id = remove_junk($db->escape($_POST['product-photo']));
       }
       $query   = "UPDATE products SET";
       $query  .=" name ='{$p_name}', quantity ='{$p_qty}', singleUnit='{$singleUnit}', itemLink='{$itemLink}', city='{$city}', zipcode='{$zipcode}', phone='{$phone}', email='{$email}', delieveryTime='{$delieveryTime}', freeShipping='{$freeShipping}', company='{$company}', website='{$website}', description='{$description}', purchaseType='{$purchaseType}',";
       $query  .=" buy_price ='{$p_buy}', sale_price ='{$p_sale}', categorie_id ='{$p_cat}',media_id='{$media_id}'";
       $query  .=" WHERE id ='{$product['id']}'";
       $result = $db->query($query);
               if($result && $db->affected_rows() === 1){
                 $session->msg('s',"Product updated ");
                 redirect('product.php', false);
               } else {
                 $session->msg('d',' Sorry failed to updated!');
                 redirect('edit_product.php?id='.$product['id'], false);
               }

   } else{
       $session->msg("d", $errors);
       redirect('edit_product.php?id='.$product['id'], false);
   }

 }

?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
</div>
  <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Product</span>
         </strong>
        </div>
        <div class="panel-body">
         <div class="col-md-7">
           <form method="post" action="edit_product.php?id=<?php echo (int)$product['id'] ?>">
              <div class="form-group">
                <div class="input-group">
                  <span class="input-group-addon">
                   <i class="glyphicon glyphicon-th-large"></i>
                  </span>
                  <input type="text" class="form-control" name="product-title" value="<?php echo remove_junk($product['name']);?>">
               </div>
              </div>
              <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <select class="form-control" name="product-categorie">
                    <option value=""> Select a categorie</option>
                   <?php  foreach ($all_categories as $cat): ?>
                     <option value="<?php echo (int)$cat['id']; ?>" <?php if($product['categorie_id'] === $cat['id']): echo "selected"; endif; ?> >
                       <?php echo remove_junk($cat['name']); ?></option>
                   <?php endforeach; ?>
                 </select>
                  </div>
                  <div class="col-md-6">
                    <select class="form-control" name="product-photo">
                      <option value=""> No image</option>
                      <?php  foreach ($all_photo as $photo): ?>
                        <option value="<?php echo (int)$photo['id'];?>" <?php if($product['media_id'] === $photo['id']): echo "selected"; endif; ?> >
                          <?php echo $photo['file_name'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-group">
               <div class="row">
                 <div class="col-md-4">
                  <div class="form-group">
                    <label for="qty">Quantity</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                       <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input type="number" class="form-control" name="product-quantity" value="<?php echo remove_junk($product['quantity']); ?>">
                   </div>
                  </div>
                 </div>
                 <div class="col-md-4">
                  <div class="form-group">
                    <label for="qty">Buying price</label>
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-usd"></i>
                      </span>
                      <input type="number" class="form-control" name="buying-price" value="<?php echo remove_junk($product['buy_price']);?>">
                      <span class="input-group-addon">.00</span>
                   </div>
                  </div>
                 </div>
                  <div class="col-md-4">
                   <div class="form-group">
                     <label for="qty">Selling price</label>
                     <div class="input-group">
                       <span class="input-group-addon">
                         <i class="glyphicon glyphicon-usd"></i>
                       </span>
                       <input type="number" class="form-control" name="saleing-price" value="<?php echo remove_junk($product['sale_price']);?>">
                       <span class="input-group-addon">.00</span>
                    </div>
                   </div>
                  </div>
               </div>
              </div>

              <!-- For ProductType & itemLink-->
            <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-glass"></i>
                      </span>
                      <input value="<?php echo remove_junk($product['purchaseType']) ?>" type="text" class="form-control" name="purchaseType" placeholder="Product Type">
                   </div>                  
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-link"></i>
                      </span>
                      <input value="<?php echo remove_junk($product['itemLink']) ?>" type="text" class="form-control" name="itemLink" placeholder="Item Link">
                   </div>
                  </div>
                </div>
              </div>
            
            <!-- For Company & Phone-->
            <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-briefcase"></i>
                      </span>
                      <input value="<?php echo remove_junk($product['company']) ?>" type="text" class="form-control" name="company" placeholder="Company">
                   </div>                  
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-phone"></i>
                      </span>
                      <input value="<?php echo remove_junk($product['phone']) ?>" type="text" class="form-control" name="phone" placeholder="Phone">
                   </div>
                  </div>
                </div>
              </div>

            <!-- For Website & Email-->
            <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-send"></i>
                      </span>
                      <input value="<?php echo remove_junk($product['email']) ?>" type="email" class="form-control" name="email" placeholder="Email">
                   </div>                  
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-link"></i>
                      </span>
                      <input value="<?php echo remove_junk($product['website']) ?>" type="text" class="form-control" name="website" placeholder="Website">
                   </div>
                  </div>
                </div>
              </div>
            <!-- For City & ZipCode-->
            <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-road"></i>
                      </span>
                      <input value="<?php echo remove_junk($product['city']) ?>" type="text" class="form-control" name="city" placeholder="City">
                   </div>                  
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-map-marker"></i>
                      </span>
                      <input value="<?php echo remove_junk($product['zipcode']) ?>" type="text" class="form-control" name="zipcode" placeholder="Zip Code">
                   </div>
                  </div>
                </div>
              </div>
            <!-- For Single Unit & Description-->
            <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-plane"></i>
                      </span>
                      <input value="<?php echo remove_junk($product['singleUnit']) ?>" type="text" class="form-control" name="singleUnit" placeholder="Single Unit">
                   </div>                  
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-leaf"></i>
                      </span>
                      <input value="<?php echo remove_junk($product['description']) ?>" type="text" class="form-control" name="description" placeholder="Description">
                   </div>
                  </div>
                </div>
              </div>
           <!-- For deliveryTime & freeShipping-->
            <div class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-shopping-cart"></i>
                      </span>
                      <input value="<?php echo remove_junk($product['deliveryTime']) ?>" type="text" class="form-control" name="deliveryTime" placeholder="Delivery Time">
                   </div>                  
                  </div>
                  <div class="col-md-6">
                    <div class="input-group">
                      <span class="input-group-addon">
                        <i class="glyphicon glyphicon-asterisk"></i>
                      </span>
                      <input value="<?php echo remove_junk($product['freeShipping']) ?>" type="text" class="form-control" name="freeShipping" placeholder="Free Shipping">
                   </div>
                  </div>
                </div>
              </div>
              <button type="submit" name="product" class="btn btn-danger">Update</button>
          </form>
         </div>
        </div>
      </div>
  </div>

<?php include_once('layouts/footer.php'); ?>
