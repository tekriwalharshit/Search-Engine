<?php
include('check_admin_sess.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Panel</title>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="css/metisMenu.min.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap.css" rel="stylesheet">
    <link href="css/dataTables.responsive.css" rel="stylesheet">
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <link href="css/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">


</head>

<?php

include('connection.php');
 
if(isset($_POST['submit'])){
	
	$url = $_POST['url'];
	$desc = $_POST['desc'];
	$title = $_POST['title'];
	$rank = $_POST['rank'];
	
	$sql = "INSERT INTO urldata (url, title, description, page_score, visits, inbound, pr)
     VALUES ('$url', '$title', '$desc', '0', '0', '0', '$rank')";

if ($conn->query($sql) === TRUE) {
   
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

}

?>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">Admin Panel</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
			
             
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="adminlogout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li>
                            <a href="addUrl.php" class="active"><i class="fa fa-dashboard fa-fw"></i> Add Url</a>
                        </li>
						
						
						 <!-- 
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="flot.html">Flot Charts</a>
                                </li>
                                <li>
                                    <a href="morris.html">Morris.js Charts</a>
                                </li>
                            </ul>
                           /.nav-second-level
                        </li>
                        <li>
                            <a href="tables.html"><i class="fa fa-table fa-fw"></i> Tables</a>
                        </li>
                        <li>
                            <a href="forms.html"><i class="fa fa-edit fa-fw"></i> Forms</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="panels-wells.html">Panels and Wells</a>
                                </li>
                                <li>
                                    <a href="buttons.html">Buttons</a>
                                </li>
                                <li>
                                    <a href="notifications.html">Notifications</a>
                                </li>
                                <li>
                                    <a href="typography.html">Typography</a>
                                </li>
                                <li>
                                    <a href="icons.html"> Icons</a>
                                </li>
                                <li>
                                    <a href="grid.html">Grid</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level 
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Second Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                        <li>
                                            <a href="#">Third Level Item</a>
                                        </li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                            </ul>
                            <!-- /.nav-second-level
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="blank.html">Blank Page</a>
                                </li>
                                <li>
                                    <a href="login.html">Login Page</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level 
                        </li> -->
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>
		
<?php	
	$sql = "SELECT url, description, page_score, visits, inbound, pr FROM urldata";
    $result = $conn->query($sql);
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-3">
                    <h3>Url Data</h3>
                </div>
				<div class="col-lg-6">
              
                </div>
				<div class="col-lg-3">
                   	<!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal" style="    margin-top: 12px;">Add Url</button>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Page Info
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>URL</th>										
                                        <th>Page Score</th>
                                        <th>Visits</th>
                                        <th>Inbound</th>          
										<th>PR</th>
                                    </tr>
                                </thead>
                                <tbody>
								
								<?php
								
								if($result->num_rows > 0){

                                while($row = $result->fetch_assoc()) {
						
                            ?>                     
                                    <tr class="gradeX">
                                        <td><?php echo $row["url"]; ?></td>
                                        <td><?php echo $row["page_score"]; ?></td>
                                        <td><?php echo $row["visits"]; ?></td>
                                        <td><?php echo $row["inbound"]; ?></td>
										<td><?php echo $row["pr"]; ?></td>
                                    </tr>
			<?php						
		 }
} 

	?>		
                                    
                                </tbody>
                            </table>
                            <!-- /.table-responsive -->
                           
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
       
        </div>
        <!-- /#page-wrapper -->
<?php
    $conn->close();	
?>
		
		
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>


    <script src="js/metisMenu.min.js"></script>

 
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap.min.js"></script>
    <script src="js/dataTables.responsive.js"></script>

 
    <script src="js/sb-admin-2.min.js"></script>

    <script src="js/jquery.validate.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            responsive: true
        });
    });
    </script>
	

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

  
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Url</h4>
      </div>
      <div class="modal-body">
	  
        <form class="form-horizontal" action="" method="POST" id="url-form">
		
  <div class="form-group">
    <label class="control-label col-sm-2" for="URL">URL:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control urls" name="url" placeholder="Enter Url">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-6" style="margin-left: 35px;">
         <b>Please check:</b><input type="checkbox" name="checks" class="chk" value="no">
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="title">Title:</label>
    <div class="col-sm-10">
      <input type="text" class="form-control titles" name="title" placeholder="Enter title">
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="Description">Description:</label>
    <div class="col-sm-10"> 
  <textarea class="form-control descs" rows="3" name="desc"></textarea>
    </div>
  </div>
  
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
	 <input type="hidden" class="form-control ranks" name="rank">
      <button type="submit" class="btn btn-default" name="submit">Submit</button>
    </div>
  </div>
  
</form>

      </div>
      <!--   <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
	  -->
    </div>

  </div>
</div>
	
<script>
		
	
		
		$("#url-form").validate({
			
			rules: {
				url: "required",
				//desc: "required",
			    title: "required",
				checks: "required"
			},
			messages: {
				url: "Please enter url",
				//desc:"Description is required",
                title: "Title is required",
                checks: "please check to autofill details" 				
			}
		});
		
</script>	

<script>

$(".chk").click(function(){

     var url = $(".urls").val();
	 
	 $.ajax({
		 
        url: "getData.php",
        cache: false,
		type: "POST",
		data: {url: url},
        success: function(data){
			
			console.log(data)
			var obj = JSON.parse(data);
			
			$(".titles").val(obj.title);
			$(".descs").val(obj.description);
			$(".ranks").val(obj.rank);
 
       }
	   
});
	
	 
  
});

</script>	

</body>

</html>
