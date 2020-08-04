<?php
ob_start();

$page_title = 'All Products - Pricetize';
require_once('includes/load.php');


// Checkin What level user has permission to view this page
page_require_level(false);
$notifications = join_notification_table();

//  session_start();

$is_tracked = $_SESSION["TRACKED"];
//$is_tracked_txt = $is_tracked?"yes":"not yet";
$session_id = session_id();
//echo "is tracked? $is_tracked_txt<br>";
//  echo "session id: $session_id<br>";
$key = $_GET['key'];
$key = remove_junk($key);
$subs = get_subCats($key);
$one = $subs[0];

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

<body >

<!--                     onerror="this.onerror=null; this.src='uploads/products/new_no_image.jpg'"-->
<div class="cards">

    <?php foreach ($subs as $sub):?>
        <div class="col">
            <a href="display.php?key=<?php echo $sub['name']; ?>">
            <div class="card" >
                <img class="display" src="libs/images/<?php echo $sub['image']; ?>"
                     onerror="this.onerror=null; this.src='uploads/products/new_no_image.jpg'"
                     title="<?php echo $sub['name']; ?>" alt="Category Image" >
                <div class="card-body">
                    <p class="card-text"> <?php echo $sub['name']; ?></p>
                </div>
            </div>
            </a>
        </div>
    <?php endforeach; ?>
    <div class="col">
        <a href="display.php?key=<?php echo $key; ?>">
            <div class="card" >
                <img class="display" src="libs/images/<?php echo $one['image']; ?>"
                     onerror="this.onerror=null; this.src='uploads/products/new_no_image.jpg'"
                     title="<?php echo $key; ?>" alt="Category Image" >
                <div class="card-body">
                    <p class="card-text"> <?php echo $key."  -  Assorted"; ?></p>
                </div>
            </div>
        </a>
    </div>
        </div>
<div>

        <a href="index.php" class="btn btn-back" style="margin-top: 30px; margin-left: 15px;">Back to all Categories</a>


</div>

<?php include_once('layouts/footer.php'); ?>
<?php endif; ?>

