<?php
  $page_title = 'All Product';
  require_once('includes/load.php');


  // Checkin What level user has permission to view this page
   page_require_level(false);
    //$products = join_product_table();
    $products = join_product_table_wstock();
    $user = current_user();
?>

<?php
  define("SEARCH_FORM_NAME", "searchText");
  
  if($_POST){
    $searchText = $_POST[SEARCH_FORM_NAME];
    if(!empty($searchText)){
      
    }
    echo json_encode($products);
  }
?>

<?php if(!$_POST): ?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); ?>

    </div>
    <div class="col-md-12">
        <div class="panel panel-default">

            <!-- <div class="panel-heading clearfix">
                <div class="header-product-search-container">
                    <input type="text" id="product-search-input" class="form-control header-product-search"
                        placeholder="Search" />
                </div>
                <?php if($user["user_level"] == '1'): ?><div class="pull-right">
                    <a href="add_product.php" class="btn btn-primary">Add New</a>
                </div><?php endif; ?>
            </div> -->
            <div class="panel-body product-panel">
                <!--
                <form>
                    <input type="checkbox" id="something" name="hide" autocomplete="on">
                    <label for="something">Hide Out of Stock Products </label>
                </form> -->
                <table class="table table-bordered" id="productTable">
                    <thead>
                        <tr>
                            <th class="text-center" style="width: 3%;">#</th>
                            <th> Photo</th>
                            <th> ProductType</th>
                            <th> Product Title </th>
                            <th class="text-center" style="width: 20%;">Type</th>
                            <th class="text-center" style="width: 20%;"> SubType </th>
                            <th class="text-center" style="width: 20%;"> Pcs. per product </th>
                            <th class="text-center" style="width: 20%;"> Price Per piece</th>
                            <th class="text-center" style="width: 20%;"> No. of products in stock </th>
                            <th class="text-center" style="width: 20%;"> Price </th>
                            <th class="text-center" style="width: 50%;"> Product Added </th>
                            <th class="text-center" style="width: 20%;"> Item Link </th>
                            <th class="text-center" style="width: 20%;"> Review Link </th>
                            <th class="text-center" style="width: 20%;"> Company </th>
                            <th class="text-center" style="width: 20%;"> Website </th>
                            <th class="text-center" style="width: 20%;"> City </th>
                            <th class="text-center" style="width: 20%;"> ZipCode </th>
                            <th class="text-center" style="width: 20%;"> Phone </th>
                            <th class="text-center" style="width: 100px;"> Actions </th>
                        </tr>
                    </thead>
                    <tbody id="product-table-body">
                        <?php foreach ($products as $product):?>
                        <tr>
                            <td class="text-center"><?php echo count_id();?></td>
                            <td>
                                <?php if($product['media_id'] === '0'): ?>
                                <img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt="">
                                <?php else: ?>
                                <img class="img-avatar img-circle"
                                    src="uploads/products/<?php echo $product['image']; ?>" onerror="this.onerror=null;
                                    this.src='uploads/products/no_image.jpg'" alt="">
                                <?php endif; ?>
                            </td>
                            <td> <?php echo remove_junk($product['purchaseType']); ?></td>
                            <td> <?php echo remove_junk($product['name']); ?></td>
                            <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                            <td class="text-center"> <?php echo $product['subType']; ?></td>
                            <td class="text-center">
                                                <?php echo remove_junk($product['singleValue']."  ". $product['singleUnits']); ?>
                                            </td>
                                         
                                          
                                            <td class="text-center">
                                                <?php if(empty($product['singleValue'] && $product['buy_price'])) :?>
                                                    N/A
                                                    <?php else: ?>
                                                <?php $price=bcdiv($product['buy_price'] / $product['singleValue'],1,2)?>
                                                $<?php echo $price; ?>

                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center"> <?php echo remove_junk($product['quantity']); ?>
                                            </td>
                                            <td class="text-center"> $<?php echo remove_junk($product['buy_price']); ?>
                                            </td>
                            <td class="text-center"> <?php echo read_date($product['date']); ?></td>

                            <td class="text-center">
                                <?php if(empty ($product["itemLink"]) || $product['itemLink']=="N/A") :?>
                                No Link
                                <?php else: ?>
                                <i class="fas fa-external-link-alt link"></i>
                                 <a target='_blank' href="<?php echo $product['itemLink']; ?>"> Item Link</a>
                                <?php endif; ?>
                            </td>

                            <td class="text-center">
                                <?php if(empty ($product["reviewLink"])|| $product['reviewLink']=="N/A") :?>
                                No Link
                                <?php else: ?>
                                <i class="rlink fab fa-youtube "></i>
                                <a target='_blank' href="<?php echo  $product['reviewLink']; ?>">Review Link</a>
                                <?php endif; ?>
                            </td>

                            <td class="text-center"> <?php echo $product['company']; ?></td>

                            <td class="text-center">
                                <?php if(empty ($product["website"])|| $product['website']=="N/A") :?>
                                No Link 
                                <?php else: ?>
                                <i class="fas fa-external-link-alt link"></i><a target='_blank'
                                    href="<?php echo $product['website']; ?>">Website</a>
                                <?php endif; ?>
                            </td>

                            <td class="text-center"> <?php echo remove_junk($product['city']); ?></td>
                            <td class="text-center"> <?php echo remove_junk($product['zipcode']); ?></td>
                            <?php if(empty ($product["phone"])||strpos($product['phone'], 'N') !== false):?>
                                <td class="text-center">N/A </td>
                            <?php else: ?>
                                <td class="text-center"><a href="tel:<?php echo remove_junk($product['phone']); ?>">
                                        <?php echo remove_junk($product['phone']); ?></a> </td>
                            <?php endif; ?>
                            <td class="text-center">
                                <?php if($user["user_level"] == 1) :?><div class="btn-group">
                                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>"
                                        class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>"
                                        class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </div><?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function() {
           // $('#productTable').DataTable();
        $('#productTable').DataTable( {
            "scrollX": true,
            "scrollY": '60vh',
            "scrollCollapse": false,
            "paging": true
        } );
    });

 var productColumns = ["id", "subType", "name", "quantity", "buy_price", "sale_price", "media_id",
                    "date",
                    "description",
                    "singleUnit", "singleUnits", "singleValue", "itemLink", "reviewLink", "city", "email", "phone", "zipcode", "freeShipping",
                    "company",
                    "website",
                    "purchaseType", "categorie", "image,"
                ];

                var tableColumns = ["#", "Photo", "ProductType", "Product Title", "Type", "SubType", "Pcs. per case", "Price per case",
                    "No. of cases in stock", "Price",
                    "Product Added", "Item Link", "Review Link", "Company", "Website", "City", "ZipCode", "Phone"
                ];

                var tableProductColMap = new Map();
                tableProductColMap.set("#", false);
                tableProductColMap.set("Photo", "image");
                tableProductColMap.set("ProductType", "purchaseType");
                tableProductColMap.set("Product Title", "name");
                tableProductColMap.set("Type", "categorie");
                tableProductColMap.set("SubType", "subType");
                tableProductColMap.set("Pcs. per product", "singleValue . singleUnits");
                tableProductColMap.set("Price per product", "singleValue / buy_price");
                tableProductColMap.set("No. of products in stock", "quantity");
                tableProductColMap.set("Price", "sale_price");
                tableProductColMap.set("Product Added", "date");
                tableProductColMap.set("Item Link", "itemLink");
                tableProductColMap.set("Review Link", "reviewLink");
                tableProductColMap.set("Company", "company");
                tableProductColMap.set("Website", "website");
                tableProductColMap.set("City", "city");
                tableProductColMap.set("ZipCode", "zipcode");
                tableProductColMap.set("Phone", "phone");
