<?php
include('check_user_sess.php');
?>

<!DOCTYPE html>
<html>
<head>

<title>Page Title</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<style>

.sidenav {
  height: 100%;
  width: 210px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

</style>

</head>
<body>
<div class="col-md-2">
<div class="sidenav">
  <a href="http://localhost/webscraper/profile.php" style="color: white;">Profile</a>
  <a href="http://localhost/webscraper/search.php" >Search</a>
  <a href="http://localhost/webscraper/adviser.php">SEO Suggester</a>
  <a href="http://localhost/webscraper/userlogout.php">Logout</a>
</div>
</div>

<div class="col-md-10">

<?php

  include('connection.php');
  $userid = $_SESSION["userid"];

$sql = "SELECT name,email,contact FROM register WHERE id='$userid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
	$row = $result->fetch_assoc();
	
	   $name = $row['name'];
	   $email = $row['email'];
       $contact = $row['contact'];
	   
}

?>

<br><br>
<div class="container-fluid well span6">
	<div class="row-fluid">
	
      <!--  <div class="span2" >
		    <img src="https://secure.gravatar.com/avatar/de9b11d0f9c0569ba917393ed5e5b3ab?s=140&r=g&d=mm" class="img-circle">
        </div>-->
      
        <div class="span8">
            <h3><?php echo $name; ?></h3>
            <h6>Email: <?php echo $email; ?></h6>
            <h6>Contact : <?php echo $contact; ?></h6>
        </div>
             
</div>
</div>


</div>


</body>
</html>