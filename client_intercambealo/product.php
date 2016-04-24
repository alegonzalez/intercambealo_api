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
	(function(){ 

		$(".product").remove();
		$.ajax({
			url:   'getProduct.php',
			type:  'get',
			beforeSend: function () {
				$("#resultado").html("Procesando, espere por favor...");
			},
			success:  function (response) {
				
				if(response.message == "error"){
					alert("Error");
					console.log("lalala");
				}else{
					
					var product = response.message;
					
					for (var i = 0; i<= product.length-1; i++) {
						createElement(product[i].name);
					}

					
				}
				$("#resultado").html(response);
			}
		});
	})();
	//create the element html for product
	function createElement(name){
		var txt1 = "<div class ='col-md-3 product'>" + 
		"<h3 class='tituleProduct'>"+ name +"</h3>"+
		"<div class = 'col-md-7 col-md-offset-2 imageProduct'>" +"<img src='new.png' class='img-thumbnail'>" + "</div>"+
		"<div class='col-md-6'> "+ "<button type='button' class='btn btn-danger actionProduct'> "+ "<i class='material-icons'>delete_forever</i>" +"</button>"+ "</div>"+
		"<div class='col-md-6'> "+ "<button type='button' class='btn btn-primary actionProduct'> "+ "<i class='material-icons'>update</i>" +"</button>"+ "</div>"+
		+"</div>";

		var res = txt1.replace("NaN", "");
		$(".row").append(res); 	
	}

</script>

<body class="allDashboard" >
	<div class="cover">

	</div>
	<nav>
		<li class="dashboard"><a href=""><i class="material-icons ">cloud_done</i>Dashboard</a></li>
		<ul class="nav nav-pills">

			<li role="presentation" ><a href="login.php">Login</a></li>
			<li role="presentation" class="active"><a href="#">Products</a></li>
			<li role="presentation"  ><a href="#">Transaction</a></li>
			<li role="presentation"><a href="register.php">Register User</a></li>
		</ul>
	</nav>
	
	<div class="container">
		<div class="row">

		</div>
	</div>

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

</body>
</html>