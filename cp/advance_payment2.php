<?php 
include("access.php");
if(isset($_POST['act_save'])){
		include("../includes/db.conn.php");
		$month_num1=$_POST;
		for($j=1;$j<=12;$j++){
			mysql_query("update bsi_advance_payment set deposit_percent='".$month_num1[$j]."' where month_num=".$j);
		}
		header("location:advance_payment.php");
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

include("../includes/conf.class.php");
$depo_val='';
	if($bsiCore->config['conf_enabled_deposit']==1){
		$depo_val  = 1;
	$deposit_check = "checked";
	}else{
		$depo_val=0;
	$deposit_check = "";
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
    <script type="text/javascript" src="../js/jquery-ui.min.js"></script>
	<script type="text/javascript" src="../js//dtpicker/jquery.ui.datepicker-<?=$langauge_selcted?>.js"></script>
</head>

<body>
	<script type="text/javascript">
		$(document).ready(function(){
				if(<?=$depo_val?>==1){								 
					showDeposit();
				}
		  		$('#chk_deposit').click(function() {
					showDeposit();		
				});
				
				function showDeposit(){
				 var chk_deposit=$('#chk_deposit').attr('checked');
					var querystr = 'actioncode=4&type=2&chk_deposit='+chk_deposit; 
					$.post("admin_ajax_processor.php", querystr, function(data){											  
						if(data.errorcode == 0){
							$('#showdeposit').html(data.getresult)
						}
						}, "json");
			}
		});
	</script>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include_once('admin_nav.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo ADVANCE_PAYMENT_SETTING; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo ADVANCE_PAYMENT_SETTING; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
	                        <form action="<?=$_SERVER['PHP_SELF']?>" method="post" id="form1">
					          <table cellpadding="5" cellspacing="2" border="0" width="100%">
					          <thead>
					          <tr>
					            <th colspan="2"  align="left"><input type="checkbox" <?=$deposit_check?>  id="chk_deposit" name="chk_deposit" value=""/><?php echo ENABLED_MONTHLY_DEPOSIT_SCHEME;?></th>
					            
					          </tr>
					          <tr><th colspan="2" colspan="2"><hr /></th></tr>
					        </thead>
					        <tbody id="showdeposit">
					        </tbody>
					          </table>
					        </form>
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
        $("#roomtype_id").attr("class","form-control");
        $("#capacity_id").attr("class","form-control");
     });
         
</script> 
<script src="js/jquery.validate.js" type="text/javascript"></script>
<?php include("footer.php"); ?>