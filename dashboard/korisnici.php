<?php 
	include 'sql_driver.php';
	include '../tools.php';
	include '../global.php';
	if(!isAdmin())header('Loacation:../index.php');
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Korisnici</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css" integrity="sha384-r4NyP46KrjDleawBgD5tp8Y7UzmLA05oM1iAEQ17CSuDqnUK2+k9luXQOfXJCJ4I" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.css">
   
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-light bg-light p-3">
        <div class="d-flex col-12 col-md-3 col-lg-2 mb-2 mb-lg-0 flex-wrap flex-md-nowrap justify-content-between">
            <a class="navbar-brand" href="#">
				Dashboard
            </a>
            <button class="navbar-toggler d-md-none collapsed mb-3" type="button" data-toggle="collapse" data-target="#sidebar" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <div class="col-12 col-md-4 col-lg-2">
		<form method = 'get' action = '../properties.php' >
            <input class="form-control form-control-dark" name = 'q' type="text" placeholder="Pretrazi nekretnine..." aria-label="Search">
        </form>
		</div>
        <div class="col-12 col-md-5 col-lg-8 d-flex align-items-center justify-content-md-end mt-3 mt-md-0">
            
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                  Hello, <?=$user['username']?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                  <li><a class="dropdown-item" href="#">Settings</a></li>
                  <!--<li><a class="dropdown-item" href="#">Messages</a></li>-->
                  <li><a class="dropdown-item" href="../signin.php?logout=true">Sign out</a></li>
                </ul>
              </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                          <a class="nav-link" aria-current="page" href="index.php">
                            <i class = 'fa fa-bar-chart fa-2x'></i>
							<span class="ml-2 h5">Dashboard</span>
                          </a>
                        </li>
						
						<li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="korisnici.php">
                            <i class = 'fa fa-user fa-2x'></i>
							<span class="ml-2 h5">Korisnici</span>
                          </a>
                        </li>
						
						<li class="nav-item">
                          <a class="nav-link" aria-current="page" href="podesavanja.php">
                            <i class = 'fa fa-cog fa-2x'></i>
							<span class="ml-2 h5">Podesavanja</span>
                          </a>
                        </li>
						
						<li class="nav-item">
                          <a class="nav-link" aria-current="page" href="sifarnik.php">
                            <i class = 'fa fa-book fa-2x'></i>
							<span class="ml-2 h5">Sifarnik</span>
                          </a>
                        </li>
                        
                      </ul>
                </div>
            </nav>
            <main class="col-md-9 ml-sm-auto col-lg-10 px-md-4 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Korisnici</li>
                    </ol>
                </nav>
                <h1 class="h2">Korisnici</h1>
                <div class="row my-4">
                   <div class="col-12 col-xl-12 mb-12 mb-lg-12">
                        <div class="card">
                            <h5 class="card-header">Korisnici</h5>
                            <div class="card-body">  
								<div class="table-responsive">
								<table class="table">
									<thead>
									  <tr>
										<th scope="col">Id</th>
										<th scope="col">Korisncko ime</th>
										<th scope="col">Email</th>
										<th scope="col">Aktiviran</th>
										<th scope="col">Br. nekretnina</th>
										<th scope="col">Detalji</th>
										<th scope="col">Blokiraj</th>
									  </tr>
									</thead>
									<tbody>
									
									<?php
									
										$offset = isset($_GET['offset'])?$_GET['offset']:0;
										get_user_list($offset); 
										$count = getUserCount()-1;
										$pag_count = ceil($count/10);
										
										$current = ceil($offset/10);
										
										$prev = ($offset/10) - 1;
										if($prev <= 0) $prev = 0;
										
										$next = ($offset/10) + 1;
										if($next >= $pag_count) $next = $pag_count;
										
										
									?>
								   
									</tbody>
								  </table>
								  
								 <nav aria-label="Page navigation example">
								  <ul class="pagination">
									<li class="page-item <?=($prev==0?'disabled':'')?>"><a class="page-link" href="?offset=<?=$prev?>">Previous</a></li>
									<?php
										for($i = 0; $i<= $pag_count-1; $i++){
											$sel = ($current == $i)?'disabled':'';
											$index = $i+1;
											echo "<li class='page-item $sel'><a class='page-link' href='?offset=$i'>$index</a></li>";
										}
									?>
									<li class="page-item <?=($next==$pag_count?'disabled':'')?>"><a class="page-link" href="?offset=<?=$next?>">Next</a></li>
								  </ul>
								</nav>
											  
							</div>
						</div>
					</div>
				</div>
                </div>
                
                <footer class="pt-5 d-flex justify-content-between">
                    <span>Copyright © <?=date('Y')?> <a href="../index.php"><?=$config['naziv']?></a></span>
                </footer>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js" integrity="sha384-oesi62hOLfzrys4LxRF63OJCXdXDipiYWBnvTl9Y9/TRlw5xlKIEHpNyvvDShgf/" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/chartist.js/latest/chartist.min.js"></script>
 
</body>
</html>