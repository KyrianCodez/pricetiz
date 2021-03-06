<?php
  $page_title = 'Add Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_photo = find_all('media');
?>
<?php
 if(isset($_POST['add_product'])){
   $req_fields = array('product-title','product-categorie','product-quantity','buying-price', 'saleing-price',
                       'itemLink','freeShipping','company','website','city',
                      'zipcode','description','purchaseType' ,'singleUnits', 'singleValue');
   validate_fields($req_fields);
   if(empty($errors)){
     $p_name  =  ($db->escape($_POST['product-title']));
     $p_cat   =  ($db->escape($_POST['product-categorie']));
     $p_qty   =  ($db->escape($_POST['product-quantity']));
     $p_buy   =  ($db->escape($_POST['buying-price']));
     $p_sale  =  ($db->escape($_POST['saleing-price']));
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
     $singleUnits=  ($db->escape($_POST['singleUnits']));
     $singleValue =  ($db->escape($_POST['singleValue']));
     
     if (is_null($_POST['product-photo']) || $_POST['product-photo'] === "") {
       $media_id = '0';
     } else {
       $media_id =  ($db->escape($_POST['product-photo']));
     }
     $date    = make_date();
     $query  = "INSERT INTO products (";
     $query .="name,quantity,buy_price,sale_price,categorie_id,media_id,date,itemLink,reviewLink,city,zipcode,phone,email,delieveryTime,freeShipping,company,website,description,purchaseType,singleUnits,singleValue";
     $query .=") VALUES (";
     $query .="'{$p_name}', '{$p_qty}', '{$p_buy}', '{$p_sale}', '{$p_cat}', '{$media_id}', '{$date}', '{$itemLink}', '{$reviewLink}','{$city}', '{$zipcode}', '{$phone}', '{$email}', '{$delieveryTime}', '{$freeShipping}', '{$company}', '{$website}', '{$description}', '{$purchaseType}', '{$singleUnits}', '{$singleValue}'";
     $query .=")";
     $query .=" ON DUPLICATE KEY UPDATE name='{$p_name}'";
     if($db->query($query)){
       $session->msg('s',"Product added ");
       redirect('add_product.php', false);
     } else {
       $session->msg('d',' Sorry failed to added!');
       redirect('product.php', false);
     }

   } else{
     $session->msg("d", $errors);
     redirect('add_product.php',false);
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
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>
                    <span class="glyphicon glyphicon-th"></span>
                    <span>Add New Product</span>
                </strong>
            </div>
            <div class="panel-body">
                <div class="col-md-12">
                    <form method="post" action="add_product.php" class="clearfix">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="glyphicon glyphicon-th-large"></i>
                                </span>
                                <input type="text" class="form-control" name="product-title"
                                    placeholder="Product Title">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <select class="form-control" name="product-categorie">
                                        <option value="">Select Product Category</option>
                                        <?php  foreach ($all_categories as $cat): ?>
                                        <option value="<?php echo (int)$cat['id'] ?>">
                                            <?php echo $cat['name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select class="form-control" name="product-photo">
                                        <option value="">Select Product Photo</option>
                                        <?php  foreach ($all_photo as $photo): ?>
                                        <option value="<?php echo (int)$photo['id'] ?>">
                                            <?php echo $photo['file_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </span>
                                        <input type="number" class="form-control" name="product-quantity"
                                            placeholder="Product Quantity">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-usd"></i>
                                        </span>
                                        <input type="number" step="0.01" min="0" class="form-control"
                                            name="buying-price" placeholder="Buying Price">
                                        <!-- <span class="input-group-addon">.00</span> -->
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-usd"></i>
                                        </span>
                                        <input type="number" step="0.01" min="0" class="form-control"
                                            name="saleing-price" placeholder="Selling Price">
                                        <!-- <span class="input-group-addon">.00</span> -->
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
                                        <input type="text" class="form-control" name="purchaseType"
                                            placeholder="Product Type">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-link"></i>
                                        </span>
                                        <input type="text" class="form-control" name="itemLink" placeholder="Item Link">
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
                                        <input type="text" class="form-control" name="company" placeholder="Company">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-phone"></i>
                                        </span>
                                        <input type="text" class="form-control" name="phone" placeholder="Phone">
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
                                        <input type="email" class="form-control" name="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-link"></i>
                                        </span>
                                        <input type="text" class="form-control" name="website" placeholder="Website">
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
                                        <input type="text" class="form-control" name="city" placeholder="City">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-map-marker"></i>
                                        </span>
                                        <input type="text" class="form-control" name="zipcode" placeholder="Zip Code">
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
                                            <i class="fas fa-envelope-open-text"></i>
                                        </span>
                                        <input type="text" class="form-control" name="description"
                                            placeholder="Description">
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
                                        <input type="text" class="form-control" name="delieveryTime"
                                            placeholder="Delivery Time">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fas fa-shipping-fast"></i>
                                        </span>
                                        <input type="text" class="form-control" name="freeShipping"
                                            placeholder="Free Shipping">
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                             <i class="glyphicon glyphicon-pencil"></i>
                                        </span>
                                        <input type="text" class="form-control" name="singleValue"
                                            placeholder="Number of pieces ">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </span>
                                        <input type="text" class="form-control" name="singleUnits"
                                            placeholder="Gallons, kilograms, pcs etc.">
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
                                            <input type="text" class="form-control" name="reviewLink" placeholder="Youtube Review">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="add_product" class="update btn btn-primary">Add product</button>
                            <a href="product.php" class="cancel update btn btn-danger">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once('layouts/legacyfooter.php'); ?>