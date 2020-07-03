<?php include_once('includes/load.php'); ?>
<?php
$req_fields = array('username','password' );
validate_fields($req_fields);
$username =  ($_POST['username']);
$password =  ($_POST['password']);

if(empty($errors)){
  $user_id = authenticate($username, $password);
  if($user_id){
    //create session with id
     $session->login($user_id);
    //Update Sign in time
     updateLastLogIn($user_id);
     $session->msg("s", "Welcome to OSWA-INV.");
     redirect('home.php',false);

  } else {
    $session->msg("d", "Sorry Username/Password incorrect.");
    redirect('login.php',false);
  }

} else {
   $session->msg("d", $errors);
   redirect('login.php',false);
}

?>
