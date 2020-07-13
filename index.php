<?php
ob_start();
 
  $page_title = 'All Products - Pricetize';
  require_once('includes/load.php');


  // Checkin What level user has permission to view this page
   page_require_level(false);
  //$products = join_product_table();
  $products = join_product_table_wstock();
  $notifications = join_notification_table();
  $all_categories = find_all('categories');
  $best_deal_arr = setBestInClassFlag($all_categories);
  print_r($best_deal_arr);
//  session_start();
  
  $is_tracked = $_SESSION["TRACKED"];
  $is_tracked_txt = $is_tracked?"yes":"not yet";
  $session_id = session_id();
//   echo "is tracked? $is_tracked_txt<br>";
//   echo "session id: $session_id<br>";
  
  $user_ip = $_SERVER["REMOTE_ADDR"];
  if(!$is_tracked){
    if(trackVisit($session_id, $user_ip)){
        $_SESSION["TRACKED"] = true;
        // echo "visit tracked<br>";
    };
  }else{
    //   echo "visit tracked previously<br>";
  }

  $stats = getVisitCount();
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
            echo  ($page_title);
            } elseif (!empty($user)) {
                echo ucfirst($user['name']);
            } else {
                echo "Simple inventory System";
            }
        ?>
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://kit.fontawesome.com/eb9107ad61.js" crossorigin="anonymous"></script>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>

    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js" defer></script>
    <script src="https://unpkg.com/codyhouse-framework/main/assets/js/util.js"></script>

    <link rel="stylesheet" href="libs/css/main.css?<?php echo time(); ?>" />
</head>

