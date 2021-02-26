<?php
	include 'sql_driver.php';
	
	if(file_exists('../config.conf')){
		header('Location:../index.php');
	}
	
	if(isset($_POST['submit'])){
		
		copy('config.conf','../config.conf');
		session_start();
		
		$query = "SELECT * FROM agencija";
		$agencija = mysqli_fetch_assoc(mysqli_query($db_conn, $query));		
		$admin_id = $agencija['admin'];
		$query = "SELECT ime FROM korisnik WHERE id = $admin_id";
		$admin = mysqli_fetch_assoc(mysqli_query($db_conn, $query))['ime'];
		
		$_SESSION['user'] = ['id' => $admin_id, 'username' => $admin ];
		
		header('Location:../index.php');
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
                          <a class="nav-link" aria-current="page" href="#">
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
                          <a class="nav-link active" href="#">
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
						<li class="breadcrumb-item">Estate Agency</li>
						<li class="breadcrumb-item">CodeBook</li>
						<li class="breadcrumb-item">Admin</li>
						<li class="breadcrumb-item active">Finish</li>
                    </ol>
                </nav>
              <?php
			  
				$config = unserialize(file_get_contents('config.conf'));
				
				$query = "SELECT * FROM agencija";
				$agencija = mysqli_fetch_assoc(mysqli_query($db_conn, $query));
				
				$query = "SELECT * FROM grad";
				$grad =mysqli_query($db_conn, $query);
				
				$query = "SELECT * FROM tip_nekretnine";
				$tip_nekretnine = mysqli_query($db_conn, $query);
				
				$admin_id = $agencija['admin'];
				$query = "SELECT * FROM korisnik WHERE id = $admin_id";
				$admin = mysqli_fetch_assoc(mysqli_query($db_conn, $query));
				
			  ?>
                <div class="row">
                    <div class="col-12 col-xl-12 mb-12 mb-lg-12">
                        <div class="card">
                            <h5 class="card-header">Welcome</h5>
                            <div class="card-body">
								 <form method='post' id="contact-form" role="form">
								<div class="controls">
									
									<div class="row">
										<div class="col-md-4">
											<h4>Configuration:</h4>
											<div class="mt-4">
												
												<p><b>DB host:</b> <?=$config['db_host']?></p>
												<p><b>DB name:</b> <?=$config['db_name']?></p>
												
												<p><b>DB user:</b> <?=$config['username']?></p>
												<p><b>DB password:</b> <?=$config['password']?></p>
											</div>
										</div>
										<div class="col-md-4">
											<h4>Estate Agency:</h4>
											<div class="mt-4">
												
												<p><b>Name:</b> <?=$agencija['naziv']?></p>
												<p><b>Address:</b> <?=$agencija['adresa']?></p>
												<p><b>Email:</b> <?=$agencija['email']?></p>
												<p><b>Telephone:</b> <?=$agencija['telefon']?></p>
											</div>
										</div>
										
										<div class="col-md-4">
											<h5></h5>
											<div class="mt-4">
												
												<p><b>Email host:</b> <?=$agencija['email_host']?></p>
												<p><b>Email user:</b> <?=isset($agencija['email_username'])?$agencija['email_username']:''?></p>
												<p><b>Google api:</b> <?=isset($agencija['map_api'])?$agencija['map_api']:''?></p>
											</div>
										</div>
									</div>
									
									<div class="row mt-4">
										<div class="col-md-4">
											<h4>Estates types:</h4>
											<div class="mt-4">
												<ul>
												<?php 
													while($row = mysqli_fetch_assoc($tip_nekretnine)){
															$tip = $row['naziv'];
															echo "<li>$tip</li>";
													}
												?>
												</ul>
											</div>
										</div>
										
										<div class="col-md-4">
											<h4>Cities:</h4>
											<div class="mt-4">
												<ul>
												<?php 
													while($row = mysqli_fetch_assoc($grad)){
															$tip = $row['naziv'];
															echo "<li>$tip</li>";
													}
												?>
												</ul>
											</div>
										</div>
										
										<div class="col-md-4">
											<h4>Admin:</h4>
											<div class="mt-4">
												
												<p><b>Name:</b> <?=$admin['ime']?></p>
												<p><b>Email:</b> <?=$admin['email']?></p>
												
											</div>
										</div>
									</div>
									
									<div class='mt-3 form-group'>
									<button  class = 'btn btn-success float-right' name='submit' type="submit">Finish</Button>
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