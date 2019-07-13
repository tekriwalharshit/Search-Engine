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
  <a href="http://localhost/webscraper/search.php">Search</a>
  <a href="http://localhost/webscraper/adviser.php" style="color: white;">SEO Suggester</a>
  <a href="http://localhost/webscraper/userlogout.php">Logout</a>
</div>
</div>

<div class="col-md-10">

<h4>Enter Website URL</h4>

<form action="" method="POST"> 
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
	include('simple_html_dom.php');
	$check = 0;
	
	if(isset($_POST['submit']) AND $_POST['txtsearch'] != ""){
		
	$url = $_POST['txtsearch'];
	
	$html = file_get_html($url);
	
    $title = $html->find('title', 0)->plaintext;
	$title_len = strlen($title);
	
	if($title_len <= 30){
		$score = 1;
		$title_desc = "Title length is good";
	}else{
		$score = 0;
		$title_desc = "Title length should be less than 30";
	}
	
    $keywords = $html->find('meta[name="Keywords"]', 0);
	
	if($keywords == ""){
		
		$keywords = $html->find('meta[name="keywords"]', 0);
		
		if($keywords == ""){
			$keywords = "";
		}else{
			$keywords = $keywords->getAttribute("content");
		}
		
		
	}else{
		
		$keywords = $keywords->getAttribute("content");
		
	}
	
	$keywords_arr = explode("," , $keywords);
	$keywords_count = count($keywords_arr);
	
	if($keywords_count >= 7 AND $keywords_count <= 10){
		$score++;
		$keywords_desc = "Keywords count is good";
	}else{
		$keywords_desc = "Keywords count should be in between 7 and 10";
	}
	
	
	$description = $html->find('meta[name="description"]', 0);
	
	if($description == ""){
		
		$description = $html->find('meta[name="Description"]', 0);
		if($description == ""){
			$description = "";
		}else{
			$description = $description->getAttribute("content");
		}
		
	}else{
		
		$description = $description->getAttribute("content");
	}
	
	$description_len = strlen($description);
	
	if($description_len >= 100 AND $description_len <= 160){
		$score++;
		$description_desc = "Description is good";
	}else{
		
		$description_desc = "Description length should be in between 100 to 160 characters";
	}
	
	$sql = "SELECT id, inbound FROM urldata WHERE url='$url'";
    $result = $conn->query($sql);
	
	if($result->num_rows > 0){
		
	   $check = 1;	
	   $row = $result->fetch_assoc();
	
	   $urlid = $row['id'];
	   $inbound = $row['inbound'];
	   $inbound++;
	   $userid = $_SESSION["userid"];
	   
	   $sql = "SELECT urlid FROM urlvisits WHERE userid='$userid'";
       $result = $conn->query($sql);
	
	   if($result->num_rows == 0){
		
		  $sql = "INSERT INTO urlvisits (urlid, userid)
     VALUES ('$urlid', '$userid')";

   if($conn->query($sql) === TRUE){
   // echo "New record created successfully";
   }else{
    echo "Error: " . $sql . "<br>" . $conn->error;
   }
	   
	   
	     }
		 
		$sql = "SELECT COUNT(*) AS total FROM urlvisits WHERE urlid='$urlid'";
        $result = $conn->query($sql);
	
	  if($result->num_rows > 0){
		  
		 $row = $result->fetch_assoc();
		 $total_visits = $row['total'];
		
	  } 
	  
	 $sql = "UPDATE urldata SET page_score='$score',visits='$total_visits',inbound='$inbound' WHERE id='$urlid'";

if ($conn->query($sql) === TRUE) {
    //echo "Record updated successfully";
} else {
    echo "Error updating record: " . $conn->error;
} 
		 
	   
    }
	
	$check = 1;
}
		
?>

<?php

if($check == 1){
?>	

<br>
<br>

<h4>Title: <?php echo $title; ?></h4>
<h4><?php echo $title_desc; ?></h4>
<br>

<h4>Keywords: <?php echo $keywords; ?></h4>
<h4>Keywords count: <?php echo $keywords_count; ?></h4>
<h4><?php echo $keywords_desc; ?></h4>
<br>

<h4>Meta Description: <?php echo $description; ?></h4>
<h4>Description Length = <?php echo $description_len; ?></h4>
<h4><?php echo $description_desc; ?></h4>

<?php
}
?>

</div>

</body>
</html>