<body class="noscroll">
    <div class="demopage" id="noMessageSet">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                 <div class="notification alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a> <?php display_notification($notifications);?>
            </div>
                    <button class="btn btn-chat chatOpen">Chat</button>
                </div>

                <div id="resultsWindow" class="col-md-12">
                    <div class="panel panel-default">
                        <div class="flash-message js-flash-message" role="status" id="flashMessage1" data-duration="2000">
                            <p class="short">Product Link Copied.</p>
                        </div>
                        <div class="panel-heading clearfix">
                            <!-- <div class="header-product-search-container">
                                    <input type="text" id="product-search-input" class="form-control header-product-search"
                                        placeholder="Search" />
                                </div>
                            </div> -->
                            <div class="panel-body containerishere">
                                <table class="table table-bordered" id="productTable">
                                    <thead>
                                        <tr class="sticky-header">
                                            <th class="text-center" style="width: 3%;">#</th>
                                            <th> Photo</th>
                                            <th> ProductType</th>
                                            <th> Product Title </th>
                                            <th class="text-center" style="width: 20%;">Type</th>
                                            <th class="text-center" style="width: 20%;"> SubType </th>
                                            <th class="text-center" style="width: 20%;">Pcs. per product </th>
                                            <th class="text-center" style="width: 20%;"> Price per piece</th>
                                            <th class="text-center" style="width: 20%;"> Best Deal in Type</th>
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
                                            <td class="details">
                                                <a href="view_product.php?id=<?php echo (int)$product['id'];?>">
                                                <?php if($product['media_id'] === '0'): ?>
                                                <img class="img-avatar img-circle" src="uploads/products/new_no_image.jpg"
                                                     title="Click for details" alt="Image unavailable.">
                                                <?php else: ?>
                                                <img class="img-avatar img-circle"
                                                    src="uploads/products/<?php echo $product['image']; ?>"
                                                    onerror="this.onerror=null; this.src='uploads/products/new_no_image.jpg'"
                                                     title="Click for details" alt="Product Image.">
                                                <?php endif; ?>
                                                </a>
                                            </td>
                                            <td> <?php echo remove_junk($product['purchaseType']); ?></td>
                                            <td> <?php echo remove_junk($product['name']); ?>
                                                <button onclick="copyToClipboard(<?php echo (int)$product['id'];?>); return false;"
                                                        aria-controls="flashMessage1" class="btn btn-xs btn-chat" title="Share"
                                                        data-toggle="tooltip">
                                                    <span class="glyphicon glyphicon-share"></span>Share
                                                </button></td>
                                            <td class="text-center"> <?php echo remove_junk($product['categorie']); ?>
                                            </td>
                                            <td class="text-center"> <?php echo $product['subType']; ?></td>

                                            <td class="text-center">
                                                <?php echo  ($product['singleValue']."  ". $product['singleUnits']); ?>
                                            </td>


                                            <td class="text-center">
                                               $<?php calculatePrice($product, $all_categories); ?>
                                            </td>
                                            <td>
                                            <?php
                                            echo "pid= ".$product['id'];
                                            echo "pidarr= ".$best_deal_arr[$product['categorie_id']];
                                            if ($product['id'] === $best_deal_arr[$product['categorie_id']]){
                                            echo "<img class='img-avatar img-circle' src = '/uploads/products/great value.png'>";}
                                            else{
                                            echo "Nah";}
                                            ?>
                                             </td>
                                            <td class="text-center"> <?php echo  ($product['quantity']); ?>
                                            </td>
                                            <td class="text-center"> $<?php echo  ($product['buy_price']); ?>
                                            </td>
                                            <td class="text-center"> <?php echo read_date($product['date']); ?></td>

                                            <td class="text-center">
                                                <?php if(empty ($product["itemLink"])|| $product['itemLink']==="N/A") :?>
                                                No Link
                                                <?php else: ?>
                                                <i class="fas fa-external-link-alt link"></i>
                                                <a target='_blank' href="<?php echo $product['itemLink']; ?>">Item
                                                    Link</a>
                                                <?php endif; ?>
                                            </td>

                                            <td class="text-center">
                                                <?php if(empty ($product["reviewLink"])|| $product['reviewLink']==="N/A") :?>
                                                No Link
                                                <?php else: ?>
                                                <i class="rlink fab fa-youtube "></i>
                                                <a target='_blank' href="<?php echo  $product['reviewLink']; ?>">Review
                                                    Link</a>
                                                <?php endif; ?>
                                            </td>

                                            <td class="text-center"> <?php echo $product['company']; ?></td>

                                            <td class="text-center">
                                                <?php if(empty ($product["website"])|| $product['website']==="N/A") :?>
                                                No Link
                                                <?php else: ?>
                                                <i class="fas fa-external-link-alt link"></i><a target='_blank'
                                                    href="<?php echo $product['website']; ?>">Website</a>
                                                <?php endif; ?>
                                            </td>
                                            <td class="text-center"> <?php echo  ($product['city']); ?></td>
                                            <td class="text-center"> <?php echo  ($product['zipcode']); ?>
                                            </td>
                                            <?php if(empty ($product["phone"])||strpos($product['phone'], 'N') !== false):?>
                                              <td class="text-center">N/A </td>
                                              <?php else: ?>
                                            <td class="text-center"><a href="tel:<?php echo  ($product['phone']); ?>">
                                            <?php echo  ($product['phone']); ?></a> </td>
                                            <?php endif; ?>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4" id="chatWindow" style="display: none; height: 85vh;">
                    <i class="fa fa-times chatClose" aria-hidden="true"></i>
                    <iframe src="https://www.pricetize.com/ptchat/blabax.php" title="Pricetize Chat"
                        style="width: 100%; height: 100%;">
                    </iframe>
                </div>
            </div>

    <script type="text/javascript">
        $(document).ready(function() {
            var chatOpen = $('.chatOpen');
            var chatWindow = $('#chatWindow');
            var resultsWindow = $('#resultsWindow');

            var chatClose = $('.chatClose');

            chatOpen.click(function() {
                chatWindow.show();
                resultsWindow.removeClass('col-md-12');
                resultsWindow.addClass('col-md-8');
            });

            chatClose.click(function() {
                chatWindow.hide();
                resultsWindow.removeClass('col-md-8');
                resultsWindow.addClass('col-md-12');
            });

            // $('#productTable').DataTable();
            $('#productTable').DataTable( {
                "scrollX": true,
                "scrollY": '55vh',
                "scrollCollapse": false,
                "paging": true
            } );
        });
        // function changeStyle() {
