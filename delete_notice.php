<?php
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
?>
<?php
  $notifications = find_by_id('notifications',(int)$_GET['id']);
  if(!$notifications){
    $session->msg("d","Missing Notice id.");
    redirect('noticeboard.php');
  }
?>
<?php
  $delete_id = delete_by_id('notifications',(int)$notifications['id']);
  if($delete_id){
      $session->msg("s","Notice deleted.");
      redirect('noticeboard.php');
  } else {
      $session->msg("d","Notice deletion failed.");
      redirect('Noticeboard.php');
  }
?>
