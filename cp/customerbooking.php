<?php 
include ("access.php");
if(isset($_REQUEST['delete'])){
	include("../includes/db.conn.php");
	include("../includes/conf.class.php");
	include("../includes/admin.class.php");
	$bsiAdminMain->booking_cencel_delete(2);
	$client = base64_encode($_REQUEST['client']);
	header("location:customerbooking.php?client=".$client);
	exit;
}
if(isset($_REQUEST['cancel'])){
	include("../includes/db.conn.php");
	include("../includes/conf.class.php");	
	include("../includes/admin.class.php");
	include("../includes/mail.class.php");	
	$bsiAdminMain->booking_cencel_delete(1); 
	$client = base64_encode($_REQUEST['client']);
	header("location:customerbooking.php?client=".$client);
	exit;
}
if(isset($_GET['client'])){
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
	$client    = mysql_real_escape_string(base64_decode($_GET['client']));
	$delClient = $client;
	$htmlArr   = $bsiAdminMain->fetchClientBookingDetails($client);
	
	$html      = $htmlArr['html'];
}else{
	header("location:customerlookup.php");
	exit;
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
<script type="text/javascript">
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
function cancel(bid){
	var answer = confirm ('<?php  echo CUSTOMER_BOOKING_ARE_YOU_SURE_WANT_TO_CANCEL_BOOKING; ?>');
	if (answer)
		window.location="<?=$_SERVER['PHP_SELF']?>?cancel="+bid+"&client="+<?=$delClient?>;
}
function booking_delete(delid){
	var answer = confirm ('<?php echo ARE_YOU_SURE_WANT_TO_DELETE_BOOKING_ALERT; ?>');
	if (answer)
		window.location="<?=$_SERVER['PHP_SELF']?>?delete="+delid+"&client="+<?=$delClient?>;
	}
</script>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include_once('admin_nav.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Customer Lookup</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo CUSTOMER_BOOKING_LIST_OF;?> <?=$htmlArr['clientName']?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
								   <tr>
								    <th width="9%" nowrap><?php echo CUSTOMER_BOOKING_ID;?></th>
								    <th width="18%" nowrap><?php echo CUSTOMER_BOOKING_NAME;?></th>
								    <th width="8%" nowrap="nowrap"><?php echo CUSTOMER_BOOKING_CHECK_IN_DATE;?></th>
								    <th width="10%" nowrap><?php echo CUSTOMER_BOOKING_CHECK_OUT_DATE;?></th>
								    <th width="10%" nowrap><?php echo CUSTOMER_BOOKING_AMOUNT;?></th>
								    <th width="9%" nowrap><?php echo CUSTOMER_BOOKING_DATE;?></th>
								    <th width="8%" nowrap="nowrap"><?php echo CUSTOMER_BOOKING_STATUS;?></th>
								    <th width="25%">&nbsp;</th>
								   </tr>
								  </thead>
								  <?=$html?>
                            </table>
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
    <script type="text/javascript" src="js/bsi_datatables.js"></script>
	<link href="css/data.table.css" rel="stylesheet" type="text/css" />
	<link href="css/jqueryui.css" rel="stylesheet" type="text/css" />

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
