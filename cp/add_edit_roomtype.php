<?php 
include("access.php");
if(isset($_POST['submitRoomtype'])){
  include("../includes/db.conn.php"); 
  include("../includes/conf.class.php");
  include("../includes/admin.class.php");
  $bsiAdminMain->add_edit_roomtype();
  header("location:roomtype.php");  
  exit;
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
include("../includes/admin.class.php");
if(isset($_GET['id']) && $_GET['id'] != ""){
  $id = $bsiCore->ClearInput($_GET['id']);
  if($id){
    $result = mysql_query($bsiAdminMain->getRoomtypesql($id));
    $row    = mysql_fetch_assoc($result);
    $readonly = 'readonly="readonly"';
  }else{
    $row    = NULL;
    $readonly = '';
  }
}else{
  header("location:admin_capacity.php");
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
  <script type="text/javascript">
    function deleteRoomType(rtid){
      var ans=confirm('<?php echo DO_YOU_WANT_TO_DELETE_THE_SELECTED_ROOM_TYPE;?>');
      if(ans){
        window.location='<?=$_SERVER['PHP_SELF']?>?rdelid='+rtid;
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
                    <h1 class="page-header">Room Type Manager</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?php echo ROOM_TYPE_ADD_AND_EDIT;?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                          <form action="<?=$_SERVER['PHP_SELF']?>" method="post" id="form1" enctype="multipart/form-data">
                                <div class="col-lg-6">       
                                  <div class="form-group">
                                      <label><?php echo ROOM_TYPE_TITLE; ?>:</label>
                                      <input type="text" name="roomtype_title" id="roomtype_title" class="required form-control"  value="<?=$row['type_name']?>" size="15"/>&nbsp;&nbsp;<?php echo EXAMPLE_DELUXE_AND_STANDARD; ?>
                                  </div>
                                  <div class="form-group">
                                      <label><?php echo ROOM_TYPE_IMG; ?>:</label>
                                      <input type="file" name="img" id="img" class="form-control" /><?php if($row['img'] != ""){ echo '<span style="margin-left:15px"><a href="../gallery/'.$row['img'].'" target="_blank"><strong>View Image</strong></a>&nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF0000"><strong>Delete Image</strong>&nbsp;</font><input type="checkbox" name="delimg"></span>'; }?>
                                  </div>
                                  <input type="hidden" name="addedit" value="<?=$id?>">
                                  <div class="form-group">
                                     <input type="submit" value="<?php echo ROOM_TYPE_SUBMIT;?>" name="submitRoomtype" class="btn btn-primary"/>
                                  </div>
                                </div>
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
<script src="js/jquery.validate.js" type="text/javascript"></script>
<?php include("footer.php"); ?>