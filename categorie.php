<?php
  $page_title = 'All categories';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  page_require_level(1);
  
  $all_categories = find_all('categories')
?>

<?php
 if(isset($_POST['add_cat'])){
   $req_field = array('categorie-name');
  

   validate_fields($req_field);
   $cat_name =  ($db->escape($_POST['categorie-name']));
   $cat_image = ($db->escape($_POST['categorie-image']));

   if(empty($errors)){
    if(!empty($cat_image)){
 $sql = "INSERT INTO categories (name, file_name) ";
$sql .= " VALUES ('{$cat_name}','{$cat_image}')";
if ($db->query($sql)) {
    $session->msg("s", "Successfully Added Category");
    redirect('categorie.php', false);
} else {
    $session->msg("d", "Sorry Failed to insert.");
    redirect('categorie.php', false);
}


    }else{
      $photo = new Media();
  $photo->upload($_FILES['file_upload']);
    if($photo->process_cat($cat_name, $cat_image)){
        $session->msg('s','Successfully Added Category');
        redirect('categorie.php');
    } else{
      $session->msg('d',join($photo->errors));
      redirect('categorie.php');
    }
  }
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
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
            <span class="glyphicon glyphicon-th"></span>
            <span>Add New Category</span>
         </strong>
        </div>
        <div class="panel-body">
          <form method="post" action="categorie.php" enctype="multipart/form-data">
            <div class="form-group">
                <input type="text" class="form-control" name="categorie-name" placeholder="Category Name">
            </div>
             <div class="form-group">
                <input type="text" class="form-control" name="categorie-image" placeholder="Image name">
            </div>
               <div class="form-group">
                <input type="file" name="file_upload" multiple="multiple" class="btn btn-primary btn-file"/>
            </div>
            
            <button type="submit" name="add_cat" class="btn btn-primary">Add category</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span class="glyphicon glyphicon-th"></span>
          <span>All Categories</span>
       </strong>
      </div>
        <div class="panel-body">
          <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th class="text-center" style="width: 50px;">#</th>
                    <th>Categories</th>
                    <th class="text-center" style="width: 100px;">Actions</th>
                </tr>
            </thead>
            <tbody>
              <?php foreach ($all_categories as $cat):?>
                <tr>
                    <td class="text-center"><?php echo count_id();?></td>
                    <td><?php echo (ucfirst($cat['name'])); ?></td>
                    <td class="text-center">
                      <div class="btn-group">
                        <a href="edit_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-warning" data-toggle="tooltip" title="Edit">
                          <span class="glyphicon glyphicon-edit"></span>
                        </a>
                        <a href="delete_categorie.php?id=<?php echo (int)$cat['id'];?>"  class="btn btn-xs btn-danger" data-toggle="tooltip" title="Remove">
                          <span class="glyphicon glyphicon-trash"></span>
                        </a>
                      </div>
                    </td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
       </div>
    </div>
    </div>
   </div>
  </div>
  <?php include_once('layouts/legacyfooter.php'); ?>