<?php 
	include 'sql_driver.php';
	include '../tools.php';
	include '../global.php';
	if(!isAdmin())header('Loacation:../index.php');
	$admin_id = $config['admin'];
	
	if(isset($_POST['account-admin'])){
	$name = isset($_POST['name'])?$_POST['name']:false;
	$email = isset($_POST['email'])?$_POST['email']:false;
	$password = isset($_POST['password'])?$_POST['password']:false;
	$confirm_password = isset($_POST['confirm_password'])?$_POST['confirm_password']:false;
	if($password == $confirm_password){
		$password = md5($password);
	}else{
		header('Location:podesavanja.php?err=Password missmatch');
	}
	
	$sql =	"UPDATE `korisnik` SET ime = '$name', password = '$password', email = '$email' WHERE id = $admin_id ";
	
	$res = mysqli_query($db_conn,$sql);
	if($res){
		header('Location:podesavanja.php?msg=uspjesno promjena podesavanja naloga');
	}else{
		die('Error to change account data...');
	}
	}	
	
	if(isset($_POST['estate-agency'])){
	$name = isset($_POST['name'])?$_POST['name']:false;
	$email = isset($_POST['email'])?$_POST['email']:false;
	$tel = isset($_POST['tel'])?$_POST['tel']:false;
	$address = isset($_POST['address'])?$_POST['address']:false;
	
	$email_host = isset($_POST['email_host'])?$_POST['email_host']:false;
	$email_username = isset($_POST['email_username'])?$_POST['email_username']:false;
	$email_password = isset($_POST['email_password'])?$_POST['email_password']:false;
	$api_key = isset($_POST['api_key'])?$_POST['api_key']:false;
	
	$about = isset($_POST['about'])?$_POST['about']:false;
	
	$sql =	"UPDATE `agencija` SET naziv = '$name',telefon = '$tel',email = '$email',adresa = '$address', o_nama = '$about',
	map_api = '$api_key',email_host = '$email_host',email_username = '$email_username',email_password = '$email_password'";
	
	$res = mysqli_query($db_conn,$sql);
	if($res){
		 header('Location:podesavanja.php?msg=uspjesno promjena podesavanja agencije');
		
	}else{
		die('Error to change estate agency data...');
	}
	}
	
	
	if(isset($_POST['configuration'])){
	$db_host = isset($_POST['db_host'])?$_POST['db_host']:false;
	$db_name = isset($_POST['db_name'])?$_POST['db_name']:false;
	$username = isset($_POST['user'])?$_POST['user']:false;
	$password = isset($_POST['password'])?$_POST['password']:false;
	
	$out = ['db_host'=>$db_host,'db_name'=>$db_name,'username'=>$username, 'password'=>$password];
	
	if(file_put_contents('../config.conf', serialize($out))){
		
		 header('Location:podesavanja.php?msg=uspjesno promjena podesavanja konfiguracija mysql servera');
	}else{
		die('Error to change configuraiton data...');
	}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Podesavanja</title>
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
                          <a class="nav-link" aria-current="page" href="korisnici.php">
                            <i class = 'fa fa-user fa-2x'></i>
							<span class="ml-2 h5">Korisnici</span>
                          </a>
                        </li>
						
						<li class="nav-item">
                          <a class="nav-link active" aria-current="page" href="podesavanja.php">
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
                        <li class="breadcrumb-item active" aria-current="page">Podesavanja</li>
                    </ol>
                </nav>
                <h1 class="h2">Podesavanja</h1>
                <?php 
					$rez = mysqli_query($db_conn,"SELECT * FROM korisnik WHERE id = $admin_id");
					$account = mysqli_fetch_assoc($rez);
				?>
				
				 <div class="row my-4">
                    <div class="col-12 col-xl-12 mb-12 mb-lg-12">
                        <div class="card">
                            <h5 class="card-header">Account</h5>
                            <div class="card-body">
                                <form method='post' id="contact-form" role="form">
								<div class="controls">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group"> <label for="name">Username: </label> <input id="name" value = '<?=$account['ime']?>' type="text" name="name" class="form-control" placeholder="Please enter your username" required="required" data-error="Username is required."> </div>
										</div>
										<div class="col-md-6">
											<div class="form-group"> <label for="email">Email: </label> <input id="email" value = '<?=$account['email']?>' type="email" name="email" class="form-control" placeholder="Please enter your email" required="required" data-error="Email is required."> </div>
										</div>
									</div>
									
									<div class="row mt-4">
										<div class="col-md-6">
											<div class="form-group"> <label for="password">New password: </label> <input id="password" value = '' type="password" name="password" class="form-control" placeholder="Enter New Password" required="required" data-error="Password is required."> </div>
										</div>
										<div class="col-md-6">
											<div class="form-group"> <label for="confirm_password"> Confirm Password: </label> <input id="confirm_password" value = '' type="password" name="confirm_password" class="form-control" placeholder="Confirm Password" required="required" data-error="Password is required."> </div>
										</div>
									</div>
									
									<div class='mt-3 form-group'>
									<button  class = 'btn btn-success float-right' name='account-admin' type="submit">Save</Button>
								  </div>
								</div>
							</form>
                            </div>
                        </div>
                    </div>
                   
                </div>
				
				<div class="row my-4">
                   
				   <?php 
					$rez = file_get_contents('../config.conf');
					$conf = unserialize($rez);
					?>
				
				<div class="col-12 col-xl-12 mb-12 mb-lg-12">
                        <div class="card">
                            <h5 class="card-header">Configuration</h5>
                            <div class="card-body">  
							<form method='post' id="contact-form" role="form">
								<div class="controls">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group"> <label for="db_host">DB host: </label> <input id="db_host" value = '<?=$conf['db_host']?>' type="text" name="db_host" class="form-control" placeholder="Please enter your DB host name" required="required" data-error="DB host is required."> </div>
										</div>
										<div class="col-md-6">
											<div class="form-group"> <label for="db_name">DB name: </label> <input id="db_name" value = '<?=$conf['db_name']?>' type="text" name="db_name" class="form-control" placeholder="Please enter your DB name" required="required" data-error="DB name is required."> </div>
										</div>
									</div>
									<div class="row mt-2">
										<div class="col-md-6">
											<div class="form-group"> <label for="user">DB User: </label> <input id="user" value = '<?=$conf['username']?>' type="text" name="user" class="form-control" placeholder="Please enter your username" required="required" data-error="Username is required."> </div>
										</div>
										<div class="col-md-6">
											<div class="form-group"> <label for="password">DB Password: </label> <input id="password" value = '<?=$conf['password']?>' type="password" name="password" class="form-control" placeholder="Please enter your password" data-error="password is required."> </div>
										</div>
									</div>
									
									<div class='mt-3 form-group'>
									<button  class = 'btn btn-warning float-right' onclick = 'if(!confirm("Da li ste sigurni?"))event.preventDefault();' name='configuration' type="submit">Save</Button>
								  </div>
								</div>
							</form>
						</div>
					</div>
				</div> <!-- /.8 -->
				
                </div>
				
				  <?php 
					$rez = mysqli_query($db_conn,"SELECT * FROM agencija");
					$agency = mysqli_fetch_assoc($rez);
				?>
				
				<div class="row">
                    <div class="col-12 col-xl-12 mb-12 mb-lg-12">
                        <div class="card">
                            <h5 class="card-header">Estate Agency</h5>
                            <div class="card-body">
                                <form method='post' id="contact-form" role="form">
								<div class="controls">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group"> <label for="name">Agency Name: </label> <input id="name" value = '<?=$agency['naziv']?>' type="text" name="name" class="form-control" placeholder="Please enter your Estate Agency Name" required="required" data-error="Agency name is required."> </div>
										</div>
										<div class="col-md-6">
											<div class="form-group"> <label for="email">Agency email: </label> <input id="email" value = '<?=$agency['email']?>' type="email" name="email" class="form-control" placeholder="Please enter your agency contact email" required="required" data-error="Agency email is required."> </div>
										</div>
									</div>
									<div class="row mt-2">
										<div class="col-md-6">
											<div class="form-group"> <label for="tel">Telephone: </label> <input id="tel" value = '<?=$agency['telefon']?>' type="tel" name="tel" class="form-control" placeholder="Please enter your agency telephone" required="required" data-error="Agency telephone is required."> </div>
										</div>
										<div class="col-md-6">
											<div class="form-group"> <label for="address">Address: </label> <input id="address" value = '<?=$agency['adresa']?>' type="text" name="address" class="form-control" placeholder="Please enter your agency address" data-error="Address is required."> </div>
										</div>
									</div>
									
									<div class="row mt-4">
										<div class="col-md-6">
											<div class="form-group"> <label for="email_host">Email Host: </label> <input id="email_host" value = '<?=$agency['email_host']?>' type="text" name="email_host" class="form-control" placeholder="Email Host" required="required" data-error="Email host is required."> </div>
										</div>
										<div class="col-md-6">
											<div class="form-group"> <label for="email_username">Email username: </label> <input id="email_username" value = '<?=$agency['email_username']?>' type="text" name="email_username" class="form-control" placeholder="Email username@host" data-error="Email username is required."> </div>
										</div>
									</div>
									
									<div class="row mt-4">
										<div class="col-md-6">
											<div class="form-group"> <label for="email_password">Email Password: </label> <input id="email_password" value = '<?=$agency['email_password']?>' type="password" name="email_password" class="form-control" placeholder="Email Password" required="required" data-error="Email password is required."> </div>
										</div>
										<div class="col-md-6">
											<div class="form-group"> <label for="api_key">API key: </label> <input id="api_key" value = '<?=$agency['map_api']?>' type="text" name="api_key" class="form-control" placeholder="Google map api key" data-error="API key is required."> </div>
										</div>
									</div>
									
									<div class="row mt-4">
										<div class="col-md-12">
											<div class="form-group"> <label for="about">About: </label> <textarea id="about" name="about" rows=7 class="form-control" placeholder="About your estate agency..." required="required" data-error="Email password is required."><?=$agency['o_nama']?></textarea> </div>
										</div>
									</div>
									
									<div class='mt-3 form-group'>
									<button  class = 'btn btn-success float-right' name='estate-agency' type="submit">Save</Button>
								  </div>
								</div>
							</form>
                            </div>
                        </div>
                    </div>
                   
                </div>
				
				<div class="col-12 col-xl-12 mb-12 mb-lg-12">
                        <div class="card">
                            <h5 class="card-header">Reset system</h5>
                            <div class="card-body">  
								<div class="alert alert-danger" role="alert">
									Koriscenjem ove funkcije briste bazu podataka i ostale podatke o sistemu!!!
								</div>
								<form action='../reset_system.php'>
									<button  class = 'btn btn-danger float-right' onclick = 'if(!confirm("Da li ste sigurni?"))event.preventDefault();' name='configuration' type="submit">Resetuj sistem</Button>
								</form>
						</div>
					</div>
				</div> <!-- /.8 -->
				
             
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