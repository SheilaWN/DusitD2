<?php 
include("access.php");

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

    <link rel="stylesheet" type="text/css" href="css/jquery.validate.css" />
  <link rel="stylesheet" type="text/css" href="../template/css/datepicker.css" />
    

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script src="../admin/vendor/jquery/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.2.1.js"></script>
    <script type="text/javascript" src="../js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../js//dtpicker/jquery.ui.datepicker-<?=$langauge_selcted?>.js"></script>
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
    
</head>

<body>
 <script type="text/javascript">
  $(document).ready(function(){
    disableInput("#submit");
    $('#book_type').change(function(){
      if($('#book_type').val() != ""){
        enableInput("#submit");     
      }else{
        disableInput("#submit");
      }
    });
    //Enabling Disabling Function
    function disableInput(id){
      jQuery(id).attr('disabled', 'disabled');
    }
    function enableInput(id){
      jQuery(id).removeAttr('disabled');  
    }
  });
</script>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include_once('admin_nav.php');?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">VIEW_BOOKING_LIST</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo VIEW_BOOKING_LIST;?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                           <form action="view_active_or_archieve_bookings.php" method="post" id="form1">
                      <table cellpadding="5" cellspacing="2" border="0">
                        <tr>
                        <td valign="middle"><strong><?php echo SELECT_BOOKING_TYPE;?></strong>:</td>
                        <td><select name="book_type" id="book_type"><option value="">---<?php echo VIEW_BOOKINGS_SELECT_TYPE;?>---</option><option value="1"><?php echo ACTIVE_BOOKING;?></option><option value="2"><?php echo BOOKING_HISTORY;?></option></select> </td>
                        
                        </tr>
                        
                       <tr><td><strong><?=VB_DATE_RANGE?>(<?=VB_OPTIONAL?>)</strong></td><td><input id="txtFromDate" name="fromDate" style="width:68px" type="text" readonly="readonly" />
                  <span style="padding-left:0px;"><a id="datepickerImage" href="javascript:;"><img src="../images/month.png" height="16px" width="16px" style=" margin-bottom:-4px;" border="0" /></a></span>&nbsp;&nbsp;&nbsp;&nbsp; <strong><?=VB_TO?></strong> &nbsp;&nbsp;&nbsp;&nbsp;<input id="txtToDate" name="toDate" style="width:68px" type="text" readonly="readonly"/>
                  <span style="padding-left:0px;"><a id="datepickerImage1" href="javascript:;"><img src="../images/month.png" height="18px" width="18px" style=" margin-bottom:-4px;" border="0" /></a></span>&nbsp;&nbsp;&nbsp;&nbsp;<strong><?=VB_BY?></strong>&nbsp;&nbsp;&nbsp;&nbsp;<select name="shortby"><option value="booking_time" selected="selected"><?=VIEW_ACTIVE_BOOKING_DATE?></option><option value="start_date"><?=ROOM_BLOCK_CHECK_IN_DATE?></option><option value="end_date"><?=ROOM_BLOCK_CHECK_OUT_DATE?></option></select></td></tr>
                       <tr><td></td><td><input type="submit" value="<?php echo VIEW_BOOKINGS_SUBMIT;?>" name="submit" id="submit" style="background:#e5f9bb; cursor:pointer; cursor:hand;"/></td></tr>
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

    



<link rel="stylesheet" type="text/css" href="../css/datepicker.css" />

   <script type="text/javascript">
    $(document).ready(function(){
      $.datepicker.setDefaults( $.datepicker.regional[ "<?=$langauge_selcted?>" ] );
     $.datepicker.setDefaults({ dateFormat: '<?=$bsiCore->config['conf_dateformat']?>' });
        $("#txtFromDate").datepicker({
            maxDate: "+365D",
            numberOfMonths: 2,
            onSelect: function(selected) {
          var date = $(this).datepicker('getDate');
             if(date){
                date.setDate(date.getDate());
              }
              $("#txtToDate").datepicker("option","minDate", date)
            }
        });
     
        $("#txtToDate").datepicker({ 
            maxDate:"+365D",
            numberOfMonths: 2,
            onSelect: function(selected) {
               $("#txtFromDate").datepicker("option","maxDate", selected)
            }
        });  
     $("#datepickerImage").click(function() { 
        $("#txtFromDate").datepicker("show");
      });
     $("#datepickerImage1").click(function() { 
        $("#txtToDate").datepicker("show");
      });
    });
    </script>
<script src="js/jquery.validate.js" type="text/javascript"></script>
<?php include("footer.php"); ?>