tableProductColMap.set("Actions", false);

window.productColumns = productColumns;

let hideOutStock = false;

function generateTableData(products) {
    let productTableBody = document.getElementById("product-table-body");
    if (productTableBody && Array.isArray(products)) {
        productTableBody.innerHTML = "";

             let tableRows = ``;
            products.forEach((p, index, arr) => {
                console.log(p[productColumns.findIndex((c) => c === "name")]);

                let row = `<tr>`;

                tableColumns.forEach((tCol, i) => {

                    const productCol = tableProductColMap.get(tCol);
                    console.log()
                    if (productCol) {
                        if (productCol === "itemLink") {
                            row +=
                                `<td> <i class="fas fa-external-link-alt link"></i> <a target = '_blank' href="${p[productColumns.findIndex((c) => c === productCol)]}">Item Link</a></td>`;
                        } else if (productCol === "website") {
                            row +=
                                `<td> <i class="fas fa-external-link-alt link"></i> <a target = '_blank' href="${p[productColumns.findIndex((c) => c === productCol)]}">Website</a></td>`;
                        } else if (productCol ===
                            "reviewLink") {
                            row +=
                                `<td> <i class="rlink fab fa-youtube "> </i> <a target = '_blank' href="${p[productColumns.findIndex((c) => c === productCol)]}">Review Link</a></td>`;
                        } else if (productCol === "image") {
                            let image_url = p[productColumns.findIndex((c) => c === "image")];

                            if (image_url) {
                                row +=
                                    `<td><img class="img-avatar img-circle" src="uploads/products/${image_url}" alt=""></td>`;
                            } else {
                                row +=
                                    `<td><img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt=""></td>`;
                            }
                        } else {
                            row += `<td>${p[productColumns.findIndex((c) => c === productCol)] || ""}</td>`
                        }

                    } else if (tCol === "#") {
                        row += `<td>${index + 1}</td>`
                    }
                    else if (tCol === "Pcs. per product") {
                        row += `<td>pcs per product</td>`
                    }else if (tCol === "Actions") {
                        row += `<td> <?php if($user["user_level"] == 1) :?><div class="btn-group">
                    <a href="edit_product.php?id=${p[productColumns.findIndex((c) => c === "id")]}" class="btn btn-info btn-xs"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=${p[productColumns.findIndex((c) => c === "id")]}" class="btn btn-danger btn-xs"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
              </div><?php endif; ?></td>`
                    }
                });

                row += `</tr>`;
                // console.log(`col`, col);
                tableRows += row;
            }, window);
            productTableBody.innerHTML += tableRows;

    }
}

