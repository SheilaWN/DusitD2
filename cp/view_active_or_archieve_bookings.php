<?php 
include("access.php");
if(isset($_REQUEST['delete'])){
	include("../includes/db.conn.php");
	include("../includes/conf.class.php");
	include("../includes/admin.class.php");	
	$bsiAdminMain->booking_cencel_delete(2);
	header("location:view_active_or_archieve_bookings.php?book_type=".$_GET['book_type']);
	exit;
}
if(isset($_REQUEST['cancel'])){
	include("../includes/db.conn.php");
	include("../includes/conf.class.php");	
	include("../includes/admin.class.php");
	include("../includes/mail.class.php");	
	$bsiAdminMain->booking_cencel_delete(1); 
	header("location:view_active_or_archieve_bookings.php?book_type=".$_GET['book_type']);
	exit;
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
if($filename=='admin-home.php')
$main_title="Home";
elseif($filename=='change_password.php')
$main_title="Change Password";
else
$main_title=$_SESSION['main_title'];

include("../includes/conf.class.php");	
include("../includes/admin.class.php");
if(isset($_GET['book_type'])){
	$book_type = $bsiCore->ClearInput($_GET['book_type']);
	
}else{
	$book_type = $bsiCore->ClearInput($_POST['book_type']);
	$_SESSION['book_type'] = $book_type;
	$_SESSION['fromDate']=$bsiCore->ClearInput($_POST['fromDate']);
	$_SESSION['toDate']=$bsiCore->ClearInput($_POST['toDate']);
	$_SESSION['shortby']=$bsiCore->ClearInput($_POST['shortby']);
}
if($_SESSION['fromDate'] !="" and $_SESSION['toDate'] != ""){
$condition=" and (DATE_FORMAT(".$_SESSION['shortby'].", '%Y-%m-%d') between '".$bsiCore->getMySqlDate($_SESSION['fromDate'])."' and '".$bsiCore->getMySqlDate($_SESSION['toDate'])."')";
$shortbyarr=array("booking_time"=>VIEW_ACTIVE_BOOKING_DATE, "start_date"=>CUSTOMER_BOOKING_CHECK_IN_DATE, "end_date"=>CUSTOMER_BOOKING_CHECK_OUT_DATE);
$text_cond="( ".$_SESSION['fromDate']."  ".VB_TO." ".$_SESSION['toDate']."  ".VB_BY." ".$shortbyarr[$_SESSION['shortby']]." )";
}else{
$condition="";
$text_cond="";
}

$query = $bsiAdminMain->getBookingInfo($book_type, $clientid=0, $condition);

$html  = $bsiAdminMain->getHtml($book_type, $query);
$title_hr = array(1=>VB_ACTIVE, 2=>VB_HISTORY);
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
	<script type="text/javascript">
	function cancel(bid){
		var answer = confirm ("Are you sure want to cancel Booking?");
		if (answer)
			window.location="<?=$_SERVER['PHP_SELF']?>?cancel="+bid+"&book_type="+<?=$book_type?>;
	}
	
	function deleteBooking(bid){
		var answer = confirm ("Are you sure want to delete Booking?");
		if (answer)
			window.location="<?=$_SERVER['PHP_SELF']?>?delete="+bid+"&book_type="+<?=$book_type?>;
	}
		
	function myPopup2(booking_id){
		var width = 730;
		var height = 650;
		var left = (screen.width - width)/2;
		var top = (screen.height - height)/2;
		var url='print_invoice.php?bid='+booking_id;
		var params = 'width='+width+', height='+height;
		params += ', top='+top+', left='+left;
		params += ', directories=no';
		params += ', location=no';
		params += ', menubar=no';
		params += ', resizable=no';
		params += ', scrollbars=yes';
		params += ', status=no';
		params += ', toolbar=no';
		newwin=window.open(url,'Chat', params);
		if (window.focus) {newwin.focus()}
		return false;
   }
</script> 
    <div id="wrapper">

        <!-- Navigation -->
        <?php include_once('admin_nav.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?=$title_hr[$book_type]?>  <?=$text_cond?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?=LAST_10_BOOKING?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <?=$html?>
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
