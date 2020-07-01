<?php
$page_title = 'All Notifications';
require_once('includes/load.php');
// Checkin What level user has permission to view this page
page_require_level(false);
$notifications = join_notification_table();

$user = current_user();
?>

<?php if(!$_POST): ?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
    <div class="col-md-12">
        <?php echo display_msg($msg); ?>
    </div>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-bordered" id="notifTable">
                    <thead>
                        <tr class="sticky-header">
                            <th class="text-center" style="width: 3%;">#</th>
                            <th>Message Content</th>
                            <th>Message Type</th>
                            <th class="text-center" style="width: 100px;"> Actions </th>
                        </tr>
                    </thead>
                    <tbody id="product-table-body">
                        <?php foreach ($notifications as $notification):?>
                        <tr>
                            <td class="text-center"><?php echo count_id();?></td>
                            <td> <?php echo ($notification['messageContent']); ?></td>
                            <td class="text-center"> <?php echo remove_junk($notification['type']); ?></td>

                            <td class="text-center">
                                <?php if($user["user_level"] == 1) :?><div class="btn-group">
                                    <a href="edit_noticeboard.php?id=<?php echo (int)$notification['id'];?>"
                                        class="btn btn-info btn-xs" title="Edit" data-toggle="tooltip">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <a href="delete_notice.php?id=<?php echo (int)$notification['id'];?>"
                                        class="btn btn-danger btn-xs" title="Delete" data-toggle="tooltip">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </div><?php endif; ?>
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
    $('#notifTable').DataTable();
});

<?php include_once('layouts/footer.php'); ?>
<?php endif ?>