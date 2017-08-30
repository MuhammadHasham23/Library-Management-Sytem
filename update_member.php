<?php
session_start();
if(!$_SESSION['user']){
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
  <link rel="stylesheet" href="../styles/style.css"/>
</head>
<body>
	<nav class="navbar navbar-default">
  			<div class="container-fluid">
   				 <div class="navbar-header">
    				  <a class="navbar-brand" href="#">Library</a>
    			 </div>
				    <ul class="nav navbar-nav">
				      <li class="active"><a href="home.php">Home</a></li>
				      <li><a href="add_book.php">Add Book</a></li>
				      <li><a href="delete_book.php">Delete Book</a></li>
				      <li><a href="update_book.php">Update Book</a></li>
				      <li><a href="add_member.php">Add Member</a></li>
				      <li><a href="delete_member.php">Delete Member</a></li>
				      <li><a href="update_member.php">Update Member</a></li>
				      <li><a href="book_store.php">Book Details</a></li>
				      <li><a href="members.php">Member Details</a></li>    
				    </ul>	
    <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
    </ul>
  </div>
</nav>
<div class="row">
	<div class="col-md-12">
<img class="banner img-responsive" src="http://www.bu.edu/library/files/2011/07/banner_bookshelf.jpg"/>
	</div>
</div>
	<h1>Update A Book</h1>
<form action="update_member.php" method="post" enctype="multipart/form-data">
			<div class="form-group">
			<label>Enter Member ID For The Member To Be Updated:</label>
			<input class="form-control" name="id" type="text"/>
			</div>		
			<div class="form-group">
			<label>Enter Member Name:</label>
			<input class="form-control" name="name" type="text"/>
			</div>
			<input type="submit" name="sub" class="btn btn-danger"/>
		</form>
		<?php
			if(isset($_POST['sub'])){
				$member_name = $_POST['name'];
				$member_id = $_POST['id'];
				
				$con = mysqli_connect('localhost','root','','library');
				$query="update members
				set member_name = '$member_name'
				where member_id = '$member_id'
				";
				$result = mysqli_query($con,$query);
				if($result == true){
					echo "
						<script>
						alert('Member has been updated');
						</script>
					";
				}
				else{
					echo "
						<script>
						alert('Something went wrong!');
						</script>
					";	
				}
				
			}
			else echo "Something went wrong";
		?>
</body>
</html>