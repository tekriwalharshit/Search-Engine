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

</head>
<body>
<a href="/webscraper/adviser.php">Adviser</a>

<form action="/webscraper/results.php" method="POST"> 
  <div class="row">
    <div class="col-xs-6 col-md-4">
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
	$sql = "SELECT url, description FROM urldata WHERE title LIKE '%$keyword%' OR description LIKE '%$keyword%'";
    $result = $conn->query($sql);
	if($result->num_rows > 0){

    while($row = $result->fetch_assoc()) {
?>

  <a href="<?php echo $row["url"]; ?>" target="_blank">
  <h3 style="margin-bottom:0;color:#609">Heading</h3>
  
  </a>
  <a href="<?php echo $row["url"]; ?>" style="margin-bottom:0;text-decoration: none;color: #006621;font-style: normal;" target="_blank" ><?php echo $row["url"]; ?></a>
  <p style="margin-bottom:0;"><?php echo $row["description"]; ?></p>
<?php						
    }
} 

	}else{
?>		

<h3 style="color:#609">No Results Found</h3>

<?php
	}
?>
</body>
</html>