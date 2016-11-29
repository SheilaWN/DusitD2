<?php 
include("access.php");
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
//End of header.php
include("../includes/conf.class.php");  
include("../includes/admin.class.php");
if(!isset($_GET['booking_id'])){
    header("location:admin-home.php");  
}
$bookingid = $bsiCore->ClearInput(base64_decode($_GET['booking_id']));
$viewdetailsquery = mysql_query("select bc.*, bb.* from bsi_bookings as bb, bsi_clients as bc where  bb.client_id=bc.client_id and booking_id=".$bookingid."");
$rowviewdetails = mysql_fetch_assoc($viewdetailsquery);  
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
    <link rel="stylesheet" type="text/css" href="css/jquery.validate.css" />
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include_once('admin_nav.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo VIEW_BOOKING_DETAILS;?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo VIEW_BOOKING_DETAILS;?> : <?=$bookingid?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <?php if(isset($_SERVER['HTTP_REFERER'])){
                  $pathArr = pathinfo($_SERVER['HTTP_REFERER']);//print_r($pathArr);
                if($pathArr['filename'] == 'view_active_or_archieve_bookings'){
                  echo '<input type="submit" value='.VIEWDETAILS_BACK.' style="background:#e5f9bb; cursor:pointer; cursor:hand; float:right" onClick="javascript:window.location.href=\'view_active_or_archieve_bookings.php?book_type='.$_SESSION['book_type'].'\'"/>';
                }else{
                  echo '<input type="submit" value='.VIEWDETAILS_BACK.' style="background:#e5f9bb; cursor:pointer; cursor:hand; float:right" onClick="javascript:window.location.href=\''.$_SERVER['HTTP_REFERER'].'\'"/>'; 
                }
                }
            ?>
            <hr style="margin-top:10px;" />
  <table style="font-family:Verdana, Geneva, sans-serif; font-size: 12px; background:#999999; width:700px; border:none;" cellpadding="4" cellspacing="1">
    <tr>
      <td align="left" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;" colspan="2"><b><?php echo VIEW_CUSTOMER_DETAILS;?></b></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;" width="150px"><?php echo VIEWDETAILS_NAME;?></td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['title']?>
        <?=$rowviewdetails['first_name']?>
        <?=$rowviewdetails['surname']?></td>
    </tr>
     <tr>
      <td align="left" style="background:#ffffff;"><?php echo VIEWDETAILS_ADDRESS;?></td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['street_addr']?></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;"><?php echo VIEWDETAILS_CITY;?></td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['city']?></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;"><?php echo VIEWDETAILS_STATE;?></td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['province']?></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;"><?php echo VIEWDETAILS_COUNTRY;?></td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['country']?></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;"><?php echo VIEWDETAILS_ZIP_AND_POST_CODE;?>:</td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['zip']?></td>
    </tr>
  
    <tr>
      <td align="left" style="background:#ffffff;"><?php echo VIEWDETAILS_PHONE;?></td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['phone']?></td>
      
   </tr>
    <tr>
      <td align="left" style="background:#ffffff;"><?php echo VIEWDETAILS_FAX;?></td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['fax']?></td>
    </tr>
    <tr>
      <td align="left" style="background:#ffffff;"><?php echo VIEWDETAILS_EMAIL;?></td>
      <td align="left" style="background:#ffffff;"><?=$rowviewdetails['email']?></td>
    </tr>
    
  </table>
  <?=$bsiAdminMain->paymentDetails($rowviewdetails['payment_type'], $bookingid);?><br />
  <table style="font-family:Verdana, Geneva, sans-serif; font-size: 12px; background:#999999; width:700px; border:none;" cellpadding="4" cellspacing="1">
    <tr>
      <td align="left" style="font-weight:bold; font-variant:small-caps; background:#eeeeee;" colspan="2"><b><?php echo VIEWDETAILS_BOOKING_STATUS;?></b></td>
    </tr>
    <tr>
      <?php
     $status='';
     $curdate=date('Y-m-d');
     $rowviewdetails['is_deleted'];
    if($rowviewdetails['is_deleted'] == 0 && $rowviewdetails['end_date']<$curdate ){
      $status=DEPARTED;
      echo '<td align="left" style="background:#ffffff;color:blue;"><strong>'.$status.'</strong></td>'; 
    }else if($rowviewdetails['is_deleted']==0 && $rowviewdetails['end_date']>$curdate){
      $status=ACTIVE;
      echo '<td align="left" style="background:#ffffff;color:green;"><strong>'.$status.'</strong></td>';  
    }else if($rowviewdetails['is_deleted']==1){
      $status=CANCELLED;
      echo '<td align="left" style="background:#ffffff;color:red;"><strong>'.$status.'</strong></td>';  
    }
    ?>
    </tr>
  </table>
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
