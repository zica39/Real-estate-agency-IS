<?php 
include 'sql_driver.php';
	
	$query = "SELECT naziv FROM agencija";
	$result = mysqli_query($db_conn, $query);

	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

	if(isset($row['naziv'])) {
		 header('Location:codebook.php');
	} else {
		
	}

if(isset($_POST['submit'])){
	$name = isset($_POST['name'])?$_POST['name']:false;
	$email = isset($_POST['email'])?$_POST['email']:false;
	$tel = isset($_POST['tel'])?$_POST['tel']:false;
	$address = isset($_POST['address'])?$_POST['address']:false;
	
	$email_host = isset($_POST['email_host'])?$_POST['email_host']:false;
	$email_username = isset($_POST['email_username'])?$_POST['email_username']:false;
	$email_password = isset($_POST['email_password'])?$_POST['email_password']:false;
	$api_key = isset($_POST['api_key'])?$_POST['api_key']:false;
	
	$about = isset($_POST['about'])?$_POST['about']:false;
	
	$sql =	"INSERT INTO `agencija` (`naziv`, `telefon`, `email`, `adresa`, `o_nama`, `map_api`, `email_host`, `email_username`, `email_password`, `admin`) VALUES
	('$name','$tel','$email','$address','$about','$api_key','$email_host','$email_username','$email_password',null)";
	
	$res = mysqli_query($db_conn,$sql);
	if($res){
		 header('Location:codebook.php');
		
	}else{
		die('Error to record data to db...');
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
                          <a class="nav-link" href="#">
                             <i class='fa fa-cog fa-x2'></i> 
                            <span class="ml-2">Configuration</span>
                          </a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link active"  aria-current="Estate Agency" href="#">
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
						<li class="breadcrumb-item">Configuration</li>
						<li class="breadcrumb-item active">Estate Agency</li>
                    </ol>
                </nav>
              
                <div class="row">
                    <div class="col-12 col-xl-12 mb-12 mb-lg-12">
                        <div class="card">
                            <h5 class="card-header">Estate Agency</h5>
                            <div class="card-body">
                                <form method='post' id="contact-form" role="form">
								<div class="controls">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group"> <label for="name">Agency Name: </label> <input id="name" type="text" name="name" class="form-control" placeholder="Please enter your Estate Agency Name" required="required" data-error="Agency name is required."> </div>
										</div>
										<div class="col-md-6">
											<div class="form-group"> <label for="email">Agency email: </label> <input id="email" type="email" name="email" class="form-control" placeholder="Please enter your agency contact email" required="required" data-error="Agency email is required."> </div>
										</div>
									</div>
									<div class="row mt-2">
										<div class="col-md-6">
											<div class="form-group"> <label for="tel">Telephone: </label> <input id="tel" type="tel" name="tel" class="form-control" placeholder="Please enter your agency telephone" required="required" data-error="Agency telephone is required."> </div>
										</div>
										<div class="col-md-6">
											<div class="form-group"> <label for="address">Address: </label> <input id="address" required type="text" name="address" class="form-control" placeholder="Please enter your agency address" data-error="Address is required."> </div>
										</div>
									</div>
									
									<div class="row mt-4">
										<div class="col-md-6">
											<div class="form-group"> <label for="email_host">Email Host: </label> <input id="email_host" type="text" name="email_host" class="form-control" placeholder="Email Host"  data-error="Email host is required."> </div>
										</div>
										<div class="col-md-6">
											<div class="form-group"> <label for="email_username">Email username: </label> <input id="email_username" type="text" name="email_username" class="form-control" placeholder="Email username@host" data-error="Email username is required."> </div>
										</div>
									</div>
									
									<div class="row mt-4">
										<div class="col-md-6">
											<div class="form-group"> <label for="email_password">Email Password: </label> <input id="email_password" type="password" name="email_password" class="form-control" placeholder="Email Password" data-error="Email password is required."> </div>
										</div>
										<div class="col-md-6">
											<div class="form-group"> <label for="api_key">API key: </label> <input id="api_key" type="text" name="api_key" class="form-control" placeholder="Google map api key" data-error="API key is required."> </div>
										</div>
									</div>
									
									<div class="row mt-4">
										<div class="col-md-12">
											<div class="form-group"> <label for="about">About: </label> <textarea id="about" name="about" rows=7 class="form-control" placeholder="About your estate agency..." required="required" data-error="Email password is required."></textarea> </div>
										</div>
									</div>
									
									<div class='mt-3 form-group'>
									<button  class = 'btn btn-success' name='submit' type="submit">Next</Button>
								  </div>
								</div>
							</form>
                            </div>
                        </div>
                    </div>
                   
                </div>
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