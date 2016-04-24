<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
	rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
</head>
<script type="text/javascript">
	$(document).ready(function(){
		$('.dropdown-toggle').dropdown()
	});
//This is  function close the session the user
function closeSession(){
	;
	
	var parametros = {
		"Token" :localStorage.getItem('Token')
	};
	$.ajax({
		data:  parametros,
		url:   'closeSession.php',
		type:  'post',
		beforeSend: function () {
			$("#resultado").html("Procesando, espere por favor...");
		},
		success:  function (response) {
			localStorage.clear();
			//window.location.href="http://localhost/intercambealo_api/client_intercambealo/login.html";
			$("#resultado").html(response);
		}
	});

}
</script>
<body class="allDashboard" >
	<div class="cover">

	</div>
	<nav>
		<li class="dashboard"><a href=""><i class="material-icons ">cloud_done</i>Dashboard</a></li>
		<ul class="nav nav-pills">

			<li role="presentation" ><a href="login.php">Login</a></li>
			<li role="presentation"><a href="product.php">Products</a></li>
			<li role="presentation" class="active" ><a href="#">Transaction</a></li>
			<li role="presentation"><a href="register.php">Register User</a></li>
			<li><a href=""></a></li>
			<li class="dropdown"> <a id="drop1" href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="material-icons">settings</i> <span class="caret"></span> </a> 
				<ul class="dropdown-menu" aria-labelledby="drop1"> <li><a href="#" onclick="closeSession();">Close session</a></li> 
				</ul>
			</li>
		</nav>

		<div class="container">
			<div class="row">

			</div>
		</div>

		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

	</body>
	</html>