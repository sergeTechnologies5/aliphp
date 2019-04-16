<!DOCTYPE html>
<html>

<body>
	<div style="padding 1000px;" class="container">
			<div class="row">
			<h5>Login Page</h5>
			</div>
			
	</div>
<?php
	include_once("head.php");
    if(isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['login']))
	{
        include_once("../config/config.php");
        $bdd = new db();
		$username = $_POST['email'];
		$password = $_POST['password'];

		// //build query
		$query = "SELECT * FROM users WHERE email='$username' AND password='$password'";
		//Execute query
			$user = $bdd->getAll($query); // select ALL from allrecoards	
			$count = count($user);
			echo($count);
			if($count>=1){
				if(session_id() == '' || !isset($_SESSION)){session_start();}
				foreach($user as $value){
					$id =$value['id'];
				}
				$_SESSION['username'] = $username;
				$_SESSION['id'] = $id;
				header("location:dashboard.php");
			
			}else{
				$message = "Try with Different Username or Password";
				header("location:login.php");
			}
	}
    
?>
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
		
		<?php
		if (isset($_GET['message'])) {
			echo $_GET['message'] ;
		}
		?>
			<div class="login-panel panel panel-default">
			
				<div class="panel-heading">Log in</div>
				<div class="panel-body">
					<form action="login.php" method="POST" role="form">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
							<div class="checkbox">
								<label>
									<input name="remember" type="checkbox" value="Remember Me">Remember Me
								</label>
							</div>
							<button name="login" class="btn btn-primary">Login</button></fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->

	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
		
		<?php
		if (isset($_GET['message'])) {
			echo $_GET['message'] ;
		}
		?>
		
			<div class="login-panel panel panel-default">
			
				<div class="panel-heading">Sign Up</div>
				<div class="panel-body">
					<form action="register.php" method="POST" role="form">
						<fieldset>
							<div class="form-group">
								<input class="form-control" placeholder="E-mail" name="email" type="email" autofocus="">
							</div>
							
							<div class="form-group">
								<input class="form-control" placeholder="Username" name="username" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="First Name" name="firstname" type="text" autofocus="">
							</div>
							
							<div class="form-group">
								<input class="form-control" placeholder="Last Name" name="lastname" type="text" autofocus="">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" type="password" value="">
							</div>
						
					
							<button name="signup" class="btn btn-primary">Create Account</button></fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->

	
<script src="../statics/assets/js/jquery.3.2.1.min.js"></script>
	<script src="../statics/assets/js/bootstrap.min.js"></script>
</body>
</html>
