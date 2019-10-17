<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="resources/icons/logo.ico" type="image/ico">
	<title>Mantenimiento</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="card border-light mb-3">
		  <div class="card-header">EMPRESA</div>
		  <div class="card-body">
		  	<div class="card-deck">
			  <div class="card text-white bg-dark mb-3">
			    <img class="card-img-top" src="resources/images/oriunda.jpg" alt="Card image cap">
			    <div class="card-body">
			      <h5 class="card-title">ORIUNDA</h5>
			      <p class="card-text">Mantenimiento de productos</p>
			      <button id="oriunda" type="button" class="btn btn-primary">Comenzar</button>
			    </div>
			  </div>
			  <div class="card text-white bg-dark mb-3">
			    <img class="card-img-top" src="resources/images/terranorte.jpg" alt="Card image cap">
			    <div class="card-body">
			      <h5 class="card-title">TERRANORTE</h5>
			      <p class="card-text">Mantenimiento de productos</p>
			      <button id="terranorte" type="button" class="btn btn-primary">Comenzar</button>
			    </div>
			  </div>
			</div>
		  </div>
		</div>
	</div>
	<script>
		$('#oriunda').on('click',function(){
			$.post('manejoSesiones.php',{parametro:1},function(){
				window.location.href = "login.php"
			})
		})
		$('#terranorte').on('click',function(){
			$.post('manejoSesiones.php',{parametro:2},function(){
				window.location.href = "login.php"
			})
		})
	</script>
	<style>
	body{
		background: url(resources/images/fondo.jpg) no-repeat center center fixed;
		background-size: cover;
		min-height: 100%;
		min-height: 100vh;
		display: flex;
		align-items: center;
	}
	</style>
</body>
</html>