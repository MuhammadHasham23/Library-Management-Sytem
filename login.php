<?php
session_start();
?>
<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./loginstyle.css"/>
</head>
<body>
<div class = "container">
	<div class="wrapper">
		<form action="login.php" method="post" name="Login_Form" class="form-signin">       
		    <h3 class="form-signin-heading">Welcome Back! Please Sign In</h3>
			  <hr class="colorgraph"><br>
			  
			  <input type="text" class="form-control" name="Username" placeholder="Username" required="" autofocus="" />
			  <input type="password" class="form-control" name="Password" placeholder="Password" required=""/>     		  
			 
			  <button class="btn btn-lg btn-primary btn-block"  name="Submit" value="Login" type="Submit">Login</button>  			
		</form>		
		<?php
			if(isset($_POST['Submit'])){
				$username = $_POST['Username'];
				$password = $_POST['Password'];	
				$con = mysqli_connect('localhost','root','','library');
				if($con){
					$query = "select * from public_login where 
					user_name='$username' AND user_pass='$password'";
					$result = mysqli_query($con,$query);
					if(mysqli_num_rows($result)>0){
						$_SESSION['public_user'] = $username;
						$_SESSION['pass'] = $password;
						echo "<script>
							alert('You are authenticated!');
							window.location.href='index.php';
						</script>";

					}
					else{
						echo "<script>
							alert('You are not authenticated!');
							</script>";
					}
				}

			}
			

		?>	
	</div>
</div>
</body>