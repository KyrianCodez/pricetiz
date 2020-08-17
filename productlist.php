<?php
ob_start();
error_reporting(0);

$page_title = 'All Products - Pricetize';
require_once('includes/load.php');

// Checkin What level user has permission to view this page
page_require_level(false);
//$products = join_product_table();
$products = join_product_table_wstock();
$notifications = join_notification_table();
$all_categories = find_all('categories');
$best_deal_arr = setBestInClassFlag($all_categories);
$key = "none";
if (isset($_GET['key'])) {
    $key = $_GET['key'];
    $key = remove_junk($key);
    unset($_GET['key']);
}

//  session_start();

$is_tracked = $_SESSION["TRACKED"];
//$is_tracked_txt = $is_tracked?"yes":"not yet";
$session_id = session_id();
//echo "is tracked? $is_tracked_txt<br>";
//  echo "session id: $session_id<br>";

$user_ip = $_SERVER["REMOTE_ADDR"];
if (!$is_tracked) {
    if (trackVisit($session_id, $user_ip)) {
        $_SESSION["TRACKED"] = true;
    }
}

?>

<?php if (!$_POST): ?>


<?php require_once('./includes/navbar.php')?>
<h2 class="title">Product List<span>.</span></h2>
<?php foreach ($products as $product):?>
<div class="card product-card">
    <div class="card-body">

        <a href="view_product.php?id=<?php echo (int) $product['id']; ?>">
            <?php if ($product['media_id'] === '0'): ?>
            <img class="img-avatar" src="./uploads/products/No_Image_300x300.png" title="Click for details"
                alt="Image unavailable.">
            <?php else: ?>
            <img class="img-avatar" src="./uploads/products/<?php echo $product['image']; ?>"
                onerror="this.onerror=null; this.src='./uploads/products/No_Image_300x300.png'"
                title="Click for details" alt="Product Image.">

            <?php endif;?>
        </a>
        <div class="cat-container">
            <div class="category"><?php echo remove_junk($product['categorie']);?> </div>
            </br>
            <div class="name"> <?php echo remove_junk($product['name']); ?> </div>
            </br>
            <div class="type"> <?php echo remove_junk($product['purchaseType']); ?> </div>
        </div>
        <div class="bestClass-wrapper">
            <div class="center">
                <?php

if ($product['id'] === $best_deal_arr[$product['categorie_id']]) {
    echo "<img class='bestClass img-circle blinking' src = './uploads/products/bestClass.png'>";}
?>
            </div>
        </div>
<div class="product-details-wrapper"> 
    <div class="inner-wrapper">
    <?php
    echo "<div class='values'>";
     echo ($product['singleValue']);
     echo "</div>";
     echo "</br>";
     echo "<div class='units'>";

     echo ($product['singleUnits']); 
     echo "</div>";
?>
     
     </div>
     <div class="inner-wrapper">
         <div class="values">
     $<?php calculatePrice($product, $all_categories);?>
</div>
</br>
     <p class = "units">PER PIECE</p>
</div>
<!-- <div class="inner-wrapper">
    <div class="values">
        <?php /* echo ($product['quantity']) */; ?>
</div>
</br>
<p class = "units">IN STOCK</p>

</div> -->

</div>

<div class="purchase-details-wrapper"> 
</div>


    </div> <!-- cardbody -->
</div> <!-- card -->
<?php endforeach; ?>

</div>
<?php include_once('layouts/footer.php');?>
<?php endif;?>