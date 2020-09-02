<?php
$page_title = 'Add Notice';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(2);


$all_messagetype = find_all('messagetype');

?>
<?php
if (isset($_POST['add_notice'])) {
    $req_fields = array('message-content', 'message-type');
    validate_fields($req_fields);

    if (empty($errors)) {
        $m_content =  ($db->escape($_POST['message-content']));
        $m_type =  ($db->escape($_POST['message-type']));
        $date = make_date();
        $query = "INSERT INTO notifications (";
        $query .= "messageContent,messageType";
        $query .=") VALUES (";
        $query .="'{$m_content}','{$m_type}'";
        $query .= ")";
        $query .= "ON DUPLICATE KEY UPDATE messageContent='{$m_content}'";
        $result = $db->query($query);
        if ($result) {
            $session->msg('s', "Notification added");
            redirect('add_notice.php', false);
        } else {
            $session->msg('d', "Failed to add notification");
            redirect('noticeboard.php', false);

        }
    } else {
        $session->msg('d', $errors);
        redirect('add_notice.php', false);
    }

}
?>
<?php include_once('layouts/header.php');?>
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
                <span>Add New Message</span>
            </strong>
        </div>
        <div class="panel-body">
            <div class="col-md-6">
                <form method="post" action="add_notice.php" class="clearfix">
                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="glyphicon glyphicon-th-large"></i>
                            </span>
                            <select class="form-control" name="message-type">
                                <option value=""> Select Message Type</option>
                                <?php foreach ($all_messagetype as $cat): ?>
                                <option value="<?php echo (int) $cat['id']?>"> 
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
                                        cols="100"
                                        value=""></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" name="add_notice" class="update btn btn-danger">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include_once('layouts/legacyfooter.php'); ?>