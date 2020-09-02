<?php
  $page_title = 'All Products - Pricetize';
  require_once('includes/load.php');


  // Checkin what level user has permission to view this page
   page_require_level(false);
    $products = join_product_table();
    //$products = join_product_table_wstock();
    $user = current_user();
?>

<?php if(!$_POST): ?>
<?php include_once('layouts/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="flash-message js-flash-message" role="status" id="flashMessage1" data-duration="2000">
                <p class="short">Product Link Copied.</p>
            </div>
            <div class="panel-body product-panel">
                <table class="table table-bordered" id="productTable">
                    <thead>
                        <tr>

                            <th class="text-center" style="width: 3%;">#</th>
                            <th> Photo</th>
                            <th> ProductType</th>
                            <th class="text-center"> Product Title </th>
                            <th class="text-center" style="width: 20%;">Type</th>
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
                            <td class="text-center"><?php echo count_id(); ?></td>
                            <td class="details">
                                <a href="view_product.php?id=<?php echo (int)$product['id'];?>" >
                                <?php if($product['media_id'] === '0'): ?>
                                <img class="img-avatar img-circle" src="uploads/products/new_no_image.jpg"
                                     title="Click for details" alt="Image unavailable.">
                                <?php else: ?>
                                <img class="img-avatar img-circle"
                                    src="uploads/products/<?php echo $product['image']; ?>" onerror="this.onerror=null;
                                    this.src='uploads/products/new_no_image.jpg'" title="Click for details" alt="Product Image.">
                                <?php endif; ?>
                                </a>
                            </td>
                            <td> <?php echo remove_junk($product['purchaseType']); ?></td>
                            <td id="prodname">
                                    <?php echo ($product['name']); ?> <br>
                                <button onclick="copyToClipboard(<?php echo (int)$product['id'];?>); return false;"
                                      aria-controls="flashMessage1" class="btn btn-xs btn-chat" title="Share"
                                        data-toggle="tooltip">
                                    <span class="glyphicon glyphicon-share"></span> Share
                                </button>
                            </td>
                            <td class="text-center"> <?php echo remove_junk($product['categorie']); ?></td>
                            <td class="text-center">
                                <?php echo  ($product['singleValue']."  ". $product['singleUnits']); ?>
                            </td>


                            <td class="text-center">
                                <?php if(empty($product['singleValue'] && $product['buy_price'])) :?>
                                N/A
                                <?php else: ?>
                                <?php $price=bcdiv($product['buy_price'] / $product['singleValue'],1,2)?>
                                $<?php echo $price; ?>

                                <?php endif; ?>
                            </td>
                            <td class="text-center"> <?php echo  ($product['quantity']); ?>
                            </td>
                            <td class="text-center"> $<?php echo  ($product['buy_price']); ?>
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

                            <td class="text-center"> <?php echo  ($product['city']); ?></td>
                            <td class="text-center"> <?php echo  ($product['zipcode']); ?></td>
                            <?php if(empty ($product["phone"])||strpos($product['phone'], 'N') !== false):?>
                            <td class="text-center">N/A </td>
                            <?php else: ?>
                            <td class="text-center"><a href="tel:<?php echo  ($product['phone']); ?>">
                                    <?php echo  ($product['phone']); ?></a> </td>
                            <?php endif; ?>
                            <td class="text-center">
                                <?php if($user["user_level"] == 1) :?>
                                <div class="btn-group">
                                    <button onclick="copyToClipboard(<?php echo (int)$product['id'];?>); return false;"
                                        aria-controls="flashMessage1" class="btn btn-success btn-xs" title="Share"
                                        data-toggle="tooltip">
                                        <span class="glyphicon glyphicon-share"></span>
                                    </button>
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
    $('#productTable').DataTable({
        "scrollX": true,
        "scrollY": '60vh',
        "scrollCollapse": false,
        "paging": true
    });
});

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

<?php include_once('layouts/legacyfooter.php'); ?>
<?php endif ?>