<?php

session_start();
?>

<!DOCTYPE html>

<html>

<head>
<title>Admin Login</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

<script src="js/jquery.validate.min.js"></script>

</head>

<style>
body {
  margin: 0;
  padding: 0;
  background-color: #17a2b8;
  height: 100vh;
}
#login .container #login-row #login-column #login-box {
  margin-top: 120px;
  margin-left: 270px;
  max-width: 600px;
  height: 320px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}
#login .container #login-row #login-column #login-box #login-form {
  padding: 20px;
}


</style>

<body>
    <div id="login">
 
        <div class="container">
            <div id="login-row" class="row justify-content-center align-items-center">
                <div id="login-column" class="col-md-6">
                    <div id="login-box" class="col-md-12">
					
                        <form id="login-form" class="form" action="" method="post">
                            <h3 class="text-center text-info">Admin Login</h3>
                            <div class="form-group">
                                <label for="username" class="text-info">Username:</label><br>
                                <input type="type" name="username" class="form-control">
                            </div>
							
                            <div class="form-group">
                                <label for="password" class="text-info">Password:</label><br>
                                <input type="password" name="password" class="form-control">
                            </div>
							
                            <div class="form-group">
                              <center>  <input type="submit" name="submit" class="btn btn-info btn-md" value="submit"></center>
                            </div>
                           
                        </form>
						
                    </div>
                </div>
            </div>
        </div>
    </div>
	
	<script>
		
	
		
		$("#login-form").validate({
			
			rules: {
				username: "required",
				password: {
					required: true,
					minlength: 8
				},
			
			},
			messages: {
				username: "Please enter your username",
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 8 characters long"
				},	
			}
		});
		
</script>

<?php

include('connection.php');
 
if(isset($_POST['submit'])){
	
	$username = $_POST['username'];
	$password = $_POST['password'];
	
$sql = "SELECT username FROM admin WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
	
	$row = $result->fetch_assoc();
	
	   $username = $row['username'];
	   
	   $_SESSION["admin"] = $username;
	   
	   header("Location: http://localhost/webscraper/addUrl.php");
       exit();
	
} else {
    echo "Wrong Credentials";
}

$conn->close();

}

?>


	
</body>
</html>