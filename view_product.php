<?php
  $page_title = 'View product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(2);
?>
<?php
$product = find_by_id('products',(int)$_GET['id']);
$all_categories = find_all('categories');
$all_photo = find_all('media');
$products = join_product_table();
$user = current_user();
$cat_name='';
foreach ($all_categories as $cat):
    if($product['categorie_id'] === $cat['id']): $cat_name=($cat['name']);
    endif;
    endforeach;
if(!$product){
  $session->msg("d","Missing product id.");
  redirect('product.php');
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
                <span><?php echo ($product['name']); ?> Details </span>
            </strong>
        </div>
        <div class="panel-body">
            <div class="col-md-6">

                <table class="item-table table">
                    <thead >
                    <tr >
                        <th></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody id="product-table-body " >

                        <tr>
                            <td>

                                <?php if($product['media_id'] === '0'): ?>
                                    <img src="uploads/products/no_image.jpg" alt="">
                                <?php else: ?>
                                    <img src="uploads/products/<?php echo $product['image']; ?>" onerror="this.onerror=null;
                                    this.src='no_image.jpg'" alt="">
                                <?php endif; ?>
                            </td>
                            <td class="wide">
                                Purchase Type: <?php echo remove_junk($product['purchaseType']); ?> <br>
                                Category: <?php echo $cat_name; ?> <br>
                                SubType: <?php if (!empty($product['subType'])): echo $product['subType']; else: echo"None"; endif;?> <br>
                                Eh: <?php echo remove_junk($product['singleValue']."  ". $product['singleUnits']); ?>

                                <?php if(empty($product['singleValue'] && $product['buy_price'])) :?>
                                    N/A
                                <?php else: ?>
                                    $<?php echo $product['buy_price'] / $product['singleValue']; ?>.00

                                <?php endif; ?>

                                <?php echo remove_junk($product['quantity']); ?>

                                $<?php echo remove_junk($product['buy_price']); ?>
                                <br>
                                <?php if(empty ($product["itemLink"]) || $product['itemLink']=="N/A") :?>
                                    No Link
                                <?php else: ?>
                                    <i class="fas fa-external-link-alt link"></i>
                                    <a target='_blank' href="<?php echo $product['itemLink']; ?>"> Click here to view Item Link</a>
                                <?php endif; ?>
                                <br>
                                <?php if(empty ($product["reviewLink"])|| $product['reviewLink']=="N/A") :?>
                                    No Link
                                <?php else: ?>
                                    <i class="rlink fab fa-youtube "></i>
                                    <a target='_blank' href="<?php echo  $product['reviewLink']; ?>">Click here to veiw a Review of the Item</a>
                                <?php endif; ?>

                                </br>
                                Company Info: <?php echo $product['company']; ?>
                                <?php if(empty ($product["website"])|| $product['website']=="N/A") :?>
                                    No Link
                                <?php else: ?>
                                    <i class="fas fa-external-link-alt link"></i><a target='_blank'
                                    href="<?php echo $product['website']; ?>">Website</a>
                                <?php endif; ?>
                                <?php echo remove_junk($product['city']); ?>
                                <?php echo remove_junk($product['zipcode']); ?>
                                <?php echo remove_junk($product['phone']); ?>
                                <br>
                                <?php if($user["user_level"] == 1) :?>
                                    <button onclick="copyToClipboard(<?php echo (int)$product['id'];?>); return false;"
                                            class="btn btn-success" title="Share" data-toggle="tooltip">Copy Product Link
                                    </button>
                                    <a href="product.php" class="cancel btn btn-danger">Back to all Products</a>
                                <?php endif; ?>
                            </td>
                        </tr>


                    </tbody>
                </table>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function copyToClipboard(text) {
        var dummy = document.createElement("textarea");
        document.body.appendChild(dummy);
        dummy.value = "localhost:8000/view_product.php?id=" + text;
        dummy.select();
        document.execCommand("copy");
        document.body.removeChild(dummy);
    }
</script>

<?php include_once('layouts/footer.php'); ?>