async function filterProduct(e) {
    let text = e.target.value;
    var http = new XMLHttpRequest();
    var data = "searchText=" + text;

    http.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            try {
                let products = JSON.parse(this.responseText);

                if (Array.isArray(products)) {

                    products = products.filter((p) => {

                        try {
                            const regex = new RegExp(`${text}`, "gi");
                            for (let tCol of tableColumns) {
                                let pCol = tableProductColMap.get(tCol);
                                if (pCol) {
                                    console.log(p[productColumns.findIndex((c) => c === pCol)]);
                                    let matches = (p[productColumns.findIndex((c) => c === pCol)] || "")
                                        .toString().match(regex);

                                    if (matches) {
                                        return true;
                                    }
                                }
                            }
                        } catch (e) {
                            console.log(e);
                            return true;
                        }



                        return false;
                    })
                    generateTableData(products);
                }
                } catch (e) {
                console.log(e)
            }
        }
    }
    console.log(window.location);
    http.open('POST', window.location.href, true);
    http.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    http.send(data);

}


var search_input = document.getElementById("product-search-input");
if (search_input) {
    search_input.addEventListener("input", filterProduct);
}

<<<<<<< HEAD
;

=======
/*
$('input[name=hide]').change(async function(){
    if($(this).is(':checked')) {
       hideOutStock =true;
       <?php $hide = true; ?>
       console.log("What??")
        var jArray = <?php echo json_encode($products); ?>;
        var f =[];
        for(var i=225; i<jArray.length; i++){
            let n = parseInt(jArray[i].quantity);
        if (n===0){
                f.push(jArray[i]);
            }

        generateTableData(f);

    }}
        else {
        hideOutStock =false;
        jArray = <?php echo json_encode($products); ?>;
        generateTableData(jArray);
    }
});
*/
>>>>>>> 4d99e8d0be5c083c0d6fe0aab5a8674ddf12f49f

</script>
<?php include_once('layouts/footer.php'); ?>
<?php endif ?>
