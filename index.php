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
<h2 class="title">Explore by category<span>.</span></h2>
<h3 class="sub-title"> Compare prices and inventory of US PPE supplies </h3>
</div>
<div class = "cards">

    <?php foreach ($categories as $cat):?>
        <div class="col">
            <?php if ($cat['has_subcat']):?>
            <a href="displayall.php?key=<?php echo $cat['name']; ?>">
                <?php else: ?>
                <a href="display.php?key=<?php echo $cat['name']; ?>">
                    <?php endif ?>
                    <div class="card" >
                        <div class = "card-body">
                            <div class = "display">
                        <img class="card-img-top" src="libs/images/<?php echo $cat['image'] ?>" alt="..." >
                </div>
                </div>
                    </div>
                </a>
        </div>
    <?php endforeach; ?>
</div>
<div>
    <a href="./display.php" class="btn btn-back " style="float: right; margin: 30px; ">
        View All Products</a>
</div>

<?php include_once('layouts/footer.php'); ?>
<?php endif; ?>

