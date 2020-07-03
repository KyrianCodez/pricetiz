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
      $p_name  =  ($db->escape($_POST['product-title']));
      $p_cat   = (int)$_POST['product-categorie'];
      $p_qty   =  ($db->escape($_POST['product-quantity']));
      $p_buy   =  ($db->escape($_POST['buying-price']));
      $p_sale  =  ($db->escape($_POST['saleing-price']));
      $singleUnit =  ($db->escape($_POST['singleUnit']));
      $singleUnits =  ($db->escape($_POST['singleUnits']));
      $singleValue =  ($db->escape($_POST['singleValue']));
      $itemLink =  ($db->escape($_POST['itemLink']));
      $reviewLink =  ($db->escape($_POST['reviewLink']));
      $city =  ($db->escape($_POST['city']));
      $zipcode =  ($db->escape($_POST['zipcode']));
      $phone =  ($db->escape($_POST['phone']));
      $email =  ($db->escape($_POST['email']));
      $delieveryTime =  ($db->escape($_POST['delieveryTime']));
      $freeShipping =  ($db->escape($_POST['freeShipping']));
      $company =  ($db->escape($_POST['company']));
      $website =  ($db->escape($_POST['website']));
      $description =  ($db->escape($_POST['description']));
      $purchaseType =  ($db->escape($_POST['purchaseType']));
       if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
         $media_id = '0';
       } else {
         $media_id =  ($db->escape($_POST['product-photo']));
       }
       $query   = "UPDATE products SET";
       $query  .=" name ='{$p_name}', quantity ='{$p_qty}', singleUnit='{$singleUnit}', singleUnits ='{$singleUnits}',singleValue='{$singleValue}', itemLink='{$itemLink}', reviewLink='{$reviewLink}', city='{$city}', zipcode='{$zipcode}', phone='{$phone}', email='{$email}', delieveryTime='{$delieveryTime}', freeShipping='{$freeShipping}', company='{$company}', website='{$website}', description='{$description}', purchaseType='{$purchaseType}',";
       $query  .=" buy_price ='{$p_buy}', sale_price ='{$p_sale}', categorie_id ='{$p_cat}',media_id='{$media_id}'";
       $query  .=" WHERE id ='{$product['id']}'";
       $result = $db->query($query);
               if($result){
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
                <span>Edit Product Info</span>
            </strong>
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                <form method="post" action="edit_product.php?id=<?php echo (int)$product['id'] ?>">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <input type="text" class="form-control" name="product-title"
                                value="<?php echo  ($product['name']);?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <select class="form-control" name="product-categorie">
                                    <option value=""> Select a categorie</option>
                                    <?php  foreach ($all_categories as $cat): ?>
                                    <option value="<?php echo (int)$cat['id']; ?>"
                                        <?php if($product['categorie_id'] === $cat['id']): echo "selected"; endif; ?>>
                                        <?php echo  ($cat['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <select class="form-control" name="product-photo">
                                    <option value=""> No image</option>
                                    <?php  foreach ($all_photo as $photo): ?>
                                    <option value="<?php echo (int)$photo['id'];?>"
                                        <?php if($product['media_id'] === $photo['id']): echo "selected"; endif; ?>>
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
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </span>
                                        <input type="number" class="form-control" name="product-quantity"
                                            value="<?php echo  ($product['quantity']); ?>">
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
                                        <input type="number" step="0.01" min="0" class="form-control"
                                            name="buying-price"
                                            value="<?php echo  ($product['buy_price']);?>">
                                        <!-- <span class="input-group-addon">.00</span> -->
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
                                        <input type="number" step="0.01" min="0" class="form-control"
                                            name="saleing-price"
                                            value="<?php echo  ($product['sale_price']);?>">
                                        <!-- <span class="input-group-addon">.00</span> -->
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
                                        <i class="fas fa-list"></i>
                                    </span>
                                    <input value="<?php echo  ($product['purchaseType']) ?>" type="text"
                                        class="form-control" name="purchaseType" placeholder="Product Type">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-link"></i>
                                    </span>
                                    <input value="<?php echo ($product['itemLink']) ?>" type="text"
                                        class="form-control" name="itemLink" placeholder="Item Link">
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
                                        <i class="far fa-building"></i>
                                    </span>
                                    <input value="<?php echo  ($product['company']) ?>" type="text"
                                        class="form-control" name="company" placeholder="Company">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-phone"></i>
                                    </span>
                                    <input value="<?php echo  ($product['phone']) ?>" type="text"
                                        class="form-control" name="phone" placeholder="Phone">
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
                                    <input value="<?php echo  ($product['email']) ?>" type="email"
                                        class="form-control" name="email" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-link"></i>
                                    </span>
                                    <input value="<?php echo  ($product['website']) ?>" type="text"
                                        class="form-control" name="website" placeholder="Website">
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
                                    <input value="<?php echo  ($product['city']) ?>" type="text"
                                        class="form-control" name="city" placeholder="City">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="glyphicon glyphicon-map-marker"></i>
                                    </span>
                                    <input value="<?php echo  ($product['zipcode']) ?>" type="text"
                                        class="form-control" name="zipcode" placeholder="Zip Code">
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
                                        <i class="glyphicon glyphicon-pencil"></i>
                                    </span>
                                    <input value="<?php echo  ($product['singleUnit']) ?>" type="text"
                                        class="form-control" name="singleUnit" placeholder="Single Unit">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fas fa-envelope-open-text"></i>
                                    </span>
                                    <input value="<?php echo  ($product['description']) ?>" type="text"
                                        class="form-control" name="description" placeholder="Description">
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
                                       <i class="far fa-clock"></i>
                                    </span>
                                    <input value="<?php echo  ($product['delieveryTime']) ?>" type="text"
                                        class="form-control" name="delieveryTime" placeholder="Delivery Time">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                       <i class="fas fa-shipping-fast"></i>
                                    </span>
                                    <input value="<?php echo  ($product['freeShipping']) ?>" type="text"
                                        class="form-control" name="freeShipping" placeholder="Free Shipping">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- For product values and units-->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                       <i class="glyphicon glyphicon-pencil"></i>
                                    </span>
                                    <input value="<?php echo  ($product['singleValue']) ?>" type="text"
                                        class="form-control" name="singleValue" placeholder="Pcs per product">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                       <i class="glyphicon glyphicon-pencil"></i>
                                    </span>
                                    <input value="<?php echo  ($product['singleUnits']) ?>" type="text"
                                        class="form-control" name="singleUnits" placeholder="Product Units Gallons kilos etc">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- For Review link -->
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class=" fab fa-youtube "></i>
                                    </span>
                                    <input value="<?php echo  ($product['reviewLink']) ?>" type="text"
                                        class="form-control" name="reviewLink" placeholder="Youtube Review">
                                </div>
                            </div>
                        </div>
                        <button type="submit" name="product" class="update btn btn-primary">Update</button>
                        <a href="product.php" class="cancel update btn btn-danger">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once('layouts/footer.php'); ?>