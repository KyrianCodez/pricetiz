<?php
$page_title = 'Edit Noticeboard';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(1);
?>
<?php

$notifications = find_by_id('notifications',(int)$_GET['id'])
;
$all_messagetype = find_all('messagetype');
if(!$notifications){
    $session->msg("d","Missing notification id.");
    redirect('noticeboard.php');
}
?>
<?php
if(isset($_POST['edit_notice'])){
    $req_fields = array('message-content','message-type');
    validate_fields($req_fields);
    
    if(empty($errors)){
    $m_content =  ($db->escape($_POST['message-content']));
    $m_type =  ($db->escape($_POST['message-type']));
    
    $query = "UPDATE notifications SET";
    $query .= " messageContent = '{$m_content}', messageType = '{$m_type}'";
    $query .="WHERE id = '{$notifications['id']}'";
    $result = $db->query($query);
            if($result){
                $session->msg('s',"Message Updated");
                redirect('noticeboard.php', false);
            }else{
                $session->msg('d',"Failed to update notification");
                redirect('edit_noticeboard.php?id='.$notifications['id'],false);

            }
        }else{
            $session->msg('d',$errors);
            redirect('noticeboard.php', false);
        }

}
?>

<?php include_once('layouts/header.php'); ?>

<div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); ?>
    </div>
</div>
<div class="row">
    <div class="panel panel-default">
        <div class="panel-heading">
            <strong>
                <span class="glyphicon glyphicon-th"></span>
                <span>Edit Message</span>
            </strong>
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                <form method="post" action="edit_noticeboard.php?id=<?php echo (int)$notifications['id']?>">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <select class="form-control" name="message-type">
                                <option value=""> Select Message Type</option>
                                <?php foreach ($all_messagetype as $cat): ?>
                                <option value="<?php echo (int) $cat['id'];?>" <?php if($notifications['messageType'] === $cat['id']): echo "selected";endif;
?>>
                                    <?php echo  ($cat['name']); ?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="message-content">Enter Message Content</label>
                                <div class="input-group">

                                    <textarea class="form-control" id="message-content" name="message-content" rows="5"
                                        cols="100"><?php echo ($notifications['messageContent']) ?>
</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="edit_notice" class="update btn btn-danger">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once('layouts/legacyfooter.php'); ?>