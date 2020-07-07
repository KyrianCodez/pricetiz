<?php

 session_start(["name" => "visit", "cookie_lifetime" => 0]);


class Session {

 public $msg;
 private $user_is_logged_in = false;

 function __construct(){
   $this->flash_msg();
   $this->userLoginSetup();
   $_SESSION["TRACKED"] = false;

 }

  public function isUserLoggedIn(){
    return $this->user_is_logged_in;
  }
  public function login($user_id){
    $_SESSION['user_id'] = $user_id;
  }
  private function userLoginSetup()
  {
    if(isset($_SESSION['user_id']))
    {
      $this->user_is_logged_in = true;
    } else {
      $this->user_is_logged_in = false;
    }

  }
  public function logout(){
    unset($_SESSION['user_id']);
  }

  public function msg($type ='', $msg =''){
    if(!empty($msg)){
       if(strlen(trim($type)) == 1){
         $type = str_replace( array('d', 'i', 'w','s'), array('danger', 'info', 'warning','success'), $type );
       }
       $_SESSION['msg'][$type] = $msg;
    } else {
      return $this->msg;
    }
  }

  private function flash_msg(){

    if(isset($_SESSION['msg'])) {
      $this->msg = $_SESSION['msg'];
      unset($_SESSION['msg']);
    } else {
      $this->msg;
    }
  }
}

$session = new Session();
$msg = $session->msg();

?>
