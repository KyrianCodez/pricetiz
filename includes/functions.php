<?php
 $errors = array();
require_once('includes/load.php');

//   $all_categories = find_all('categories');


 /*--------------------------------------------------------------*/
 /* Function for Remove escapes special
 /* characters in a string for use in an SQL statement
 /*--------------------------------------------------------------*/
function real_escape($str){
  global $con;
  $escape = mysqli_real_escape_string($con,$str);
  return $escape;
}
/*--------------------------------------------------------------*/
/* Function for Remove html characters
/*--------------------------------------------------------------*/
function remove_junk($str){
  $str = nl2br($str);
  $str = htmlspecialchars(strip_tags($str, ENT_QUOTES));
  return $str;
}
/*--------------------------------------------------------------*/
/* Function for Uppercase first character
/*--------------------------------------------------------------*/
function first_character($str){
  $val = str_replace('-'," ",$str);
  $val = ucfirst($val);
  return $val;
}
/*--------------------------------------------------------------*/
/* Function for Checking input fields not empty
/*--------------------------------------------------------------*/
function validate_fields($var){
  global $errors;
  foreach ($var as $field) {
    $val = remove_junk($_POST[$field]);
    if(isset($val) && $val==''){
      $errors = $field ." can't be blank.";
      return $errors;
    }
  }
}
/*--------------------------------------------------------------*/
/* Function for Display Session Message
   Ex echo displayt_msg($message);
/*--------------------------------------------------------------*/
function display_msg($msg =''){
   $output = array();
   if(!empty($msg)) {
      foreach ($msg as $key => $value) {
         $output  = "<div class=\"alert alert-{$key}\">";
         $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
         $output .= remove_junk(first_character($value));
         $output .= "</div>";
      }
      return $output;
   } else {
     return "" ;
   }
}
  
 

function display_notification($notifications)
{

    if (isset($notifications[0]['type'])) {
     
    if ($notifications[0]['type'] === 'PSA') {
      $value = $notifications[0]['messageContent'];
      //echo $value;
      return $value;
    }
    }
    return 'false';

}
/*--------------------------------------------------------------*/
/* Function for calculating Price
/*--------------------------------------------------------------*/

function calculatePrice($product, $all_categories){
  if (empty($product['singleValue'] && $product['buy_price'])) {
    echo "N/A";
}else{

$price=bcdiv($product['buy_price'] / $product['singleValue'],1,2);
     
  echo $price;
  
  
                                      
}                                    
 //inserts price calculation into database for retrieval 
insertPrice($price, $product);

                                         
}

function setBestInClassFlag($all_categories){
    $best_cat_arr=array();
    foreach ($all_categories as $cat) {
        $catID = $cat['id'];
        $best_arr = assignArray($catID);
        $best_prod = $best_arr[0][0];
        $best_cat_arr[$catID] = $best_prod;
    }
    return $best_cat_arr;
}

/*--------------------------------------------------------------*/
/* Function for redirect
/*--------------------------------------------------------------*/
function redirect($url, $permanent = false)
{
    if (headers_sent() === false)
    {
      header('Location: ' . $url, true, ($permanent === true) ? 301 : 302);
    }

    exit();
}
/*--------------------------------------------------------------*/
/* Function for find out total saleing price, buying price and profit
/*--------------------------------------------------------------*/
function total_price($totals){
   $sum = 0;
   $sub = 0;
   $profit =0;
   foreach($totals as $total ){
     $sum += $total['total_saleing_price'];
     $sub += $total['total_buying_price'];
     $profit = $sum - $sub;
   }
   return array($sum,$profit);
}
/*--------------------------------------------------------------*/
/* Function for Readable date time
/*--------------------------------------------------------------*/
function read_date($str){
     if($str)
      return date('F j, Y, g:i:s a', strtotime($str));
     else
      return null;
  }
/*--------------------------------------------------------------*/
/* Function for  Readable Make date time
/*--------------------------------------------------------------*/
function make_date(){
  return strftime("%Y-%m-%d %H:%M:%S", time());
}
/*--------------------------------------------------------------*/
/* Function for  Readable date time
/*--------------------------------------------------------------*/
function count_id(){
  static $count = 1;
  return $count++;
}
/*--------------------------------------------------------------*/
/* Function for Creating random string
/*--------------------------------------------------------------*/
function randString($length = 5)
{
  $str='';
  $cha = "0123456789abcdefghijklmnopqrstuvwxyz";

  for($x=0; $x<$length; $x++)
   $str .= $cha[mt_rand(0,strlen($cha))];
  return $str;
}

/*--------------------------------------------------------------*/
/* Function for combining product categories
/*--------------------------------------------------------------*/
function combineCats()
{
    $all_categories = find_all('categories');
    $comcat = array();
    $i =0;
    foreach ($all_categories as $cat) {
        $pieces = explode("/", $cat['name']);
        if (!searchArray($pieces[0], "name", $comcat)){
            $has_subcat = FALSE;
            if (count($pieces)>1){
                $has_subcat = TRUE;
            }
            $comcat[$i] = array("name" => $pieces[0], "file_name" =>$cat['file_name'], "has_subcat"=>$has_subcat);
            $i++;

        }
    }
    return $comcat;
}

function searchArray($value, $field, $arr){

    foreach ($arr as $data)
    {
        if ($data[$field] == $value)
            return TRUE;
    }
    return FALSE;
}

function get_subCats($key)
{
    $all_categories = find_all('categories');
    $subcats = array();
    $i =0;
    foreach ($all_categories as $cat) {
        $pieces = explode("/", $cat['name']);
        if ($pieces[0]==$key){
            array_push($subcats, $cat);
        }
    }
    return $subcats;
}


function pagination()
{

    if (isset($filter_results)) {

        $results_per_page = $filter_results;

        $results = count_active_products();
        // echo $results['total'];
        // echo "</br>";
        $number_of_pages = ceil($results['total'] / $results_per_page);
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $this_page_fresult = ($page - 1) * $results_per_page;
// echo $this_page_fresult;
        // echo "</br>";

        return array($results_per_page, $this_page_fresult, $page, $number_of_pages, $number_of_pages);
    } else {
        $results_per_page = 25;

        $results = count_active_products();
// echo $results['total'];
        // echo "</br>";
        $number_of_pages = ceil($results['total'] / $results_per_page);
        if (!isset($_GET['page'])) {
            $page = 1;
        } else {
            $page = $_GET['page'];
        }
        $this_page_fresult = ($page - 1) * $results_per_page;
// echo $this_page_fresult;
        // echo "</br>";

        return array($results_per_page, $this_page_fresult, $page, $number_of_pages, $number_of_pages);

    }

}

function setFiltertag($option)
{
    $filter_results = $option;
    return array($filter_results);
}

?>
