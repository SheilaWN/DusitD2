<?php
session_start(); 
include("../includes/db.conn.php");
//******************************************
$sql_lang_select=mysql_query("select * from bsi_language order by lang_title");
$lang_dd='';
while($row_lang_select=mysql_fetch_assoc($sql_lang_select)){
	if($row_lang_select['lang_default']==true)
	$lang_dd.='<option value="'.$row_lang_select['lang_code'].'" selected="selected">'.$row_lang_select['lang_title'].'</option>';
	else
	$lang_dd.='<option value="'.$row_lang_select['lang_code'].'">'.$row_lang_select['lang_title'].'</option>';
}
//******************************************
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dusit D2- Admin Module</title>

    <!-- Bootstrap Core CSS -->
    <link href="../admin/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../admin/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

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
    <script type="text/javascript">
		<!-- Custom jquery scripts -->
		// 2 - START LOGIN PAGE SHOW HIDE BETWEEN LOGIN AND FORGOT PASSWORD BOXES--------------------------------------
		$(document).ready(function () {
			$(".forgot-pwd").click(function () {
			$("#loginbox").hide();
			$("#forgotbox").show();
			return false;
			});
			<?php
			if(isset($_SESSION['msg']) && $_SESSION['msg'] == "RESET"){
				echo '$("#loginbox").hide();
				      $("#forgotbox").show();';
			    $div = '<div id="forgotbox-text">We have reset your password. Please check your email for new password.</div>';
			}else{
				$div = '<div id="forgotbox-text">Please send us your email and we\'ll reset your password.</div>';
			}
			?>
		});
		$(document).ready(function () {
			$(".back-login").click(function () {
			$("#loginbox").show();
			$("#forgotbox").hide();
			return false;
			});
		});
		// END ----------------------------- 2
	</script>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title">Admin Panel</h2>
                    </div>
                    <div class="panel-body">
                        <form action="authenticate.php" method="post" id="formlogin" role="form">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Username" name="username" id="username" type="username" value="">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" id="password" type="password" value="">
                                </div>
                                <div class="form-group">
                                	<select name="lang" class="form-control" ><?=$lang_dd?></select>
                                </div>
                                <input type="hidden" name="loginform" value="1" />
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" id="submit-login" value="Login" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Bootstrap Core JavaScript -->
    <script src="../admin/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../admin/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../admin/dist/js/sb-admin-2.js"></script>
    <script type="text/javascript">
	$().ready(function() {
		 $('#submit-login').click(function() { 		
			if($('#username').val()==""){
				alert('Please Enter username.');
				return false;
			}else if($('#password').val()==""){
				alert('Please Enter password.');
				return false;
			} else {
				return true;
			}	  
		});	
	});      
</script>

</body>

</html>
