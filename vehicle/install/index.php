<?php
ob_start();
if(file_exists('../php_files/database.php')){
	include '../php_files/config.php';
	header('location: index.php');
	die();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Vehicle Parking Management</title>
	<link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
	<style>
		body{
			padding: 120px 0 0;
		}
		h1{
			background-color: #e7e7e7;
			font-size: 30px;
			font-weight: 600;
			padding: 15px;
			margin: 0;
		}
		.tab .nav-tabs{
			background-color: transparent;
			border: none;
		}
		.tab .nav-tabs li a{
			color: #333;
			background: #f5f5f5;
			font-size: 18px;
			font-weight: 800;
			letter-spacing: 1px;
			text-align: center;
			text-transform: uppercase;
			padding: 11px 15px 10px;
			margin: 0 10px 1px 0;
			border: none;
			box-shadow: 0 0 5px rgba(0,0,0,0.1);
			border-radius: 0;
			overflow: hidden;
			position: relative;
			z-index: 1;
			transition: all 0.3s ease 0s;
		}
		.tab .nav-tabs li:last-child a{ margin-right: 0; }
		.tab .nav-tabs li a:hover,
		.tab .nav-tabs li.active a{
			color: #fff;
			background: #f5f5f5;
			border: none;
		}
		.tab .nav-tabs li a:before{
			content: '';
			background: #6f2aab;
			height: 100%;
			width: 100%;
			opacity: 0;
			transform: scale(0.5);
			position: absolute;
			left: 50%;
			top: 0;
			z-index: -1;
			transition: opacity 0.4s ease 0s,left 0.3s ease 0s,transform 0.4s ease 0.2s;
		}
		.tab .nav-tabs li.active a:before,
		.tab .nav-tabs li a:hover:before{
			opacity: 1;
			transform: scale(1);
			left: 0;
		}
		.tab .tab-content{
			color: #333;
			background: linear-gradient(to right bottom,#f5f5f5 50%, transparent 50%);
			font-size: 14px;
			letter-spacing: 1px;
			text-align: center;
			line-height: 25px;
			padding: 20px;
			position: relative;
		}
		.tab .tab-content h3{
			color: #777;
			font-size: 22px;
			font-weight: 600;
			text-transform: capitalize;
			text-align: center;
			letter-spacing: 1px;
			margin: 0 0 12px;
		}
	</style>
</head>
<body>
	<div id="wrapper">
		<div class="container">
			<div class="row">
				<div class="offset-3 col-6">
					<h1 class="text-center">Vehicle Parking Management</h1>
					<div class="tab" role="tabpanel">
						<form class="tab-content tabs" action="<?php  echo $_SERVER['PHP_SELF']; ?>" method="POST">
							<div role="tabpanel" class="tab-pane active" id="Section1">
								<h3>Welcome to Vehicle Parking Management</h3>
								<p>Introducing Vehicle Parking Management - a complete management solution to manage your Vehicle Category, Add Vehicle, Manage Incoming and Outgoing Vehicle, Settings, Reports & etc.</p>
								<ul class="nav justify-content-center">
									<li class="nav-item">
										<a href="#Section2" class="nav-link btn btn-success mx-2" data-toggle="tab" role="tab">Next</a>
									</li>
								</ul>
							</div>
							<div role="tabpanel" class="tab-pane" id="Section2">
								<h3>Database Settings</h3>
								<div class="form-group">
									<input type="text" class="form-control" name="host" placeholder="Host Name" required>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="dbname" placeholder="Database Name" required>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="dbuser" placeholder="Database Username" required>
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="dbpwd" placeholder="Database Password">
								</div>
								<ul class="nav justify-content-center">
									<li class="nav-item">
										<a href="#Section1" class="nav-link btn btn-success mx-2" data-toggle="tab" role="tab" >Previous</a>
									</li>
									<li class="nav-item">
										<a href="#Section3" class="nav-link btn btn-success mx-2" data-toggle="tab" role="tab" >Next</a>
									</li>
								</ul>
							</div>
							<div role="tabpanel" class="tab-pane" id="Section3">
								<h3>Set Login Credentials</h3>
								<div class="form-group">
									<input type="text" class="form-control" name="username" placeholder="User Name" required>
								</div>
								<div class="form-group">
									<input type="password" class="form-control" name="password" placeholder="Password" required>
								</div>
								<ul class="nav justify-content-center">
									<li class="nav-item">
										<a href="#Section2" class="nav-link btn btn-success mx-2" data-toggle="tab" role="tab" >Previous</a>
									</li>
									<li class="nav-item">
										<input type="submit" name="install" class="nav-link btn btn-success mx-2" value="Install"/>
									</li>
								</ul>

							</div>
						</form>
						<?php
								if(isset($_POST['install'])){
									if(!isset($_POST['host']) || $_POST['host'] == ''){
										echo '<div class="alert alert-danger">Hostname Required</div>';
									}elseif(!isset($_POST['dbname']) || $_POST['dbname'] == ''){
										echo '<div class="alert alert-danger">Database Name Required</div>';
									}elseif(!isset($_POST['dbuser']) || $_POST['dbuser'] == ''){
										echo '<div class="alert alert-danger">Database Username Required</div>';
									}elseif(!isset($_POST['username']) || $_POST['username'] == ''){
										echo '<div class="alert alert-danger">Site Username Required</div>';
									}elseif(!isset($_POST['password']) || $_POST['password'] == ''){
										echo '<div class="alert alert-danger">Site Password Required</div>';
									}else{
										$host= trim($_POST['host']);
										$dbuname= trim($_POST['dbuser']);
										$dbpwd= trim($_POST['dbpwd']);
										$dbname= trim($_POST['dbname']);
										$username= trim($_POST['username']);
										$password= md5(trim($_POST['password']));

										$con=@mysqli_connect($host,$dbuname,$dbpwd,$dbname);
										if(mysqli_connect_error()){
											$msg=mysqli_connect_error();
											echo '<div class="alert alert-danger">'.$msg.'</div>';
										}else{
											copy("install.inc.php","../php_files/database.php");
											$file="../php_files/database.php";
											file_put_contents($file,str_replace("hostName",$host,file_get_contents($file)));
											file_put_contents($file,str_replace("userDB",$dbuname,file_get_contents($file)));
											file_put_contents($file,str_replace("passDB",$dbpwd,file_get_contents($file)));
											file_put_contents($file,str_replace("nameDB",$dbname,file_get_contents($file)));

											// Name of the file
											$filename = "install.sql";

											// Temporary variable, used to store current query
											$templine = '';
											// Read in entire file
											$lines = file($filename);
											// Loop through each line
											foreach ($lines as $line) {
												// Skip it if it's a comment
												if (substr($line, 0, 2) == '--' || $line == '')
													continue;
													// Add this line to the current segment
													$templine .= $line;
													// If it has a semicolon at the end, it's the end of the query
													if (substr(trim($line), -1, 1) == ';') {
													// Perform the query
													$con->query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . $con->error() . '<br /><br />');
														// Reset temp variable to empty
														$templine = '';
												}
											}

											include '../php_files/config.php';
											$db = new Database();
											$db->update('admin',array('admin_username'=>$username,'admin_password'=>$password),"admin_id=1");
        									$res1 = $db->getResult();
											header('location: ../index.php	');
										}
									}
								}
							?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script>
	$('.nav-link').click(function(){
		$('.nav-link').removeClass('active');
	})
</script>
</body>

</html>
