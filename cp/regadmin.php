<?php 
$reg_error = null;
include ("access.php");
if(isset($_POST['sbt_details'])){
  include("../includes/db.conn.php");
  
  $pass = $_POST['Password'];
  $conf = $_POST['confirm_password'];
  if ($pass==$conf) {
     mysql_query("INSERT INTO `bsi_admin` (`pass`, `username`, `access_id`, `f_name`, `l_name`, `email`, `designation`, `status`) VALUES
    (".$_POST['Password'].", ".$_POST['username'].", 1, ".$_POST['first_name'].", ".$_POST['last_name'].", ".$_POST['email'].", ".$_POST['position'].", 1);");
    header("location:admin_hotel_details.php");
  } else {
    $reg_error = 'Passwords not similar';
  }
}

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
 
// include("header.php"); 
include("../includes/conf.class.php");
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
        <?php include_once('admin_nav.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Register Administrator</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <div style="color: red;"><?php if($reg_error){echo $reg_error;} ?></div>
                            <form action="<?=$_SERVER['PHP_SELF']?>" method="post" id="form1" enctype="multipart/form-data">
                                <div class="col-lg-6">       
                                  <div class="form-group">
                                      <label>First Name:</label>
                                      <input type="text" name="first_name" class="required form-control" size="50" placeholder="First Name"/>
                                  </div>
                                  <div class="form-group">
                                      <label>Last Name:</label>
                                      <input type="text" name="last_name" class="required form-control" size="50" placeholder="First Name"/>
                                  </div>
                                  <div class="form-group">
                                      <label>Email Adderess</label>
                                      <input type="text" name="email" class="required form-control" size="50" placeholder="First Name"/>
                                  </div>
                                  <div class="form-group">
                                      <label>Position:</label>
                                      <input type="text" name="position" class="required form-control" size="50" placeholder="First Name"/>
                                  </div>
                                  <div class="form-group">
                                      <label>Username:</label>
                                      <input type="text" name="username" class="required form-control" size="50" placeholder="First Name"/>
                                  </div>
                                  <div class="form-group">
                                      <label>Password:</label>
                                      <input type="text" name="Password" class="required form-control" size="50" placeholder="First Name"/>
                                  </div>
                                  <div class="form-group">
                                      <label>Confirm Password:</label>
                                      <input type="text" name="confirm_password" class="required form-control" size="50" placeholder="First Name"/>
                                  </div>
                                  <input type="hidden" name="addedit" value="<?=$id?>">
                                  <div class="form-group">
                                     <input type="submit" value="Register Administrator" name="submitRoomtype" class="btn btn-primary"/>
                                  </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
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
