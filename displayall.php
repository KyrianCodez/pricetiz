<?php
ob_start();

$page_title = 'All Products - Pricetize';
require_once('includes/load.php');
$categories = combineCats();


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

<?php require_once('./includes/navbar.php')?>
<!--                     onerror="this.onerror=null; this.src='uploads/products/new_no_image.jpg'"-->
<div id= "modal-card">
<div  class="modal-header m-header">
        <div class = "display">
            <?php foreach ($categories as $cat):?>
                <?php if($key === $cat['name']):?>
                        <img class="card-image " src="./uploads/categories/<?php echo $cat['file_name'] ?>" alt="..." >
                <?php else:?>
                <?php endif;?>
                <?php endforeach;?>
                </div>
               <div class = "cat-name" style= "padding:0;">
                   <div class = "name-center">
                    <?php echo $key; ?>
    </div>
                </div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
<div class="cards m-card-content" >

    <?php foreach ($subs as $sub):?>
        <div class="col m-col">
            
            <div class="card  m-card-body" >
              
                <div class="card-body m-stylin">
                    <?php $sub_name = str_replace($key,'',$sub['name']);
                    $sub_name = preg_replace('/[^\p{L}\p{N}\s]/u', '', $sub_name);
                    $subbed = $sub['name'];
?>      
                    <p class="card-text"> <?php echo  $sub_name?></p>
                    <a class="arrow noDecoration" href="product-cat.php?key=<?php echo $sub_name;
 ?>"><img class="arrow-style" src="./libs/images/arrow.svg" alt="..." ></a>
                </div>
            </div>
           
        </div>
    <?php endforeach; ?>
    

      </div>
      <div class="m-footer">
        <div class="view-btn-wrapper">
    <a href="./product-cat.php?key=<?php echo preg_replace('/\s+/', '%20', $key);
 ?>" class="viewall-btn-wrapper">
        View All</a>
</div>
</div>
    </div>
<?php include_once('layouts/footer.php'); ?>
<?php endif; ?>

