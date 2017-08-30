<?php
session_start();
if(!$_SESSION['public_user']){
	echo "
		<script>
		window.location.href='login.php';
		</script>
	";
}
?>

<!DOCTYPE html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="./styles/style.css"/>
</head>
<body>
	<nav class="navbar navbar-default">
  			<div class="container-fluid">
   				 <div class="navbar-header">
    				  <a class="navbar-brand" href="#">Library</a>
    			 </div>
				    <ul class="nav navbar-nav">
				      <li class="active"><a href="#">Home</a></li>
				      <li><a href="issue.php">Issue Book</a></li>
				      <li><a href="#">Reserve Book</a></li>
				      
				       
				    </ul>	
    <ul class="nav navbar-nav navbar-right">
     <li>
						<form action="index.php" method="post" style="margin-top:10px">
					    	<input type="text" placeholder="Enter Search Query"/>
					    	<input type="submit"/>
						</form>
				       </li>
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>

<!--banner-->
<div class="row">
	<div class="col-md-12">
<img class="banner img-responsive" src="http://www.bu.edu/library/files/2011/07/banner_bookshelf.jpg"/>
	</div>
</div>
<!---->
<div class="row">
	<div class="col-md-12">
		<h1>Please enter details to issue book :</h1>
	</div>
</div>
<div class="container">
<div class="row">
	<div class="col-md-12">
		<form action="issue.php" method="post">
			<div class="form-group">
			<label>Enter Your Name:</label>
			<input class="form-control" name="name" type="text" value=""/>
			</div>
			<div class="form-group">
			<?php
				$con = mysqli_connect('localhost','root','','library');
				$id = $_GET['id'];
				$result = mysqli_query($con,"select book_name from book_store where bood_id='$id'");
					
					foreach ($result as $value) {
						$book = $value['book_name'];
							echo "
							<label>Enter Book Name :</label>
							<input class='form-control' name='book' type='text' value='$book'/>
							</div>
							";
						}
					
						if(!$id){
							echo "
								<label>Enter Book Name :</label>
									<input class='form-control' name='book' type='text' value=''/>
								</div>

							";
						}
						
			
		?>
			<input type="submit" class="btn btn-danger" name="submit"/>
		</form>
	</div>
</div>
</div>
<div class="footer">
	<div class="row">
		<div class="col-md-12">
			<h2 class="footer-head">&copy; 2017 Library Mangement System</h2>
		</div>
	</div>
</div>
</body>
<?php
	if($_POST['name']!=='a' && isset($_POST['submit'])){

		$con = mysqli_connect('localhost','root','','library');
			 	$user_book = $_POST['book'];
			 	$results = mysqli_query($con,"select * from book_store where book_name='$user_book'");
			 	$rows = mysqli_num_rows($results);
			 	if($rows == 0){
			 		echo "
						<script>
							alert('Book not available!');
						</script>
			 		";
			 		die();	
			 	}
			 	$query = "select * from issue_table where book_name = '$user_book'";
			 	$q = mysqli_query($con,$query);
			 	$r = mysqli_num_rows($q);
			 	if($r>0){
			 		echo "
						<script>
							alert('Book already issued!');
						</script>
			 		";
			 		die();
			 	}

		$user = $_POST['name'];
		$book_name = $_POST['book'];
		$result = mysqli_query($con,"insert into issue_table(person_name,book_name) values('$user','$book_name') ");
		
		if($result == false){
			echo "<script> 
			alert('Something Went Wrong!')
			</script>";
		}
	}
	else{
		echo "";
	}

?>
</html>