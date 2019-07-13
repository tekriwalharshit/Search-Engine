<!DOCTYPE html>
<html>

<head>

<title>Page Title</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


<script src="js/jquery.validate.min.js"></script>


<style>

body {
  margin: 0;
  padding: 0;
  background-color: #17a2b8;
  height: 100vh;
}

.signup-box{
	
  margin-top: 120px;
  margin-left: 270px;
  max-width: 600px;
  height: 430px;
  border: 1px solid #9C9C9C;
  background-color: #EAEAEA;
}

#signup-form{
	
	padding: 20px;
}

.form-horizontal .form-group {
    margin-left: 2px;
}

</style>

</head>

<body>

<div class="signup-box">

<h4 style="text-align:center;margin-top:15px;">Register Here</h4>

	<form class="form-horizontal" action='' method="POST" id="signup-form">
	
	<div class="form-group col-md-6">
		<label for="firstname" class="text-info">Firstname:</label><br>
        <input type="text" name="firstname" placeholder="Firstname" class="form-control">
    </div>
	
	<div class="form-group col-md-6">
        <label for="lastname" class="text-info">Lastname:</label><br>
        <input type="text" name="lastname" placeholder="Lastname" class="form-control">
      </div>
 
    <div class="form-group col-md-6">
	  <label for="E-mail" class="text-info">E-mail:</label><br>
      <input type="email" name="email" placeholder="E-mail" class="form-control">
    </div>
 
    <div class="form-group col-md-6">
	  <label for="Password" class="text-info">Password:</label><br>
      <input type="password" name="password" id="passwords" placeholder="Password" class="form-control">
    </div>
 
    <div class="form-group col-md-6">
        <label for="Password (Confirm)" class="text-info">Password (Confirm):</label><br>
        <input type="password" name="password_confirm" placeholder="Password (Confirm)" class="form-control">
    </div>
	
	 <div class="form-group col-md-6">
	    <label for="Mobile no" class="text-info">Mobile no:</label><br>
        <input type="text" name="contact" placeholder="Mobile no" class="form-control">
    </div>
	
     <div id="register-link" class="text-right">
          <a href="http://localhost/webscraper/" class="text-info">Login here</a>
     </div>
	 
    <div class="form-group">
       <center><button class="btn btn-success" type="submit" name="submit">Register</button></center>
    </div>
	
</form>

</div>

<script>

		
		$("#signup-form").validate({
			rules: {
				firstname: "required",
				lastname: "required",
				password: {
					minlength: 8
				},
				password_confirm: {
					minlength: 8,
					equalTo: "#passwords"
				},
				email: {
					required: true,
					email: true
				},
				contact: {
					required: true,
					minlength: 10,
					maxlength:10
				}
			
			},
			messages: {
				firstname: "Please enter your firstname",
				lastname: "Please enter your lastname",
				
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 8 characters long"
				},
				password_confirm: {
					required: "Please provide a password",
					minlength: "Your password must be at least 8 characters long",
					equalTo: "Please enter the same password as above"
				},
				email: "Please enter a valid email address",
				contact: "Please enter a valid mobile number"
			}
		});
		
</script>

<?php

 include('connection.php');
 
if(isset($_POST['submit'])){
	
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$name = $firstname.' '.$lastname; 
	$email = $_POST['email'];
	$password = $_POST['password'];
	$password = md5($password);
	$contact = $_POST['contact'];
	
	$sql = "INSERT INTO register (name, password, email, contact)
     VALUES ('$name', '$password', '$email', '$contact')";

if ($conn->query($sql) === TRUE) {
    //echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

}

?>


</body>
</html>


