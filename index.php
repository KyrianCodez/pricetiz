<?php
ob_start();
  $page_title = 'All Product';
  require_once('includes/load.php');
  require_once('includes/sql.php');
  
  


  // Checkin What level user has permission to view this page
   page_require_level(false);
  $products = join_product_table();
  $notifications = join_notification_table();

 session_start(["name" => "visit", "cookie_lifetime" => 0]);
  
//   $is_tracked = $_SESSION["TRACKED"];
//   $is_tracked_txt = $is_tracked?"yes":"not yet";
//   $session_id = session_id();
// //   echo "is tracked? $is_tracked_txt<br>";
// //   echo "session id: $session_id<br>";
  
//   $user_ip = $_SERVER["REMOTE_ADDR"];
//   if(!$is_tracked){
//     if(trackVisit($session_id, $user_ip)){
//         $_SESSION["TRACKED"] = true;
//         // echo "visit tracked<br>";
//     };
//   }else{
//     //   echo "visit tracked previously<br>";
//   }

//   $stats = getVisitCount();
//   echo "Number of visits: " . $stats["0"]["visits"];
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
        <?php if (!empty($page_title)) {
    echo remove_junk($page_title);
} elseif (!empty($user)) {
    echo ucfirst($user['name']);
} else {
    echo "Simple inventory System";
}
?>

    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://kit.fontawesome.com/eb9107ad61.js" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="libs/css/main.css?<?php echo time(); /* appended to disable browser caching css file remove for release*/ ?>" />
</head>

<body>
    <div class="demopage">
    
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <?php echo display_msg($msg); ?>
                    <?php
