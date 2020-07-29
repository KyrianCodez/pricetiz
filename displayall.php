<?php
ob_start();

$page_title = 'All Products - Pricetize';
require_once('includes/load.php');


// Checkin What level user has permission to view this page
page_require_level(false);
//$products = join_product_table();
$products = get_products_by_category((int)$_GET['id']);
$notifications = join_notification_table();
$all_categories = find_all('categories');
$best_deal_arr = setBestInClassFlag($all_categories);

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

<body  onload="check_browser()">
<div>
    <span> <h1> Pricetize Products by Catergory </h1>
        <a href="display.php" class="btn btn-back">Back to all Categories</a>

</span>
</div>
<!--                     onerror="this.onerror=null; this.src='uploads/products/new_no_image.jpg'"-->
<div class="cards">

    <?php foreach ($products as $p):?>


        <div class="col">
            <a href="view_product.php?id=<?php echo (int)$p['id'];?>&page=<?php echo (int)$_GET['id']; ?>">
            <div class="card" >
                <img class="display" src="uploads/products/<?php echo $p['image']; ?>"
                onerror="this.onerror=null; this.src='libs/images/dinosaur.png'"
                     title="Click for details" alt="Product Image." >
                <div class="card-body">
                    <p class="card-text"><?php echo $p['name'] ; ?></p>
                </div>
            </div>
            </a>
        </div>


    <?php endforeach; ?>
        </div>



<script type="text/javascript">

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

    function check_browser(){
        var rv = -1; // Return value assumes failure.

        if (navigator.appName == 'Microsoft Internet Explorer'){

            var ua = navigator.userAgent,
                re  = new RegExp("MSIE ([0-9]{1,}[\\.0-9]{0,})");

            if (re.exec(ua) !== null){
                rv = parseFloat( RegExp.$1 );
            }
        }
        else if(navigator.appName == "Netscape"){
            /// in IE 11 the navigator.appVersion says 'trident'
            /// in Edge the navigator.appVersion does not say trident
            if(navigator.appVersion.indexOf('Trident') === -1) rv = 12;
            else rv = 11;
        }

        //alert(rv);
        if (rv==11){
            var modal = document.getElementById("myModal");
            modal.style.display = "block";
        }

    }

</script>
<?php include_once('layouts/footer.php'); ?>
<?php endif; ?>

