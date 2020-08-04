<?php
ob_start();

$page_title = 'Products by Category - Pricetize';
require_once('includes/load.php');


// Checkin What level user has permission to view this page
page_require_level(false);
//$products = join_product_table();
$products = join_product_table_wstock();
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        <?php if (!empty($page_title)) {
            echo  ($page_title);
        } elseif (!empty($user)) {
            echo ucfirst($user['name']);
        } else {
            echo "Simple inventory System";
        }
        ?>

    </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://kit.fontawesome.com/eb9107ad61.js" crossorigin="anonymous"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js" defer></script>
    <script src="https://unpkg.com/codyhouse-framework/main/assets/js/util.js"></script>

    <link rel="stylesheet" href="libs/css/main2.css?<?php echo time(); ?>" />
</head>

<body/>

<div class = "cards">

    <?php foreach ($categories as $cat):?>
        <div class="col">
            <?php if ($cat['has_subcat']):?>
            <a href="displayall.php?key=<?php echo $cat['name']; ?>">
                <?php else: ?>
                <a href="display.php?key=<?php echo $cat['name']; ?>">
                    <?php endif ?>
                    <div class="card" >
                        <img class="display card-img-top" src="libs/images/<?php echo $cat['image'] ?>" alt="..." >
                    </div>
                </a>
        </div>
    <?php endforeach; ?>
</div>
<div>
    <a href="/display.php" class="btn btn-back " style="float: right; margin: 30px; ">
        View All Products</a>
</div>


<?php include_once('layouts/footer.php'); ?>
<?php endif; ?>

