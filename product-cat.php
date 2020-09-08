<?php
ob_start();


$page_title = 'All Products - Pricetize';
require_once('includes/load.php');

// Checkin What level user has permission to view this page
page_require_level(false);
//$products = join_product_table();








$option = 25;
list($filter_results) = setFilterTag($option);
list($results_per_page, $this_page_fresult, $page, $number_of_pages) = pagination($filter_results);

$products =  join_product_table_wstock($this_page_fresult, $results_per_page);
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
<div class = "title-wrapper">
<div class = "p-title">
<div class = "title-card">
<h2 class="title">Product List<span>.</span></h2>
</div>
<input type="text" id="product-search-input" placeholder="Search" title="Type in a name">
 <a href="./display.php" id = "clear" class="btn btn-chat " style="display: none; margin-bottom: 5px;">
                        Clear results</a>
<div class="card-wrapper">

<div class="card pagination-card">

   
   
    
</div>
</div>
  
 </div> <!-- filter-options -->
    </div>
<div id="card-table">


    
</div>


<script>
//displays data

  buildTable()

//         $('#product-search-input').on('input',   function() {
//             var value = $(this).val()
//             value = $(this).val()


//         buildTable()     
            
// console.log("value:", value)
//   })
function s() {
    var input, filter, table, tr, td, i, txtValue;

  input = "<?php echo $key ?>";
  
  filter = input.toUpperCase();
  table = $("#card-table");
  tr = $(".product-card");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByClassName("name")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }       
  }
                    }
 
                    s();
      

//  function searchTable(value, data) {
//     var filterProducts = []
//     console.log("filter:", filterProducts)
//     <?php
//     foreach ($products as $product):?>
//     value = value.toLowerCase()
//     var name = "<?php /* echo $product['name'] */?>".toLowerCase()
//         if(name.includes(value)){
//             filterProducts.push("<?php /* echo $product['name'] */?>")
//         }
//     <?php /* endforeach; */?>
//     return filterProducts
// }


async function buildTable() {
    var table = document.getElementById('card-table')
    table.innerHTML =''

    <?php foreach ($products as $product): ?>
   
    var codeblock = `<div class="card product-card">
     <div class="card-body product-body">

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
            <div class="category"><?php echo remove_junk($product['categorie']); ?> </div>
            </br>
            <div class="name"> <?php echo remove_junk($product['name']); ?> </div>
            </br>
            <div class="type"> <?php echo remove_junk($product['purchaseType']); ?> </div>
        </div>
        <div class="bestClass-wrapper">
            <div class="center">
                <?php if ($product['id'] === $best_deal_arr[$product['categorie_id']]) {
    echo "<img class='bestClass img-circle blinking' src = './uploads/products/bestClass.png'>";}
?>
            </div>
        </div>
<div class="product-details-wrapper">
    <div class="inner-wrapper num-per">
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
     <div class="inner-wrapper price-per">
         <div class="values">
     $<?php calculatePrice($product, $all_categories);?>
</div>
</br>
     <p class = "units">PER PIECE</p>
</div>
<div class="inner-wrapper quan-per">
    <div class="values">
        <?php echo ($product['quantity']); ?>
</div>
</br>
<p class = "units">IN STOCK</p>

</div>
<div class="inner-wrapper buyprice-per">
    <p class = "units">PRICE</p>
    </br>
    <div class="values buyPrice">
        $<?php echo ($product['buy_price']); ?>
</div>



</div>

</div>

<div class="purchase-details-wrapper">
    <div class="company-details">
        <div>
        <?php echo $product['company']; ?>
</div>

  <div class="units">
        <?php if (empty($product['city']) || $product['city'] === "NA"):
    echo "No Address found";
else:

    echo ($product['city'] . "  " . $product['zipcode']);
endif;?>
</div>
    </br>
<div class="units">
    <?php if (empty($product['phone']) || $product['phone'] === "N/A"):
    echo "No contact found";
elseif ($product['phone'] === "NA"):
    echo "No contact found";
else:
    echo $product['phone'];
endif;?>
    </div>
    </div>
    <div class="product-panel">
        <div class="spacing top">
        <?php if (empty($product["website"]) || $product['website'] === "N/A"): ?>
                                                    No Link
                                                <?php else: ?>
                                                        <a target='_blank' class="website-details" href="<?php echo $product['website']; ?>">Company Website</a>
                                                <?php endif;?>
                                                </div>
<div class="review-details spacing">
    <?php if (empty($product["reviewLink"]) || $product['reviewLink'] === "N/A"): ?>
                                                    No Link Added
                                                <?php else: ?>

                                                    <a target='_blank' class="review-details"  href="<?php echo $product['reviewLink']; ?>">Review
                                                        Link</a>
                                                <?php endif;?>
                                                </div>

                                                <div class="spacing">
                                                    <?php if (empty($product["itemLink"]) || $product['itemLink'] === "N/A"): ?>
                                                    No Link Added
                                                <?php else: ?>



                                                    <a target='_blank' class="purchase-button" href="<?php echo $product['itemLink']; ?>">Purchase</a>
                                                <?php endif;?>
                                                </div>
                                                </div>


</div>
</div>


</div>`
 table.innerHTML += codeblock
<?php endforeach;?>
    
}

    </script>


                                                



<?php include_once('layouts/footer.php');?>
<?php endif;?>