<?php 
 include 'sql_tool.php';
 
 if(file_exists('config.conf')){
	 header('Location:estate.php');
 }
if(isset($_POST['submit'])){
	$db_host = isset($_POST['db_host'])?$_POST['db_host']:false;
	$db_name = isset($_POST['db_name'])?$_POST['db_name']:false;
	$username = isset($_POST['user'])?$_POST['user']:false;
	$password = isset($_POST['password'])?$_POST['password']:false;
	
	
	$link = mysqli_connect($db_host, $username, $password);
	if (!$link) {
		die('Could not connect: ' . mysqli_error($link));
	}

	// Make my_db the current database
	$db_selected = mysqli_select_db($link ,$db_name);

	if (!$db_selected) {
	  // If we couldn't, then it either doesn't exist, or we can't see it.
	  $sql = 'CREATE DATABASE '.$db_name;

	  if (mysqli_query($link, $sql)) {
		  //echo "Database my_db created successfully\n";
	  } else {
		  die('Error creating database: ' . mysqli_error($link) . "\n");
	  }
	}
	
	$port = '3306';
	$script_file = 'SQL.sql';

	# MySQL with PDO_MYSQL  
	$db = new PDO("mysql:host=$db_host;dbname=$db_name", $username, $password);

	$query = file_get_contents($script_file);

	$stmt = $db->prepare($query);

	if ($stmt->execute()){
		 //echo "Success";
	}else{ 
		 die ("Fail to install database");
	}
	
	$out = ['db_host'=>$db_host,'db_name'=>$db_name,'username'=>$username, 'password'=>$password];
	
	if(file_put_contents('config.conf', serialize($out))){
		
		header('Location:estate.php');
	}else{
		die('Error to save config file');
	}
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estate agency IS Setup</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
	
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">

</head>
<body>
    <nav class="navbar navbar-light bg-light p-3">
        <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
            <a class="navbar-brand" href="#">
               <i class='fa fa-wrench'></i> Estate agency IS Setup
            </a>
            <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <!--<div class="col-12 col-md-4 col-lg-2">
            <input class="form-control form-control-dark" type="text" placeholder="Search" aria-label="Search">
        </div>
        <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
            <div class="mr-3 mt-1">
                <a class="github-button" href="https://github.com/themesberg/simple-bootstrap-5-dashboard" data-color-scheme="no-preference: dark; light: light; dark: light;" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star /themesberg/simple-bootstrap-5-dashboard">Star</a>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                  Hello, John Doe
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <li><a class="dropdown-item" href="#">Settings</a></li>
                  <li><a class="dropdown-item" href="#">Messages</a></li>
                  <li><a class="dropdown-item" href="#">Sign out</a></li>
                </ul>
              </div>
        </div>-->
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="nav-link" href="#">
                             <i class='fa fa-sign-in'></i> 
                            <span class="ml-2">Welcome</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active" aria-current="Configuration" href="#">
                             <i class='fa fa-cog fa-x2'></i> 
                            <span class="ml-2">Configuration</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">
                             <i class='fa fa-building'></i> 
                            <span class="ml-2">Estate Agency</span>
                          </a>
                        </li>
						<li class="nav-item">
                          <a class="nav-link" href="#">
                             <i class='fa fa-book'></i> 
                            <span class="ml-2">CodeBook</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="#">
                            <i class='fa fa-user'></i> 
                            <span class="ml-2">Admin</span>
                          </a>
                        </li>
						<li class="nav-item">
                          <a class="nav-link" href="#">
                            <i class='fa fa-check'></i> 
                            <span class="ml-2">Finish</span>
                          </a>
                        </li>
                      </ul>
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">Welcome</li>
						<li class="breadcrumb-item active">Configuration</li>
                    </ol>
                </nav>
              
                <div class="row">
                    <div class="col-12 col-xl-12 mb-12 mb-lg-12">
                        <div class="card">
                            <h5 class="card-header">Configuration</h5>
                            <div class="card-body">  
							<form method='post' id="contact-form" role="form">
								<div class="controls">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group"> <label for="db_host">DB host: </label> <input id="db_host" type="text" name="db_host" class="form-control" placeholder="Please enter your DB host name" required="required" data-error="DB host is required."> </div>
										</div>
										<div class="col-md-6">
											<div class="form-group"> <label for="db_name">DB name: </label> <input id="db_name" type="text" name="db_name" class="form-control" placeholder="Please enter your DB name" required="required" data-error="DB name is required."> </div>
										</div>
									</div>
									<div class="row mt-2">
										<div class="col-md-6">
											<div class="form-group"> <label for="user">DB User: </label> <input id="user" type="text" name="user" class="form-control" placeholder="Please enter your username" required="required" data-error="Username is required."> </div>
										</div>
										<div class="col-md-6">
											<div class="form-group"> <label for="password">DB Password: </label> <input id="password" type="password" name="password" class="form-control" placeholder="Please enter your password" data-error="password is required."> </div>
										</div>
									</div>
									
									<div class='mt-3 form-group'>
									<button  class = 'btn btn-success' name='submit' type="submit">Install</Button>
								  </div>
								</div>
							</form>
						</div>
					</div>
				</div> <!-- /.8 -->
			</div> <!-- /.row-->

                <!--<footer class="pt-5 d-flex justify-content-between">
                    <span>Copyright © 2019-2020 <a href="https://themesberg.com">Themesberg</a></span> 
                </footer>-->
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
 
</body>
</html>