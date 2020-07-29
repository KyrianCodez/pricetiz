<?php
  $page_title = 'View product - Pricetize';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
   page_require_level(false);
?>
<?php
$last_page = 0;
if (isset($_GET["page"])){
    $last_page =(int) $_GET['page'];
}

$product = find_by_id('products',(int)$_GET['id']);
$image = find_by_id('media', (int)$product['media_id']);
$all_categories = find_all('categories');
$all_photo = find_all('media');
$user = current_user();
$cat_name='';
foreach ($all_categories as $cat):
    if($product['categorie_id'] === $cat['id']): $cat_name=($cat['name']);
    endif;
    endforeach;
if(!$product){
  $session->msg("d","Missing product id.");
  redirect('product.php');
}

$is_tracked = $_SESSION["TRACKED"];
$session_id = session_id();
$user_ip = $_SERVER["REMOTE_ADDR"];
if(!$is_tracked){
    if(trackVisit($session_id, $user_ip)){
        $_SESSION["TRACKED"] = true;
    }
}
?>

<?php include_once('layouts/header.php'); ?>

<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v7.0"
        nonce="Im2GRDS6"></script>
<div class="row">
    <div>
        <div class="flash-message js-flash-message viewp-flash" role="status" id="flashMessage1" data-duration="2000">
            <p class="short">Product Link Copied.</p>
        </div>
        <section class="container">

            <div class="one">
                <?php if($product['media_id'] === '0'): ?>
                    <img src="uploads/products/new_no_image.jpg" class='prodp' alt="">
                <?php else: ?>
                    <img src="uploads/products/<?php echo $image['file_name']; ?>" class='prodp'
                         onerror="this.onerror=null;
                        this.src='uploads/products/new_no_image.jpg'" alt="">
                <?php endif; ?>
            </div>
            <div class="two">
                <?php if(empty ($product["itemLink"]) || $product['itemLink']=="N/A") :?>
                    <h1><?php echo ($product['name']); ?> Details</h1>
                <?php else: ?>
                    <a target='_blank' title="Click here for product website"
                       href="<?php echo $product['itemLink']; ?>">
                        <span>
                            <h1><?php echo ($product['name']); ?></h1>
                        </span>
                    </a>
                <?php endif; ?>
                Price: $<?php echo  ($product['buy_price']); ?><br>
                Pieces per product: <?php echo  ($product['singleValue']."  ". $product['singleUnits']); ?><br>
                In stock quantity:
                <?php echo  ($product['quantity']); ?><br>
                Unit Price:
                <?php if(empty($product['singleValue'] && $product['buy_price'])) :?>
                    Not Available.
                <?php else: ?>
                    $<?php echo  number_format($product['buy_price'] / $product['singleValue'],2); ?>

                <?php endif; ?><br>
                <br>
                Available for <?php echo  ($product['purchaseType']); ?> <br>
                Product Category: <?php echo $cat_name; ?> <br>
                SubType: <?php if (!empty($product['subType'])): echo $product['subType']; else: echo"None"; endif;?>
                <br>
                <br>
                Watch a Product Review:
                <?php if(empty ($product["reviewLink"])|| $product['reviewLink']=="N/A") :?>
                    No Review Available.
                <?php else: ?>
                    <i class="rlink fab fa-youtube "></i>
                    <a target='_blank' href="<?php echo  $product['reviewLink']; ?>"> Click here!</a>
                <?php endif; ?>
                <br>
                <br>
                Sold by:<br>
                <div class="tab">
                <?php if(empty ($product["website"])|| $product['website']=="N/A") :?>
                    <?php echo $product['company']; ?>
                <?php else: ?>
                    <a target='_blank' title="Company Website" href="<?php echo $product['website']; ?>">
                        <?php echo $product['company']; ?></a>
                <?php endif; ?><br>
                <?php if($product["city"]=="NA"|| $product['zipcode']=="NA") :?>
                    No address provided.
                <?php else: ?>
                    <?php echo  ($product['city']); ?>
                    <?php echo  ($product['zipcode']); ?>
                <?php endif; ?><br>
                <?php if(empty ($product["phone"])||strpos($product['phone'], 'N') !== false):?>
                    No Phone Number Available.
                <?php else: ?>
                    <i class="fa fa-phone "></i>
                    <a href="tel:<?php echo  ($product['phone']); ?>">
                            <?php echo  ($product['phone']); ?></a>
                <?php endif; ?>
                </div>
                <br>
                    <button onclick="copyToClipboard(<?php echo (int)$product['id'];?>); return false;"
                            aria-controls="flashMessage1" class="btn btn-success card" title="Share"
                            data-toggle="tooltip">Copy Product Link
                    </button>
                <div id = "fb" title="Post to Facebook" class="fb-share-button btn card"
                     data-href="https://www.pricetize.com/view_product.php?id=9"
                     data-layout="button" data-size="large"><a id="fbh" target="_blank"
                     href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fhttps://www.pricetize.com/view_product.php?id=9%2F&amp;src=sdkpreparse"
                                                               class="fb-xfbml-parse-ignore">Share</a></div>
                <?php if($user && $last_page===0) :?>
                    <a href="product.php" class="btn btn-danger card">Back to all Products</a>
                <?php elseif (empty($user) && $last_page===0):?>
                    <a href="index.php" class="btn btn-danger card">Back to all Products</a>
                <?php elseif ($last_page > 0):?>
                    <a href="displayall.php?id=<?php echo $last_page; ?>" class="btn btn-danger card">Back to all Products</a>
                <?php endif; ?>

            </div>
        </section>
        </div>
    </div>

