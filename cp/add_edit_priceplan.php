<?php
include ("access.php");
if(isset($_POST['act']) && $_POST['act'] == 1){
	include("../includes/db.conn.php");
	include("../includes/conf.class.php");
	include("../includes/admin.class.php");
	if($_POST['roomtype_edit'] > 0){
		$bsiAdminMain->priceplan_edit($_POST['roomtype_edit']);
	}else{
		$bsiAdminMain->priceplan_add_edit(); 
	}
	exit;
}
$pageid = 36;
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
$getHTML  = array();
$getHTML1 = array();
$getHTML2 = array();
$row      = array();
$id=$bsiCore->ClearInput($_REQUEST['rtype']);
if($id){
	$text     = '';
	$start_dt = mysql_real_escape_string($_REQUEST['start_dt']);
	if($start_dt != '0000-00-00'){
		
		$row=mysql_fetch_assoc(mysql_query("SELECT bp.*, DATE_FORMAT(start_date, '".$bsiCore->userDateFormat."') AS start_date1,
		DATE_FORMAT(end_date, '".$bsiCore->userDateFormat."') AS end_date1, start_date, end_date, bc.title, bc.capacity FROM `bsi_priceplan` as bp,bsi_capacity as bc
		where `plan_id`='".$id."' and start_date='".$start_dt."' and default_plan=0 and bp.capacity_id=bc.id group by
		`roomtype_id`,`start_date`"));
		
	}else{
		
		$row = mysql_fetch_assoc(mysql_query("SELECT bp.*, DATE_FORMAT(start_date, '".$bsiCore->userDateFormat."') AS start_date1,
		DATE_FORMAT(end_date, '".$bsiCore->userDateFormat."') AS end_date1, start_date, end_date, bc.title, bc.capacity FROM `bsi_priceplan` as bp,bsi_capacity as bc 
		where `plan_id`='".$id."' and start_date='".$start_dt."' and default_plan=1 and bp.capacity_id=bc.id group by 
		`roomtype_id`,`start_date`"));
		
	}
	$rtypeName = mysql_fetch_assoc(mysql_query("select * from bsi_roomtype where roomtype_ID='".$row['roomtype_id']."'"));
	
	$getHTML   = $bsiAdminMain->getDatepicker($id, $rtypeName['type_name'], $row['start_date'], $row['end_date'], $row);
	
	$getHTML1  = $getHTML['html'];
	
	$getHTML2  = $getHTML['editPriceplanHTML'];
	
	$text      = '';
	
}else{
	
	$getHTML   = $bsiAdminMain->getDatepicker();
	
	$getHTML1  = $getHTML['html'];
	
	$getHTML2  = $getHTML['editPriceplanHTML'];
	
	$start_dt  = '0000-00-00';
	
	$text      = PLEASE_SELECT_ROOMTYPE_FROM_DROPDOWN;
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
	<script type="text/javascript" src="../js/dtpicker/jquery.ui.datepicker-<?=$langauge_selcted?>.js"></script>
</head>
<body>
<script type="text/javascript" charset="">
   $(document).ready(function() {
   $("#priceplanaddeit").validate();
   $('#roomtype_id').change(function() {
         if($('#roomtype_id').val() != 0){
			var querystr = 'actioncode=3&roomtype_id='+$('#roomtype_id').val();		
			$.post("admin_ajax_processor.php", querystr, function(data){												 
				if(data.errorcode == 0){
					 $('#default_capacity').html(data.strhtml)
				}else{
				    $('#default_capacity').html("<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:12px;\">'<?php  echo NOT_FOUND;?>'</span>")
				}
			}, "json");
		} else {
		 $('#default_capacity').html("<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:12px;\">'<?php echo PLEASE_SELECT_ROOMTYPE_FROM_DROPDOWN_ALERT; ?>'</span>")
		}
	});
	
	if($('#roomtype').val() == 0){
		$('#default_capacity').html("<span style=\"font-family:Arial, Helvetica, sans-serif; font-size:12px;\">'<?php echo PLEASE_SELECT_ROOMTYPE_FROM_DROPDOWN_ALERT; ?>'</span>")
	}
});
 
$(document).ready(function(){
	$.datepicker.setDefaults( $.datepicker.regional[ "<?=$langauge_selcted?>" ] );
	$.datepicker.setDefaults({ dateFormat: '<?=$bsiCore->config['conf_dateformat']?>' });
    $("#txtFromDate").datepicker({
        minDate: 0,
        maxDate: "+365D",
        numberOfMonths: 2,
        onSelect: function(selected) {
        var date = $(this).datepicker('getDate');
        if(date){
            date.setDate(date.getDate() + <?=$bsiCore->config['conf_min_night_booking']?>);
        }
          $("#txtToDate").datepicker("option","minDate", date)
        }
    });
    $("#txtToDate").datepicker({ 
        minDate: 0,
        maxDate:"+365D",
        numberOfMonths: 2,
        onSelect: function(selected) {
           $("#txtFromDate").datepicker("option","maxDate", selected)
        }
    });
	
	$("#txtFromDate").datepicker();
	$("#datepickerImage").click(function() { 
		$("#txtFromDate").datepicker("show");
	});
	
	$("#txtToDate").datepicker();
	$("#datepickerImage1").click(function() { 
		$("#txtToDate").datepicker("show");
	});    
});
</script>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include_once('admin_nav.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo PRICE_PLAN_ADD_AND_EDIT; ?></h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo PRICE_PLAN_ADD_AND_EDIT; ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
	                        <span style="font-size:16px; font-weight:bold"><?php echo PRICE_PLAN_ADD_AND_EDIT;?></span>
                            <input type="button" value="<?php echo PRICE_PLAN_BACK;?>" onClick="window.location.href='priceplan.php'" style="background:#e5f9bb; cursor:pointer; cursor:hand; float:right; "/>
                        	<form action="" method="post" id="form1">
                                <input type="hidden" name="roomtype_edit" value="<?=$id?>" />
                                <input type="hidden" name="roomtype" value="<?=$row['roomtype_id']?>" />
                                <input type="hidden" name="start_date_old" value="<?=$start_dt?>" />
                                <input type="hidden" name="act" value="1" />
                                <table cellpadding="5" cellspacing="2" border="0">
                                  <tr>
                                    <td colspan="2" align="center" style="font-size:14px; color:#006600; font-weight:bold"><?php if(isset($error_msg)) echo $error_msg; ?></td>
                                  </tr>
                                  <?=$getHTML1?>
                                  <tr>
                                    <td id="default_capacity" colspan="2">
                                      <?=$text?>
                                      <?=$getHTML2?>
                                    </td>
                                  </tr> 
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
     });    
</script> 
<script src="../js/jquery.validate_pp.js" type="text/javascript"></script>
<?php include("footer.php"); ?>