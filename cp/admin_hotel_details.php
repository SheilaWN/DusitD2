<?php 
include ("access.php");
if(isset($_POST['sbt_details'])){
    include("../includes/db.conn.php");
    include("../includes/admin.class.php");
    include("../includes/conf.class.php");
    $bsiAdminMain->hotel_details_post();
    header("location:admin_hotel_details.php");
}
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
// echo "<pre>";print_r($filename);die();
// if($filename=='admin-home.php')
// $main_title="Home";
// elseif($filename=='change_password.php')
// $main_title="Change Password";
// else
// $main_title=$_SESSION['main_title'];

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

    <title>Admin Module</title>

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
                    <h1 class="page-header">Hotel Details</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo HOTEL_DETAILS; ?>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form action="<?=$_SERVER['PHP_SELF']?>" method="post" id="form1">
                                        <div class="form-group">
                                            <label><?php echo HOTEL_NAME;?>:</label>
                                            <input type="text" name="hotel_name" class="required form-control" size="50" value="<?=$bsiCore->config['conf_hotel_name']?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo STREET_ADDRESS;?>:</label>
                                            <input type="text" name="str_addr" class="required form-control" size="40" value="<?=$bsiCore->config['conf_hotel_streetaddr']?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo CITY;?>:</label>
                                            <input type="text" name="city" size="30" class="required form-control" value="<?=$bsiCore->config['conf_hotel_city']?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo STATE; ?>:</label>
                                            <input type="text" name="state" class="required form-control" size="30" value="<?=$bsiCore->config['conf_hotel_state']?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo COUNTRY; ?>:</label>
                                            <input type="text" name="country" class="required form-control" size="30" value="<?=$bsiCore->config['conf_hotel_country']?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo ZIP_AND_POST_CODE;  ?>:</label>
                                            <input type="text" name="zipcode" class="required form-control" size="10" value="<?=$bsiCore->config['conf_hotel_zipcode']?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo PHONE_NUMBER; ?>:</label>
                                            <input type="text" name="phone" class="required form-control" size="15" value="<?=$bsiCore->config['conf_hotel_phone']?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo FAX; ?>:</label>
                                            <input type="text" name="fax" class="form-control" size="15" value="<?=$bsiCore->config['conf_hotel_fax']?>"/>
                                        </div>
                                        <div class="form-group">
                                            <label><?php echo EMAIL_ID; ?>:</label>
                                            <input type="text" name="email" class="required email form-control" size="30" value="<?=$bsiCore->config['conf_hotel_email']?>"/>
                                        </div>
                                        <div class="form-group">
                                           <input type="submit" value="<?php echo SUBMIT;?>" name="sbt_details" id="sbt_details" class="btn btn-primary"/>
                                        </div>
                                        
                                    </form>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
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

    <script type="text/javascript">
    $(document).ready(function() {
        $("#form1").validate();
        
     });
         
</script> 
<script src="js/jquery.validate.js" type="text/javascript"></script>
<?php include("footer.php"); ?>