//     if(empty(display_notification($notifications))){
//         document.getElementById("noMessageSet").classList.add('notification');

//     }

// }
        var productColumns = ["id", "subType", "name", "quantity", "buy_price", "sale_price", "media_id",
            "date",
            "description",
            "singleUnit", "singleUnits", "singleValue", "itemLink", "reviewLink", "city", "email", "phone",
            "zipcode", "freeShipping",
            "company",
            "website",
            "purchaseType", "categorie", "image,"
        ];

        var tableColumns = ["#", "Photo", "ProductType", "Product Title", "Type", "SubType", "Pcs. per case",
            "Price per case",
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
        async function filterSingleUnit() {
            products.foreach()
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

        function copyToClipboard(text) {
            var dummy = document.createElement("textarea");
            document.body.appendChild(dummy);
            var res = window.location.href.split('/');
            dummy.value = res[2] + "/view_product.php?id=" + text;
            dummy.select();
            document.execCommand("copy");
            document.body.removeChild(dummy);
        }

        (function() {
            var FlashMessage = function(element) {
                this.element = element;
                this.showClass = "flash-message--is-visible";
                this.messageDuration = parseInt(this.element.getAttribute('data-duration')) || 3000;
                this.triggers = document.querySelectorAll('[aria-controls="' + this.element.getAttribute('id') + '"]');
                this.temeoutId = null;
                this.isVisible = false;
                this.initFlashMessage();
            };

            FlashMessage.prototype.initFlashMessage = function() {
                var self = this;
                //open modal when clicking on trigger buttons
                if (self.triggers) {
                    for (var i = 0; i < self.triggers.length; i++) {
                        self.triggers[i].addEventListener('click', function(event) {
                            event.preventDefault();
                            self.showFlashMessage();
                        });
                    }
                }
                //listen to the event that triggers the opening of a flash message
                self.element.addEventListener('showFlashMessage', function() {
                    self.showFlashMessage();
                });
            };

            FlashMessage.prototype.showFlashMessage = function() {
                var self = this;
                Util.addClass(self.element, self.showClass);
                self.isVisible = true;
                //hide other flash messages
                self.hideOtherFlashMessages();
                if (self.messageDuration > 0) {
                    //hide the message after an interveal (this.messageDuration)
                    self.temeoutId = setTimeout(function() {
                        self.hideFlashMessage();
                    }, self.messageDuration);
                }
            };

            FlashMessage.prototype.hideFlashMessage = function() {
                Util.removeClass(this.element, this.showClass);
                this.isVisible = false;
                //reset timeout
                clearTimeout(this.temeoutId);
                this.temeoutId = null;
            };

            FlashMessage.prototype.hideOtherFlashMessages = function() {
                var event = new CustomEvent('flashMessageShown', {
                    detail: this.element
                });
                window.dispatchEvent(event);
            };

            FlashMessage.prototype.checkFlashMessage = function(message) {
                if (!this.isVisible) return;
                if (this.element === message) return;
                this.hideFlashMessage();
            };

            //initialize the FlashMessage objects
            var flashMessages = document.getElementsByClassName('js-flash-message');
            if (flashMessages.length > 0) {
                var flashMessagesArray = [];
                for (var i = 0; i < flashMessages.length; i++) {
                    (function(i) {
                        flashMessagesArray.push(new FlashMessage(flashMessages[i]));
                    })(i);
                }

                //listen for a flash message to be shown -> close the others
                window.addEventListener('flashMessageShown', function(event) {
                    flashMessagesArray.forEach(function(element) {
                        element.checkFlashMessage(event.detail);
                    });
                });
            }
        }());

    </script>
    <?php include_once('layouts/footer.php'); ?>
<?php endif ?>
