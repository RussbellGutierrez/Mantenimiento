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
    <!--SweetAlert2-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>
</head>
<body>
	<?php if(!isset($_COOKIE['_seb'])) {?>
	<script>
		window.location.href = "index.php"
	</script><?php }else {?>
    <div class="container log-container">
		<div class="card ">
			<?php if(base64_decode($_COOKIE['_seb'])==="oriunda") {?>
			<img id="profile-img" class="profile-img-card" src="resources/images/oriunda-circular.png" />
			<?php }else{?>
			<img id="profile-img" class="profile-img-card" src="resources/images/terranorte-circular.png" />
            <?php }?>
            <form id="formulario" class="form-signin">
                <input type="text" id="inputUser" class="form-control" placeholder="Usuario" required autofocus>
                <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required>
                <label class="check-margin"><input id="remember" type="checkbox"> Recordarme</label>
                <button id="login" type="submit" class="btn btn-lg btn-primary btn-block btn-signin">Ingresar</button>
            </form>
        </div>
	</div>
	<script>
		$(document).ready(function(){
			if (localStorage.getItem("user") !== null) {
				$('#inputUser').val(localStorage.getItem("user"))
				$('input[type=checkbox]').prop('checked',true)
			}else{
				$('#inputUser').val('')
				$('#inputPassword').val('')
				$('input[type=checkbox]').prop('checked',false)
			}
			$('#formulario').submit(function( event ) {
				event.preventDefault()
				if ($('input[type=checkbox]').prop('checked')) {
					localStorage.setItem("user",$('#inputUser').val())
				}else{
					localStorage.clear()
				}
				$.ajax({
					type: 'POST',
					url: 'http://200.110.40.58/api/usuario/ingresar',
					dataType: 'json',
					contentType: 'application/json; charset=utf-8',
					xhrFields:{withCredentials:false},
					crossDomain: true,
					data: JSON.stringify({'usuario':$('#inputUser').val(),'clave':$('#inputPassword').val(),'empresa':<?php echo (base64_decode($_COOKIE['_seb'])==='oriunda')?1:2;?>}),
					statusCode:{
						200: function(){
							<?php if(base64_decode($_COOKIE['_seb'])==="oriunda") {?>
								$.post('manejoSesiones.php',{parametro:3},function(){window.location.href = "oriunda.php"})
							<?php }else{?>
								$.post('manejoSesiones.php',{parametro:4},function(){window.location.href = "terranorte.php"})
							<?php }?>
						},400: function(){
							swal('Error','Sintaxis de solicitud erronea','error')
						},404: function(){
							swal('Error','Página no encontrada','error')
						},405: function(){
							swal('Advertencia','Usuario y contraseña incorrectos','warning')
						}
					}
				})
			})
			$('#login').on('click',function(){
				$('#formulario').submit()
			})
		})
	</script><?php }?>
	<style>
	.log-container{
		max-width: 350px;
	}
	body{
		background: url(resources/images/fondo.jpg) no-repeat center center fixed;
		background-size: cover;
		min-height: 100%;
		min-height: 100vh;
		display: flex;
		align-items: center;
	}
	.card-container.card {
	    max-width: 350px;
	    padding: 40px 40px;
	}
	.btn {
	    font-weight: 700;
	    height: 36px;
	    -moz-user-select: none;
	    -webkit-user-select: none;
	    user-select: none;
	    cursor: default;
	}
	/*
	 * Card component
	 */
	.card {
	    background-color: #F7F7F7;
	    /* just in case there no content*/
	    padding: 20px 25px 30px;
	    margin: 0 auto 25px;
	    margin-top: 50px;
	    /* shadows and rounded borders */
	    -moz-border-radius: 2px;
	    -webkit-border-radius: 2px;
	    border-radius: 2px;
	    -moz-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	    -webkit-box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.3);
	}
	.profile-img-card {
	    width: 96px;
	    height: 96px;
	    margin: 0 auto 10px;
	    display: block;
	    -moz-border-radius: 50%;
	    -webkit-border-radius: 50%;
	    border-radius: 50%;
	    border: 1px solid #606060;
	}
	/*
	 * Form styles
	 */
	.check-margin{
		margin-bottom: 20px;
	}
	.form-signin{
		margin-top: 15px;
	}
	.form-control{
		margin-top: 20px;
		margin-bottom: 20px;
	}
	.profile-name-card {
	    font-size: 16px;
	    font-weight: bold;
	    text-align: center;
	    margin: 10px 0 0;
	    min-height: 1em;
	}
	.form-signin #inputUser,
	.form-signin #inputPassword {
	    direction: ltr;
	    height: 44px;
	    font-size: 16px;
	}
	.form-signin input[type=password],
	.form-signin input[type=text],
	.form-signin button {
	    width: 100%;
	    display: block;
	    z-index: 1;
	    position: relative;
	    -moz-box-sizing: border-box;
	    -webkit-box-sizing: border-box;
	    box-sizing: border-box;
	}
	.form-signin .form-control:focus {
	    border-color: rgb(104, 145, 162);
	    outline: 0;
	    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
	    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgb(104, 145, 162);
	}
	.btn.btn-signin {
	    background-color: rgb(104, 145, 162);
	    padding: 0px;
	    font-weight: 700;
	    font-size: 14px;
	    height: 36px;
	    -moz-border-radius: 3px;
	    -webkit-border-radius: 3px;
	    border-radius: 3px;
	    border: none;
	    -o-transition: all 0.218s;
	    -moz-transition: all 0.218s;
	    -webkit-transition: all 0.218s;
	    transition: all 0.218s;
	}
	.btn.btn-signin:hover,
	.btn.btn-signin:active,
	.btn.btn-signin:focus {
	    background-color: #2358DB;
	}
	</style>
</body>
</html>