<script>
function changeAddress(id) {
    var link = document.getElementById("fb");
    var linkhref = "https://www.pricetize.com/view_product.php?id=" + id;
    link.setAttribute("data-href", linkhref);
    var link2 = document.getElementById("fbh");
    linkhref = "https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Fhttps://www.pricetize.com/view_product.php?id="
        + id + "%2F&amp;src=sdkpreparse";
    link2.setAttribute("href", linkhref);
    return false;

}
window.onload = changeAddress(<?php echo (int)$product['id'];?>);

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
        this.triggers = document.querySelectorAll('[aria-controls="'+this.element.getAttribute('id')+'"]');
        this.temeoutId = null;
        this.isVisible = false;
        this.initFlashMessage();
    };

    FlashMessage.prototype.initFlashMessage = function() {
        var self = this;
        //open modal when clicking on trigger buttons
        if ( self.triggers ) {
            for(var i = 0; i < self.triggers.length; i++) {
                self.triggers[i].addEventListener('click', function(event) {
                    event.preventDefault();
                    self.showFlashMessage();
                });
            }
        }
        //listen to the event that triggers the opening of a flash message
        self.element.addEventListener('showFlashMessage', function(){
            self.showFlashMessage();
        });
    };

    FlashMessage.prototype.showFlashMessage = function() {
        var self = this;
        Util.addClass(self.element, self.showClass);
        self.isVisible = true;
        //hide other flash messages
        self.hideOtherFlashMessages();
        if( self.messageDuration > 0 ) {
            //hide the message after an interveal (this.messageDuration)
            self.temeoutId = setTimeout(function(){
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
        var event = new CustomEvent('flashMessageShown', { detail: this.element });
        window.dispatchEvent(event);
    };

    FlashMessage.prototype.checkFlashMessage = function(message) {
        if( !this.isVisible ) return;
        if( this.element === message) return;
        this.hideFlashMessage();
    };

    //initialize the FlashMessage objects
    var flashMessages = document.getElementsByClassName('js-flash-message');
    if( flashMessages.length > 0 ) {
        var flashMessagesArray = [];
        for( var i = 0; i < flashMessages.length; i++) {
            (function(i){flashMessagesArray.push(new FlashMessage(flashMessages[i]));})(i);
        }

        //listen for a flash message to be shown -> close the others
        window.addEventListener('flashMessageShown', function(event){
            flashMessagesArray.forEach(function(element){
                element.checkFlashMessage(event.detail);
            });
        });
    }
    document.getElementById("myLink").onclick = function() {
        var link = document.getElementById("abc");
        link.setAttribute("href", "xyz.php");
        return false;
    }


}());

</script>

<?php include_once('layouts/footer.php'); ?>