if (isset($notifications[0]['type'])) {


    if ($notifications[0]['type'] === 'PSA') {
      

        $session->msg('s', "".$notifications[0]['messageContent']);
        


    } else {
        

        return "";
    }

} else {

    return "";
}
?>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading clearfix">
                            <!-- <div class="header-product-search-container">
                                <input type="text" id="product-search-input" class="form-control header-product-search"
                                    placeholder="Search" />
                            </div>
                        </div> -->
                            <div class="panel-body">
                                <table class="table table-bordered" id="productTable">
                                    <thead>
                                        <tr class="sticky-header">
                                            <th class="text-center" style="width: 3%;">#</th>
                                            <th> Photo</th>
                                            <th> ProductType</th>
                                            <th> Product Title </th>
                                            <th class="text-center" style="width: 20%;">Type</th>
                                            <th class="text-center" style="width: 20%;"> SubType </th>
                                            <th class="text-center" style="width: 20%;"> Pcs. per product </th>
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
                                        </tr>
                                    </thead>
                                    <tbody id="product-table-body">
                                        <?php foreach ($products as $product):?>
                                        <tr>
                                            <td class="text-center"><?php echo count_id();?></td>
                                            <td>
                                                <?php if($product['media_id'] === '0'): ?>
                                                <img class="img-avatar img-circle" src="uploads/products/no_image.jpg"
                                                    alt="">
                                                <?php else: ?>
                                                <img class="img-avatar img-circle"
                                                    src="uploads/products/<?php echo $product['image']; ?>" alt="">
                                                <?php endif; ?>
                                            </td>
                                            <td> <?php echo remove_junk($product['purchaseType']); ?></td>
                                            <td> <?php echo remove_junk($product['name']); ?></td>
                                            <td class="text-center"> <?php echo remove_junk($product['categorie']); ?>
                                            </td>
                                            <td class="text-center"> <?php echo $product['subType']; ?></td>
                                            <td class="text-center"> <?php echo remove_junk($product['singleUnit']); ?>
                                            </td>
                                            <td class="text-center"> <?php echo remove_junk($product['quantity']); ?>
                                            </td>
                                            <td class="text-center"> $<?php echo remove_junk($product['buy_price']); ?>
                                            </td>
                                            <td class="text-center"> <?php echo read_date($product['date']); ?></td>

                                            <td class="text-center">
                                                <?php if(empty ($product["itemLink"])) :?>
                                                No Link
                                                <?php else: ?>
                                                <i class="fas fa-external-link-alt link"></i>
                                                <a target='_blank' href="<?php echo $product['itemLink']; ?>">Item Link</a>
                                                <?php endif; ?>
                                            </td>

                                            <td class="text-center">
                                                <?php if(empty ($product["reviewLink"])) :?>
                                                No Link
                                                <?php else: ?>
                                                <i class="rlink fab fa-youtube "></i>
                                                <a target='_blank'
                                                    href="<?php echo  $product['reviewLink']; ?>">Review Link</a>
                                                <?php endif; ?>
                                            </td>

                                            <td class="text-center"> <?php echo $product['company']; ?></td>

                                            <td class="text-center">
                                                <?php if(empty ($product["website"])) :?>
                                                No Link
                                                <?php else: ?>
                                                <i class="fas fa-external-link-alt link"></i><a target='_blank'
                                                    href="<?php echo $product['website']; ?>">Website</a>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center"> <?php echo remove_junk($product['city']); ?></td>
                                            <td class="text-center"> <?php echo remove_junk($product['zipcode']); ?>
                                            </td>
                                            <td class="text-center"> <?php echo remove_junk($product['phone']); ?></td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
                    integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs=" crossorigin="anonymous"></script>
                <link rel="stylesheet" type="text/css"
                    href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
                <script type="text/javascript" charset="utf8"
                    src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js" defer></script>

                <script type="text/javascript">
                $(document).ready(function() {
                    $('#productTable').DataTable();
                });
                var productColumns = ["id", "subType", "name", "quantity", "buy_price", "sale_price", "media_id",
                    "date",
                    "description",
                    "singleUnit", "itemLink", "reviewLink", "city", "email", "phone", "zipcode", "freeShipping",
                    "company",
                    "website",
                    "purchaseType", "categorie", "image"
                ];

                var tableColumns = ["#", "Photo", "ProductType", "Product Title", "Type", "SubType", "Pcs. per product",
                    "No. of products in stock", "Price",
                    "Product Added", "Item Link", "Review Link", "Company", "Website", "City", "ZipCode", "Phone"
                ];

                var tableProductColMap = new Map();
                tableProductColMap.set("#", false);
                tableProductColMap.set("Photo", "image");
                tableProductColMap.set("ProductType", "purchaseType");
                tableProductColMap.set("Product Title", "name");
                tableProductColMap.set("Type", "categorie");
                tableProductColMap.set("SubType", "subType");
                tableProductColMap.set("Pcs. per product", "singleUnit");
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

                window.productColumns = productColumns;

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
                                            `<td> <?php if(empty($product["itemLink"])) :?>
                                            No Link 
                                         <?php else: ?>
                                         <i class="fas fa-external-link-alt link"></i>
                                         <a target = '_blank' href="${p[productColumns.findIndex((c) => c === productCol)]}">Item Link</a> 
                                        <?php endif; ?> </td>`;
                                     } else if (productCol === "website") {
                                        row +=
                                            `<td> <?php if(empty($product["website"])) :?>
                                            No Link 
                                             <?php else: ?><i class="fas fa-external-link-alt link"></i>
                                          <a target = '_blank' href="${p[productColumns.findIndex((c) => c === productCol)]}">Website</a> 
                                <?php endif; ?> </td>`;
                                    } else if (productCol === "reviewLink") {
                                        row +=
                                            `<td> <?php if(empty($product["reviewLink"])) :?>
                                             No Link 
                                         <?php else: ?>
                                <i class="rlink fab fa-youtube "> </i>
                                 <a target = '_blank' href="${p[productColumns.findIndex((c) => c === productCol)]}">Review Link</a> <?php endif; ?> </td>`;







                                    } else if (productCol === "image") {
                                        let image_url = p[productColumns.findIndex((c) => c ===
                                            "image")];

                                        if (image_url) {
                                            row +=
                                                `<td><img class="img-avatar img-circle" src="uploads/products/${image_url}" alt=""></td>`;
                                        } else {
                                            row +=
                                                `<td><img class="img-avatar img-circle" src="uploads/products/no_image.jpg" alt=""></td>`;
                                        }
                                    } else {
                                        row +=
                                            `<td>${p[productColumns.findIndex((c) => c === productCol)] || ""}</td>`
                                    }

                                } else if (tCol === "#") {
                                    row += `<td>${index+1}</td>`
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
                                                    console.log(p[productColumns.findIndex((c) => c ===
                                                        pCol)]);
                                                    let matches = (p[productColumns.findIndex((c) =>
                                                            c ===
                                                            pCol)] || "")
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
                </script>
                <?php include_once('layouts/footer.php'); ?>
                <?php endif ?>