<?php 
include ("access.php");
if(isset($_REQUEST['pln_del'])){
	include("../includes/db.conn.php");
	include("../includes/conf.class.php");
	$pln_del = base64_decode($_REQUEST['pln_del']);
	$pln_del = explode("|",$pln_del);
	$r_id = $bsiCore->ClearInput($pln_del[3]);
	mysql_query("delete from bsi_priceplan where start_date='$pln_del[1]' and end_date='$pln_del[2]' and roomtype_id=".$r_id);
	$_SESSION['roomtype_id'] = $pln_del[3];
	header("location: priceplan.php");
}
$pageid=36;
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
include("../includes/conf.class.php");
include("../includes/admin.class.php");
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
<script>
	$(document).ready(function(){
		
		 $('#roomtype').change(function() { 
			getPriceplan();
		 });
		 if($('#roomtype').val() > 0){
			 getPriceplan();
		 }
		 function getPriceplan(){
			 if($('#roomtype').val() != 0){
				var querystr = 'actioncode=2&roomtype_id='+$('#roomtype').val();
				$.post("admin_ajax_processor.php", querystr, function(data){						 
					if(data.errorcode == 0){ 
						$('#getpriceplanHtml').html(data.strhtml)
					}else{
						$('#getpriceplanHtml').html('<tr><td colspan="12"><?php echo NO_AVAILABLE_DATA_FOUND; ?> !</td></tr>')
					}
					
				}, "json");
			}
			if($('#roomtype').val() == 0){
				$('#getpriceplanHtml').html('<tr><td colspan="12"><?php echo PRICEPLAN_PLEASE_SELECT_ROOMTYPE_FIRST; ?>!</td></tr>')
			}
		 }
	});
function priceplandelete(rid){
	var ans=confirm('+<?php echo DO_YOU_WANT_TO_DELETE_SELECTED_PRICEPLAN; ?>+');
	if(ans){
		window.location='<?=$_SERVER['PHP_SELF']?>?pln_del='+rid;
		return true;
		
	}else{
		return false;
		
	}
	
}
</script>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include_once('admin_nav.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Price Plan Manager</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo PRICE_PLAN_PRICE_LIST;?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        	<span style="font-size:16px; font-weight:bold"><?php echo PRICE_PLAN_PRICE_LIST;?></span>
								<input type="button" value="<?php echo ADD_NEW_PRICEPLAN; ?>" onClick="window.location.href='add_edit_priceplan.php?rtype=0&start_dt=0'" style="background:#e5f9bb; cursor:pointer; cursor:hand; float:right; " />
								<hr style="margin-top:10px;" />


							<table width="100%"><tr><td width="80%" align="left"><?php if(isset($_SESSION['error_msg'])){ echo $_SESSION['error_msg']; }
								unset($_SESSION['error_msg']);?></td><td align="right"></td></tr></table>
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
							    <thead>
							      <tr>
							        <th nowrap="nowrap" width="15%" align="left"><?php echo PRICE_PLAN_SELECT_ROOM_TYPE;?>:</th>
          							<th  colspan="11" align="left"><?php 
										if(isset($_SESSION['roomtype_id'])){
											echo $select_rtype=$bsiAdminMain->getRoomtype($_SESSION['roomtype_id']);
										}else{
											echo $select_rtype=$bsiAdminMain->getRoomtype();
										}
										?></th>
							      </tr>
							      <tr><th colspan="12"><hr /></th></tr>
							    </thead>
							    <tbody id="getpriceplanHtml">
							    	<tr><td colspan="12"> <?php echo PLEASE_SELECT_ROOMTYPE_FIRST;?> !</td></tr>
							    </tbody>
							  </table>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
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