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
        <?php include_once('admin_nav.php');?>

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
