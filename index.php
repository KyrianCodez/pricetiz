<?php
ob_start();

$page_title = 'Products by Category - Pricetize';
require_once('includes/load.php');


// Checkin What level user has permission to view this page
page_require_level(false);
//$products = join_product_table();
list($results_per_page, $this_page_fresult, $page, $number_of_pages) = pagination();
$products = join_product_table_wstock($this_page_fresult, $results_per_page);
$notifications = join_notification_table();
$categories = combineCats();



//  session_start();

$is_tracked = $_SESSION["TRACKED"];
//$is_tracked_txt = $is_tracked?"yes":"not yet";
$session_id = session_id();
//echo "is tracked? $is_tracked_txt<br>";
//  echo "session id: $session_id<br>";

$user_ip = $_SERVER["REMOTE_ADDR"];
if(!$is_tracked){
    if(trackVisit($session_id, $user_ip)){
        $_SESSION["TRACKED"] = true;
    }
}

?>

<?php if(!$_POST): ?>

<?php require_once('./includes/navbar.php')?>
<div class="title-panel">
    <div class="title-card">
<h2 class="title">Explore by category<span>.</span></h2>
<h3 class="sub-title"> Compare prices and inventory of US PPE supplies </h3>
</div>
<div class="view-btn-wrapper">
    <a href="./display.php" class="view-products-btn">
        View All Products</a>
</div>
</div>
<div class = "">
<div class = "cards">

    <?php foreach ($categories as $cat):?>
        
            <?php if ($cat['has_subcat']):?>
            <a href="displayall.php?key=<?php echo $cat['name']; ?>">
                <?php else: ?>
                <a href="display.php?key=<?php echo $cat['name']; ?>">
                    <?php endif ?>
                    <div class="card cat-card" >
                        <div class = "card-body cat-body">
                            <div class = "display">
                        <img class="card-image " src="./uploads/categories/<?php echo $cat['file_name'] ?>" alt="..." >
                </div>
                <div class = "cat-name">
                    <?php echo $cat['name']; ?>
                </div>
                <div class = "cat-arrow">
                    <img class="arrow-img" src="./libs/images/arrow.svg" alt="..." >
                </div>

                </div>
                    </div>
                </a>
       
    <?php endforeach; ?>
</div>
                </div>


<?php include_once('layouts/footer.php'); ?>
<?php endif; ?>

