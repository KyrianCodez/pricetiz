<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(false);
  $products = join_product_table();
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
            <div class="panel-heading clearfix">
                <div class="header-product-search-container">
                    <input type="text" id="product-search-input" class="form-control header-product-search"
                        placeholder="Search" />
                </div>
                <?php if($user["user_level"] == '1'): ?><div class="pull-right">
                    <a href="add_product.php" class="btn btn-primary">Add New</a>
                </div><?php endif; ?>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
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
                            <th class="text-center" style="width: 20%;"> ItemLink </th>
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
                                    src="uploads/products/<?php echo $product['image']; ?>" alt="">
                                <?php endif; ?>
                            </td>
                            <td> <?php echo remove_junk($product['purchaseType']); ?></td>
                            <td> <?php echo remove_junk($product['name']); ?></td>
                            <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                            <td class="text-center"> <?php echo $product['subType']; ?></td>
                            <td class="text-center"> <?php echo remove_junk($product['singleUnit']); ?></td>
                            <td class="text-center"> <?php echo remove_junk($product['quantity']); ?></td>
                            <td class="text-center"> $<?php echo remove_junk($product['buy_price']); ?></td>
                            <td class="text-center"> <?php echo read_date($product['date']); ?></td>
                            <td class="text-center">
                                <i class="fas fa-external-link-alt link"></i> <a target='_blank'
                                    href="<?php echo $product['itemLink']; ?>">Link</a></td>
                            <td class="text-center">
                            <?php if($product["reviewLink"] === null) :?>
                            No Link
                            <?php else: ?>
                             <i class="rlink fab fa-youtube "></i>
                              <a target='_blank'
                                    href="<?php echo  $product['reviewLink']; ?>">Link</a>
                            <?php endif; ?>
                            </td>

                            <td class="text-center"> <?php echo $product['company']; ?></td>
                            <td class="text-center"> <i class="fas fa-external-link-alt link"></i><a target='_blank'
                                    href="<?php echo $product['website']; ?>">Link</a></td>
                            <td class="text-center"> <?php echo remove_junk($product['city']); ?></td>
                            <td class="text-center"> <?php echo remove_junk($product['zipcode']); ?></td>
                            <td class="text-center"> <?php echo remove_junk($product['phone']); ?></td>
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
                    </tabel>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
var productColumns = ["id", "subType", "name", "quantity", "buy_price", "sale_price", "media_id", "date", "description",
    "singleUnit", "itemLink", "reviewLink", "city", "email", "phone", "zipcode", "freeShipping", "company",
    "website",
    "purchaseType", "categorie", "image"
];

var tableColumns = ["#", "Photo", "ProductType", "Product Title", "Type", "SubType", "Pcs. per product",
    "No. of products in stock", "Price",
    "Product Added", "ItemLink", "Review Link", "Company", "Website", "City", "ZipCode", "Phone", "Actions"
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
tableProductColMap.set("ItemLink", "itemLink");
tableProductColMap.set("Review Link", "reviewLink");
tableProductColMap.set("Company", "company");
tableProductColMap.set("Website", "website");
tableProductColMap.set("City", "city");
tableProductColMap.set("ZipCode", "zipcode");
tableProductColMap.set("Phone", "phone");
tableProductColMap.set("Actions", false);

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
                            `<td> <i class="fas fa-external-link-alt link"></i> <a target = '_blank' href="${p[productColumns.findIndex((c) => c === productCol)]}">Link</a></td>`;
                    } else if (productCol === "website") {
                        row +=
                            `<td> <i class="fas fa-external-link-alt link"></i> <a target = '_blank' href="${p[productColumns.findIndex((c) => c === productCol)]}">Link</a></td>`;
                    } else if (productCol ===
                        "reviewLink") {
                        row +=
                            `<td> <i class="rlink fab fa-youtube "> </i> <a target = '_blank' href="${p[productColumns.findIndex((c) => c === productCol)]}">Link</a></td>`;
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
                    row += `<td>${index+1}</td>`
                } else if (tCol === "Actions") {
                    row += `
              <td><?php if($user["user_level"] == 1) :?><div class="btn-group">
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
</script>
<?php include_once('layouts/footer.php'); ?>
<?php endif ?>