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
  <a href="http://localhost/webscraper/profile.php" >Profile</a>
  <a href="http://localhost/webscraper/search.php" style="color: white;">Search</a>
  <a href="http://localhost/webscraper/adviser.php">SEO Suggester</a>
  <a href="http://localhost/webscraper/userlogout.php">Logout</a>
</div>
</div>

<div class="col-md-10">

<form action="/webscraper/search.php" method="POST" style="margin-top: 40px;"> 
  <div class="row">
    <div class="col-xs-6 col-md-6">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Search" name="txtsearch"/>
        <div class="input-group-btn">
          <button class="btn btn-primary" type="submit" name="submit">
            <span class="glyphicon glyphicon-search"></span>
          </button>
        </div>
      </div>
    </div>
  </div>
</form>

<?php	

    include('connection.php');
	
	if(isset($_POST['submit']) AND $_POST['txtsearch'] != ""){
		
	$keyword = $_POST['txtsearch'];
	$sql = "SELECT url, title, description FROM urldata WHERE title LIKE '%$keyword%' OR description LIKE '%$keyword%' ORDER BY pr ASC;";
	
    $result = $conn->query($sql);
	if($result->num_rows > 0){

    while($row = $result->fetch_assoc()) {
?>

  <a href="<?php echo $row["url"]; ?>" target="_blank">
  <h3 style="margin-bottom:0;color:#609"><?php echo $row["title"]; ?></h3>
  
  </a>
  <a href="<?php echo $row["url"]; ?>" style="margin-bottom:0;text-decoration: none;color: #006621;font-style: normal;" target="_blank" ><?php echo $row["url"]; ?></a>
  <p style="margin-bottom:0;"><?php echo $row["description"]; ?></p>
<?php						
    }
	
}else{
	
?>

<h3 style="color:#609">No Results Found</h3>
<?php	
} 

	}
	
if(isset($_POST['submit']) AND $_POST['txtsearch'] == ""){	
?>	

<h3 style="color:#609">No Results Found</h3>

<?php
}
?>
</div>

</body>
</html>