<?php 

include ("access.php"); 

if(isset($_POST['act'])){

  include("../includes/db.conn.php");

  include("../includes/admin.class.php");

  $bsiAdminMain->updateCustomerLookup();

  header("location:customerlookup.php"); 

  exit;

}

$update=base64_decode($_GET['update']);

// include("header.php");
include("../includes/db.conn.php");
include("language.php");
$path=pathinfo($_SERVER['PHP_SELF']);
$filename=$path['basename'];
$get_sub_title=mysql_query("select * from bsi_adminmenu where url='".$filename."'");
if(mysql_num_rows($get_sub_title)){
  $get_sub_title_row=mysql_fetch_array($get_sub_title);
  $get_parent_title=mysql_query("select * from bsi_adminmenu where id='".$get_sub_title_row['parent_id']."'");
  $get_parent_title_row=mysql_fetch_array($get_parent_title);
  $main_title=$get_parent_title_row['name'].' > '.$get_sub_title_row['name'];
  $_SESSION['main_title']=$main_title;
}
if($filename=='admin-home.php')
$main_title="Home";
elseif($filename=='change_password.php')
$main_title="Change Password";
else
$main_title=$_SESSION['main_title'];

if(isset($update)){

  include("../includes/conf.class.php");

  include("../includes/admin.class.php");

  $row   = $bsiAdminMain->getCustomerLookup($update);

  $title = $bsiAdminMain->getTitle($row['title']);

}else{

  header("location:customerlookup.php");

}

 ?>     
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DusitD2</title>

    <!-- Bootstrap Core CSS -->
    <link href="../admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="../admin/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="../admin/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../admin/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../admin/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script src="../admin/vendor/jquery/jquery.min.js"></script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">DusitD2</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                <!-- <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-bell fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-alerts">
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-comment fa-fw"></i> New Comment
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                    <span class="pull-right text-muted small">12 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-envelope fa-fw"></i> Message Sent
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-tasks fa-fw"></i> New Task
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="#">
                                <div>
                                    <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                    <span class="pull-right text-muted small">4 minutes ago</span>
                                </div>
                            </a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a class="text-center" href="#">
                                <strong>See All Alerts</strong>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </li>
                    </ul>
                    <!-- /.dropdown-alerts 
                </li> -->
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!-- <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>-->
                        <li><a href="change_password.php"><i class="fa fa-user fa-fw"></i> Change Password</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="admin-home.php"><i class="fa fa-dashboard fa-fw"></i> Home</a>
                        </li>
                        <li>
                            <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Hotel Manager<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="admin_hotel_details.php">Hotel Details</a>
                                </li>
                                <li>
                                    <a href="room_list.php">Room Manager</a>
                                </li>
                                <li>
                                    <a href="roomtype.php">Room Type Manager</a>
                                </li>
                                <li>
                                    <a href="admin_capacity.php">Capacity Manager</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Price Manager<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="priceplan.php">Price Plan Manager</a>
                                </li>
                                <li>
                                    <a href="advance_payment.php">Advance Payment</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Booking Manager<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="view_bookings.php">View Booking List</a>
                                </li>
                                <li>
                                    <a href="customerlookup.php">Customer Lookup</a>
                                </li>
                                <li>
                                    <a href="calendar_view.php">Calendar View</a>
                                </li>
                                <li>
                                    <a href="admin_block_room.php">Room Blocking</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="manage_language.php"><i class="fa fa-table fa-fw"></i> Manage Languages</a>
                        </li>
                        <li>
                            <a href="regadmin.php"><i class="fa fa-edit fa-fw"></i> Register Administrator</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i>Settings<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="global_setting.php">Global Setting</a>
                                </li>
                                <li>
                                    <a href="payment_gateway.php">Payment Gateway</a>
                                </li>
                                <li>
                                    <a href="email_content.php">Email Contents</a>
                                </li>
                                <li>
                                    <a href="adminmenu.list.php">Admin Menu Manager</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Customer Details</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Customer Details Edit
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="form-group">
                                <label>Title:</label>
                                <?=$title?>
                            </div>
                            <div class="form-group">
                                <label>First Name:</label>
                                <input class="form-control" type="text" class="required" value="<?=$row['first_name']?>" style="width:200px;" name="fname" id="fname"/>
                            </div>
                            <div class="form-group">
                                <label>Last Name:</label>
                                <input class="form-control" type="text" class="required" value="<?=$row['surname']?>" style="width:200px;" name="sname" id="sname"/>
                            </div>
                            <div class="form-group">
                                <label>Street Address:</label>
                                <input class="form-control" type="text" class="required" value="<?=$row['street_addr']?>" style="width:250px;" name="sadd" id="sadd"/>
                            </div>
                            <div class="form-group">
                                <label>City:</label>
                                <input class="form-control" type="text" class="required" value="<?=$row['city']?>"  name="city" id="city" style="width:250px;"/>
                            </div>
                            <div class="form-group">
                                <label>Province:</label>
                                <input class="form-control" type="text" class="required" value="<?=$row['province']?>"  name="province" id="province" style="width:250px;"/>
                            </div>
                            <div class="form-group">
                                <label>Zip / Post code:</label>
                                <input class="form-control" type="text" class="required" value="<?=$row['zip']?>"  name="zip" id="zip" style="width:250px;"/>
                            </div>
                            <div class="form-group">
                                <label>Country:</label>
                                <input class="form-control" type="text" class="required" value="<?=$row['country']?>"  name="country" id="country" style="width:250px;"/>
                            </div>
                            <div class="form-group">
                                <label>Phone Number:</label>
                                <input class="form-control" type="text" class="required" value="<?=$row['phone']?>"  name="phone" id="phone" style="width:250px;"/>
                            </div>
                            <div class="form-group">
                                <label>Fax:</label>
                                <input class="form-control" type="text" value="<?=$row['fax']?>"  name="fax" id="fax" style="width:250px;"/>
                            </div>
                            <div class="form-group">
                                <label>Email Id:</label>
                                <input class="form-control" type="text" value="<?=$row['email']?>"  name="email" id="email" style="width:250px;" readonly="readonly" style="width:250px;"/>
                                <input type="hidden" name="httpreffer" value="<?=$_SERVER['HTTP_REFERER']?>" />
                                <input type="hidden" name="cid" value="<?=$row['client_id']?>">
                    <input type="hidden" name="act" value="1">
                            </div>
                            <div>
                              <input type="submit" value="Submit"  style=" cursor:pointer; cursor:hand;" class="btn btn-primary" />
                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    

    <!-- Bootstrap Core JavaScript -->
    <script src="../admin/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../admin/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- DataTables JavaScript -->
    <script src="../admin/vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="../admin/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="../admin/vendor/datatables-responsive/dataTables.responsive.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../admin/dist/js/sb-admin-2.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>

</body>

</html>
