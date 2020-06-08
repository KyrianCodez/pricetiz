<?php $user = current_user(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>
      <?php if (!empty($page_title))
           echo remove_junk($page_title);
            elseif(!empty($user))
           echo ucfirst($user['name']);
            else echo "Simple inventory System";?>
            
    </title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" />
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    <link rel="stylesheet" href="libs/css/main.css" />
    
    <script
			  src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
			  integrity="sha256-4+XzXVhsDmqanXGHaHvgh1gMQKX40OUvDEBTu8JcmNs="
			  crossorigin="anonymous"></script>
        
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://kit.fontawesome.com/eb9107ad61.js" crossorigin="anonymous"></script>
    <link rel="stylesheet"
        href="libs/css/main.css?<?php echo time();/* appended to disable browser caching css file remove for release*/ ?>" />
</head>

<body>
    <?php  if ($session->isUserLoggedIn(true)): ?>
    <header id="header">
        <div class="logo pull-left"> OSWA - Inventory </div>
        <div class="header-content">
            <div class="header-date pull-left">
                <strong><?php echo date("F j, Y, g:i a");?></strong>
            </div>
            <div class="pull-right clearfix">
                <ul class="info-menu list-inline list-unstyled">
                    <li class="profile">
                        <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
                            <img src="uploads/users/<?php echo $user['image'];?>" alt="user-image"
                                class="img-circle img-inline">
                            <span><?php echo remove_junk(ucfirst($user['name'])); ?> <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="profile.php?id=<?php echo (int)$user['id'];?>">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a href="edit_account.php" title="edit account">
                                    <i class="glyphicon glyphicon-cog"></i>
                                    Settings
                                </a>
                            </li>
                            <li class="last">
                                <a href="logout.php">
                                    <i class="glyphicon glyphicon-off"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="sidebar">
        <?php if(true): ?>
        <!-- admin menu -->
        <?php include_once('admin_menu.php');?>

        <?php elseif($user['user_level'] === '2'): ?>
        <!-- Special user -->
        <?php include_once('special_menu.php');?>

        <?php elseif($user['user_level'] === '3'): ?>
        <!-- User menu -->
        <?php include_once('user_menu.php');?>

        <?php endif;?>

    </div>

    <?php elseif($session->isUserLoggedIn(false)):?>
       <header id="header">
        <div class="logo pull-left"> OSWA - Inventory </div>
        <div class="header-content">
            <div class="header-date pull-left">
                <strong><?php echo date("F j, Y, g:i a");?></strong>
            </div>
            <div class="pull-right clearfix">
                <ul class="info-menu list-inline list-unstyled">
                    <li class="profile">
                        <a href="#" data-toggle="dropdown" class="toggle" aria-expanded="false">
                            <img src="uploads/users/<?php echo $user['image'];?>" alt="user-image"
                                class="img-circle img-inline">
                            <span><?php echo remove_junk(ucfirst($user['name'])); ?> <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a href="profile.php?id=<?php echo (int)$user['id'];?>">
                                    <i class="glyphicon glyphicon-user"></i>
                                    Profile
                                </a>
                            </li>
                            <li>
                                <a href="edit_account.php" title="edit account">
                                    <i class="glyphicon glyphicon-cog"></i>
                                    Settings
                                </a>
                            </li>
                            <li class="last">
                                <a href="logout.php">
                                    <i class="glyphicon glyphicon-off"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="sidebar">
        <?php if(true): ?>
        <!-- admin menu -->
        <?php include_once('admin_menu.php');?>

        <?php elseif($user['user_level'] === '2'): ?>
        <!-- Special user -->
        <?php include_once('special_menu.php');?>

        <?php elseif($user['user_level'] === '3'): ?>
        <!-- User menu -->
        <?php include_once('user_menu.php');?>

        <?php endif;?>
    <?php endif;?>

    <div class="page">
        <div class="container-fluid">