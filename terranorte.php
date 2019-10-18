<!DOCTYPE html>
<html lang="es">
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="icon" href="resources/icons/logo.ico" type="image/ico">
	<title>Mantenimiento || Terranorte</title>
	<!--Bootstrap Styles-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
	<!--Bootstrap Scripts jQuery first, then Popper.js, then Bootstrap JS-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/popper.js@1.12.6/dist/umd/popper.js" integrity="sha384-fA23ZRQ3G/J53mElWqVJEGJzU0sTs+SvzG8fXVWP+kJQ1lwFAOkcUOysnlKJC33U" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/bootstrap-material-design@4.1.1/dist/js/bootstrap-material-design.js" integrity="sha384-CauSuKpEqAFajSpkdjv3z9t8E7RlpJ1UP0lKM/+NdtSarroVKu069AlsRPKkFBz9" crossorigin="anonymous"></script>
	<!--SweetAlert2-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.29.2/sweetalert2.all.js"></script>
	<!--DataTables-->
	<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
	<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<!--FontAwesome-->
	<script defer src="https://use.fontawesome.com/releases/v5.6.1/js/all.js" integrity="sha384-R5JkiUweZpJjELPWqttAYmYM1P3SNEJRM6ecTQF05pFFtxmCO+Y1CiUhvuDzgSVZ" crossorigin="anonymous"></script>
	<!--StylesCustom-->
	<link rel="stylesheet" type="text/css" href="styles/estiloCustom.css">
</head>
<body>
	<?php if(!isset($_COOKIE['_rac'])){?>
	<script>
		window.location.href = "index.php"
	</script><?php }elseif(isset($_COOKIE['_rac']) && base64_decode($_COOKIE['_rac'])==='oriunda') {?>
	<script>
		window.location.href = "index.php"
	</script><?php }else {?>
	<div class="container">
		<div class="row">
			<div class="cus-pad col-md-3">
			  	<div class="border-right border-dark">
			  		<div class="row">
			  			<div class="cus-border col-md-12">
			  				<h6 class="d-flex justify-content-center">SEGMENTO-CATEGORIA</h6>
			  				<div class="scrollbar-mini scrollbar-danger">
			  					<ul id="categoria" class="list-group"></ul>
			  				</div>
			  			</div>
			  			<div class="cus-border col-md-12">
			  				<h6 class="d-flex justify-content-center">SEGMENTO-LINEA</h6>
			  				<div class="scrollbar-mini scrollbar-danger">
			  					<ul id="linea" class="list-group"></ul>
			  				</div>
			  			</div>
			  			<div class="cus-border col-md-12">
			  				<h6 class="d-flex justify-content-center">SEGMENTO-GENERICO</h6>
			  				<div class="scrollbar-mini scrollbar-danger">
			  					<ul id="generico" class="list-group"></ul>
			  				</div>
			  			</div>
			  			<div class="cus-border col-md-12">
			  				<h6 class="d-flex justify-content-center">SEGMENTO-FAMILIA</h6>
			  				<div class="scrollbar-mini scrollbar-danger">
			  					<ul id="familia" class="list-group"></ul>
			  				</div>
			  			</div>
			  		</div>
			  	</div>
		  	</div>
		  	<div class="col-md-9">
		  		<div class="row">
		  			<div class="cus-border-table col-xs-7 col-md-11">
		  				<h6 class="d-flex justify-content-center">ARTICULOS</h6>
		  				<div class="cus-back">
		  					<table id="tabla" class="display" style="width:100%">
								<thead>
						            <tr>
						                <th style="width: 10%">Codigo</th>
						                <th style="width: 60%">Descripcion</th>
						                <th style="width: 12%">Pres.</th>
						                <th style="width: 8%">Peso</th>
						                <th style="width: 5%">Fac.</th>
						                <th style="width: 5%">Ord.</th>
						            </tr>
						        </thead>
							</table>
		  				</div>
			  		</div>
			  		<div class="cus-border-button col-xs-5 col-md-1">
			  			<a id="pendiente" class="btn cus-icon" data-toggle="tooltip" data-placement="right" title="Articulos libres"><i class="fas fa-users"></i></a>
			  			<a id="subir" class="btn cus-icon" data-toggle="tooltip" data-placement="right" title="Subir una posicion"><i class="fas fa-arrow-up"></i></a>
			  			<a id="bajar" class="btn cus-icon" data-toggle="tooltip" data-placement="right" title="Bajar una posicion"><i class="fas fa-arrow-down"></i></a>
			  			<a id="crear" class="btn cus-icon" data-toggle="tooltip" data-placement="right" title="Crear segmento"><i class="fas fa-sitemap"></i></a>
			  			<a id="incluir" class="btn cus-icon" data-toggle="tooltip" data-placement="right" title="Asignar/Reasignar articulo"><i class="fas fa-share-square"></i></a>
			  			<a id="editar" class="btn cus-icon" data-toggle="tooltip" data-placement="right" title="Editar descripcion articulo"><i class="fas fa-pen-alt"></i></a>
			  			<a id="ordenar" class="btn cus-icon" data-toggle="tooltip" data-placement="right" title="Ordenar articulos"><i class="fas fa-list-ol"></i></a>
			  		</div>
		  		</div>
			</div>
		</div>
	</div>
	<div id="modal-1" class="modal fade" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="m-titulo-1"></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        	<i id="iconClose" class="fas fa-times-circle"></i>
	        </button>
	      </div>
	      <div id="m-cuerpo-1" class="modal-body">
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Cerrar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<div id="modal-2" class="modal fade" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered modal-dialog-left" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="m-titulo-2"></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        	<i id="iconClose" class="fas fa-times-circle"></i>
	        </button>
	      </div>
	      <div id="m-cuerpo-2" class="modal-body">
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Cerrar</button>
	      	<button id="asignar" type="button" class="btn btn-success">Asignar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<div id="modal-3" class="modal fade" role="dialog" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="m-titulo-3"></h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	        	<i id="iconClose" class="fas fa-times-circle"></i>
	        </button>
	      </div>
	      <div id="m-cuerpo-3" class="modal-body">
	      </div>
	      <div class="modal-footer">
	      	<button type="button" class="btn btn-secondary close-modal" data-dismiss="modal">Cerrar</button>
	      	<button id="actualizar" type="button" class="btn btn-success">Actualizar</button>
	      </div>
	    </div>
	  </div>
	</div>
	<input id="accion" type="hidden" value="">
	<script>
		$(document).ready(function() { 
			$.post('anularArticulos.php',{basedatos:'terranorte'},function(){
				$('[data-toggle="tooltip"]').tooltip()
				limpiarTablas(7)
				llenandoCategorias()
				$('#subir').on('click',function(){
					if (!$('#familia button').hasClass('active')) {
						swal({
							type: 'warning',
							title: 'Función disponible solo para familias',
							showConfirmButton: false,
							timer: 2000
						})
					}else{
						if ($('#tabla tbody tr').hasClass('selected')){
							let valor = $('#tabla').DataTable().row('tbody tr.selected').data()
							const posicion = parseInt(valor.orden) - 1
							if (posicion < 1) {
								swal({
									type: 'error',
									title: 'No puede subir más',
									showConfirmButton: false,
									timer: 2000
								})
							}else{
								let familia = $('#familia button.active').val()
								let datos = $('#categoria button.active').val().split('@')[0]+'@'+$('#linea button.active').val().split('@')[0]+'@'+familia.split('@')[2]+'@'+familia.split('@')[0]
								let param = valor.articulo+'@'+valor.orden+'@'+posicion
								$.post('posicionarProducto.php',{basedatos:'terranorte',opcion:1,familia:familia,parametros:param},function(){
									limpiarTablas(4)
									llenandoArticulos(datos,valor.articulo)
								})
							}
						}else {
							swal({
								type: 'info',
								title: 'Debe seleccionar un articulo',
								showConfirmButton: false,
								timer: 2000
							})
						}
					}
				})

				$('#bajar').on('click',function(){
					if (!$('#familia button').hasClass('active')) {
						swal({
							type: 'warning',
							title: 'Función disponible solo para familias',
							showConfirmButton: false,
							timer: 2000
						})
					}else{
						if ($('#tabla tbody tr').hasClass('selected')){
							let valor = $('#tabla').DataTable().row('tbody tr.selected').data()
							const filas = $('#tabla').DataTable().rows().count()
							const posicion = parseInt(valor.orden) + 1
							if (posicion > filas) {
								swal({
									type: 'error',
									title: 'No puede bajar más',
									showConfirmButton: false,
									timer: 2000
								})
							}else{
								let familia = $('#familia button.active').val()
								let datos = $('#categoria button.active').val().split('@')[0]+'@'+$('#linea button.active').val().split('@')[0]+'@'+familia.split('@')[2]+'@'+familia.split('@')[0]
								let param = valor.articulo+'@'+valor.orden+'@'+posicion
								$.post('posicionarProducto.php',{basedatos:'terranorte',opcion:1,familia:familia,parametros:param},function(){
									limpiarTablas(4)
									llenandoArticulos(datos,valor.articulo)
								})
							}
						}else {
							swal({
								type: 'info',
								title: 'Debe seleccionar un articulo',
								showConfirmButton: false,
								timer: 2000
							})
						}
					}
				})

				$('#editar').on('click',function(){
					if ($('#tabla tbody tr').hasClass('selected')) {
						let fila = $('#tabla').DataTable().row('tbody tr.selected').data()
						let item = "<table class='display' style='width:100%'>"
						item += "<tbody>"
						item += "<tr><td>ARTICULO</td><td>:</td><td>"+fila.descrip+"<input id='articulo' type='hidden' value="+fila.articulo+"></td></tr>"
						item += "<tr><td>NUEVO NOMBRE</td><td>:</td><td><input id='descripcion' type='text' class='form-control' placeholder='Nueva descripcion' style='width:100%'></td></tr>"
						item += "</tbody>"
						item += "</table>"
						$('#modal-3').modal({
							backdrop: true,
							keyboard: true
						})
						$('#modal-3').on('hidden.bs.modal', function() {
							$('#tabla').DataTable().destroy()
							let datos = $('#categoria button.active').val().split('@')[0]+'@'+$('#linea button.active').val().split('@')[0]+'@'+$('#generico button.active').val().split('@')[0]+'@'+$('#familia button.active').val().split('@')[0]
							llenandoArticulos(datos,fila.articulo)
						})
						$('#m-titulo-3').html('<i class="fas fa-pencil-alt"></i> Editar descripcion')
						$('#m-cuerpo-3').html(item)
					}else {
						swal({
							type: 'info',
							title: 'Debe seleccionar un articulo',
							showConfirmButton: false,
							timer: 2000
						})
					}
				})

				$('#crear').on('click',function(){
					let item = "<div style='display:flex;align-items: baseline;'>"
						item += "<div id='agregarFila' onclick='aparecerDesaparecerFila(0)' style='text-align: center;margin: 0px 10px 0px 10px;'><i class='fas fa-plus'></i></div>"
						item += "<div style='margin: 0px 10px 0px 10px;'><input id='anuladosVisible' type='checkbox'><label>Mostrar anulados</label></div>"
						item += "<select id='segmentos' style='width: 250px;text-align-last: center;margin: 0px 10px 0px 10px;'><option value='0'>--Seleccione--</option><option value='1'>CATEGORIA</option><option value='2'>LINEA</option><option value='3'>GENERICO</option><option value='4'>FAMILIA</option></select>"
						item += "</div>"
						item += '<div id="fila" style="display:flex;"><input id="codigoNuevo" type="number" style="width:15%;" onkeypress="return soloNumeros(event,0)" onkeyup=checkMaximo(event,"codigoNuevo",1) value="1"><input id="descripNuevo" type="text" style="width:71%;"><div onclick="guardarNuevoSegmento()" style="width:14%;text-align: center;align-self: center;"><i class="fas fa-save"></i></div></div>'
						item += '<div id="buscador" class="input-group input-group-sm mb-3">'
						item += '<div class="input-group-prepend"><span class="input-group-text"><i class="fas fa-search"></i></span></div>'
						item += '<input id="buscar" type="text" class="form-control" onkeyup="buscarLista()" placeholder="Buscar por nombre...">'
						item += '</div>'
						item += "<div id='listaSegmentos' class='scrollbar-mini scrollbar-danger scr-content'>"
						item += "<ul id='lista' class='list-group'>"
						item += "</ul>"
						item += "</div>"
					$('#modal-1').modal({
						backdrop: true,
						keyboard: true
					})
					$('#modal-1').on('hidden.bs.modal', function() {
						limpiarTablas(6)
					})
					$('#m-titulo-1').html('<i class="fas fa-users"></i> Crear segmento')
					$('#m-cuerpo-1').html(item)
					$('#anuladosVisible').on('click',function(){
						if ($('#anuladosVisible').prop('checked')) {
							$('div.anulado-segmento').remove()
							$.post('obtenerSegmento.php',{basedatos:'terranorte',opcion:$('#segmentos').val(),anulado:1,orden:1},function(e){
								let anulados = ''
								const json = JSON.parse(e)
								$.each(json,function(i,value){
									anulados += '<div class="anulado-segmento" style="display:flex;"><input id="c'+value.id+'" class="subrayado" value="'+value.id+'" style="width:15%;border:0;" readonly><input id="'+value.id+'" class="subrayado seg-lista" type="text" style="width:71%;border:0;" value="'+value.descrip+'" readonly><div id="e'+value.id+'" style="width:7%;text-align: center;align-self: center;display: none;" onclick="editarDescripcion(\''+value.id+'\')"><i id="ie'+value.id+'" class="fas fa-pencil-alt"></i></div><div id="a'+value.id+'" style="width:7%;text-align: center;align-self: center;" onclick="anularSegmento(\''+value.id+'\')"><i id="ia'+value.id+'" class="fas fa-redo"></i></div></div>'
								})
								$('#listaSegmentos').addClass('active')
								$('#lista').append(anulados)
							})
						}else {
							$('div.anulado-segmento').remove()
						}
					})
					aparecerDesaparecerFila(2)
					$('#segmentos').on('change',function(){
						switch($(this).val()){
							case '0':
							aparecerDesaparecerFila(2)
							$('#listaSegmentos').removeClass('active')
							let segvacio = ""
							$('#lista').append(segvacio)
							break
							default:
							aparecerDesaparecerFila(1)
							$('#lista').empty()
							let segmentos = ''
							$.post('obtenerSegmento.php',{basedatos:'terranorte',opcion:$(this).val(),anulado:0,orden:1},function(e){
								const json = JSON.parse(e)
								$.each(json,function(i,value){
									segmentos += '<div style="display:flex;"><input id="c'+value.id+'" value="'+value.id+'" style="width:15%;border:0;" readonly><input id="'+value.id+'" class="seg-lista" type="text" style="width:71%;border:0;" value="'+value.descrip+'" readonly><div id="e'+value.id+'" style="width:7%;text-align: center;align-self: center;" onclick="editarDescripcion(\''+value.id+'\')"><i id="ie'+value.id+'" class="fas fa-pencil-alt"></i></div><div id="a'+value.id+'" style="width:7%;text-align: center;align-self: center;" onclick="anularSegmento(\''+value.id+'\')"><i id="ia'+value.id+'" class="fas fa-trash-alt"></i></div></div>'
								})
								$('#listaSegmentos').addClass('active')
								$('#lista').append(segmentos)
							})
							break
						}
					})
				})

				$('#actualizar').on('click',function(){
					if ($('#descripcion').val() == '') {
						swal({
							type: 'warning',
							title: 'Debe asignar una descripción',
							showConfirmButton: false,
							timer: 2000
						})
					}else {
						let parametros = $('#descripcion').val()+'@'+$('#articulo').val()
						$.post('editarArticulo.php',{basedatos:'terranorte',parametros:parametros},function(e){
							if (e == 'success') {
								swal({
									type: 'success',
									title: 'Se actualizo descripcion del articulo',
									showConfirmButton: false,
									timer: 1500
								})
								$('#modal-3').modal('toggle')
							}else{
								swal({
									type: 'error',
									title: 'Ocurrio un error al actualizar descripcion',
									showConfirmButton: false,
									timer: 2000
								})
							}
						})
					}
				})

				$('#incluir').on('click',function(){
					let t = []
					let p = []
					if ($('#tabla tbody tr').hasClass('selected')){
						let categoria = ""
						let linea = ""
						let generico = ""
						let familia = ""
						$('#tabla').DataTable().rows('.selected').every(function(rowIdx, tableLoop, rowLoop){
							let data = this.data()
							let obj = new Object()
							obj.id = data.articulo
							obj.descrip = data.descrip
							obj.categoria = data.categoria
							obj.linea = data.linea
							obj.generico = data.generico
							obj.familia = data.familia
							if (data.falta == 'CLGF') {
								t.push(obj)
							}else {
								p.push(obj)
							}
						})
						let todo = JSON.parse(JSON.stringify(t))
						let parte = JSON.parse(JSON.stringify(p))

						if (todo.length == 0 && parte.length > 1) {
							swal({
								type: 'warning',
								title: 'Recomendamos hacerlo de manera individual',
								showConfirmButton: false,
								timer: 2000
							})
						}else {
							$.post('obtenerSegmento.php',{basedatos:'terranorte',opcion:1,anulado:0,orden:0},function(e){
								categoria += "<select class='form-control alinear-select' id='segcategoria'>"
								categoria += "<option value=0>--Categoria--</option>"
								const json = JSON.parse(e)
								$.each(json,function(i,value){
									categoria += "<option value="+value.id+">"+value.descrip+"</option>"
								})
								categoria += "</select>"

								$.post('obtenerSegmento.php',{basedatos:'terranorte',opcion:2,anulado:0,orden:0},function(e){
									linea += "<select class='form-control alinear-select' id='seglinea'>"
									linea += "<option value=0>--Linea--</option>"
									const json = JSON.parse(e)
									$.each(json,function(i,value){
										linea += "<option value="+value.id+">"+value.descrip+"</option>"
									})
									linea += "</select>"

									$.post('obtenerSegmento.php',{basedatos:'terranorte',opcion:3,anulado:0,orden:0},function(e){
										generico += "<select class='form-control alinear-select' id='seggenerico'>"
										generico += "<option value=0>--Generico--</option>"
										const json = JSON.parse(e)
										$.each(json,function(i,value){
											generico += "<option value="+value.id+">"+value.descrip+"</option>"
										})
										generico += "</select>"

										$.post('obtenerSegmento.php',{basedatos:'terranorte',opcion:4,anulado:0,orden:0},function(e){
											familia += "<select class='form-control alinear-select' id='segfamilia'>"
											familia += "<option value=0>--Familia--</option>"
											const json = JSON.parse(e)
											$.each(json,function(i,value){
												familia += "<option value="+value.id+">"+value.descrip+"</option>"
											})
											familia += "</select>"

											let item = "<p id='primero' class='font-weight-bold text-center'></p>"
												item += "<p id='segundo' class='font-weight-bold text-center'></p>"
												item += categoria
												item += linea
												item += generico
												item += familia
												item += "<div class='form-check'>"
	  											item += "<input id='opcion-1' class='form-check-input' type='radio' name='opciones' value=1>"
	  											item += "<label class='form-check-label' for='opcion-1'>Considerar todos los articulos seleccionados</label>"
												item += "</div>"
												item += "<div class='form-check'>"
	  											item += "<input id='opcion-2' class='form-check-input' type='radio' name='opciones' value=2>"
	  											item += "<label class='form-check-label' for='opcion-2'>Considerar solo los articulos sin ningun segmento</label>"
												item += "</div>"
											$('#modal-2').modal({
												backdrop: true,
												keyboard: true
											})
											$('#modal-2').on('hidden.bs.modal', function() {
												if ($('#accion').val() == 'pendiente') {
													limpiarTablas(8)
													llenandoArticulos(0)
												}else {
													limpiarTablas(2)
													llenandoFamilias($('#accion').val())
												}
											})
											$('#m-titulo-2').html('<i class="fas fa-box"></i> Agregar articulo')
											$('#m-cuerpo-2').html(item)										
											if (todo.length == 1 && parte.length == 0) {
												$('#primero').text(todo[0].id+" - "+todo[0].descrip)
												$('#segundo').hide()
												$('label').hide()
												$('input[type="radio"]').hide()
											}else if(todo.length > 1 && parte.length == 0) {
												$('#primero').text(todo.length+' articulos seleccionados')
												$('#segundo').hide()
												$('label').hide()
												$('input[type="radio"]').hide()
											}else if (todo.length == 0 && parte.length == 1) {
												$('#primero').text(parte[0].id+" - "+parte[0].descrip)
												$('#segundo').hide()
												$('label').hide()
												$('input[type="radio"]').hide()
												if(parte[0].categoria != 0){
													$('#segcategoria').val(parte[0].categoria)
												}
												if(parte[0].linea != 0){
													$('#seglinea').val(parte[0].linea)
												}
												if(parte[0].generico != 0){
													$('#seggenerico').val(parte[0].generico)
												}
												if(parte[0].familia != 0){
													$('#segfamilia').val(parte[0].familia)
												}
											}else if (todo.length > 0 && parte.length > 0) {
												$('#primero').text(todo.length+' articulos sin segmentos')
												$('#segundo').text(parte.length+' articulos incompletos')
												$('label').show()
												$('input[type="radio"]').show()
											}
										})
									})
								})
							})
						}
					}else {
						swal({
							type: 'info',
							title: 'Debe seleccionar un articulo',
							showConfirmButton: false,
							timer: 2000
						})
					}
				})

				$('#asignar').on('click',function(){
					let t = []
					let p = []
					$('#tabla').DataTable().rows('.selected').every(function(rowIdx, tableLoop, rowLoop){
						let data = this.data()
						let obj = new Object()
						obj.id = data.articulo
						obj.descrip = data.descrip
						obj.categoria = data.categoria
						obj.linea = data.linea
						obj.generico = data.generico
						obj.familia = data.familia
						if (data.falta == 'CLGF') {
							t.push(obj)
						}else {
							p.push(obj)
						}
					})
					let todo = JSON.parse(JSON.stringify(t))
					let parte = JSON.parse(JSON.stringify(p))

					let check = $('input[type="radio"]:checked').val()
					swal({
						title: "Asignando articulos, espere por favor...",
						allowEscapeKey: false,
						allowOutsideClick: false
					})

					let segmentos = $('#segcategoria').val()+"@"+$('#seglinea').val()+"@"+$('#seggenerico').val()+"@"+$('#segfamilia').val()

					if (todo.length > 0 && parte.length == 0) {
						let msg = ''
						$.each(todo,function(i,value){
							const datos = value.id+"@"+segmentos
							$.post('asignarArticulos.php',{basedatos:'terranorte',opcion:0,datos:datos},function(e){
								if (e == 'error') {
									msg = e
								}
							})
						})
						if (msg == 'error') {
							swal({
								type: 'error',
								title: 'Ocurrio un error mientras se asignaban articulos',
								showConfirmButton: false,
								timer:2000
							})
						}else{
							swal({
								type: 'success',
								title: 'Articulos asignados correctamente',
								showConfirmButton: false,
								timer:1000
							})
						}
					}else if(todo.length == 0 && parte.length == 1){
						const datos = parte[0].id+"@"+segmentos
						$.post('asignarArticulos.php',{basedatos:'terranorte',opcion:1,datos:datos},function(e){
							if (e == 'error') {
								swal({
									type: 'error',
									title: 'Ocurrio un error mientras se asignaban articulos',
									showConfirmButton: false,
									timer:2000
								})
							}else {
								swal({
									type: 'success',
									title: 'Articulos asignados correctamente',
									showConfirmButton: false,
									timer:1000
								})
							}
						})
					}else if(todo.length > 0 && parte.length > 0){
						if (typeof check === 'undefined') {
							swal({
								type: 'warning',
								title: 'Debe seleccionar una opción',
								showConfirmButton: false,
								timer:2000
							})
						}else {
							switch(check){
								case 1:
								let msg_1 = ''
								$.each(todo,function(i,value){
									const datos = value.id+"@"+segmentos
									$.post('asignarArticulos.php',{basedatos:'terranorte',opcion:0,datos:datos},function(e){
										if (e == 'error') {
											msg_1 = e
										}
									})
								})
								$.each(parte,function(i,value){
									const datos = value.id+"@"+segmentos
									$.post('asignarArticulos.php',{basedatos:'terranorte',opcion:1,datos:datos},function(e){
										if (e == 'error') {
											msg_1 = e
										}
									})
								})
								if (msg_1 == 'error') {
									swal({
										type: 'error',
										title: 'Ocurrio un error mientras se asignaban articulos',
										showConfirmButton: false,
										timer:2000
									})
								}else {
									swal({
										type: 'success',
										title: 'Articulos asignados correctamente',
										showConfirmButton: false,
										timer:1000
									})
								}
								break
								case 2:
								let msg_2 = ''
								$.each(todo,function(i,value){
									const datos = value.id+"@"+segmentos
									$.post('asignarArticulos.php',{basedatos:'terranorte',opcion:0,datos:datos},function(e){
										if (e == 'error') {
											msg_2 = e
										}
									})
								})
								if (msg_2 == 'error') {
									swal({
										type: 'error',
										title: 'Ocurrio un error mientras se asignaban articulos',
										showConfirmButton: false,
										timer:2000
									})
								}else {
									swal({
										type: 'success',
										title: 'Articulos asignados correctamente',
										showConfirmButton: false,
										timer:1000
									})
								}
								break
							}
						}
					}
				})

				$('#pendiente').on('click',function(){
					$('#accion').val('pendiente')
					limpiarTablas(8)
					llenandoArticulos(0)
				})

				$('#ordenar').on('click',function(){
					if ($('#familia button').hasClass('active')) {
						swal({
							title: 'Reordenando las posiciones, espere por favor',
							allowEscapeKey: false,
							allowOutsideClick: false
						})
						swal.showLoading()
						let familia = $('#familia button.active').val()
						let datos = $('#categoria button.active').val().split('@')[0]+'@'+$('#linea button.active').val().split('@')[0]+'@'+familia.split('@')[2]+'@'+familia.split('@')[0]
						$.post('ordenarArticulos.php',{basedatos:'terranorte',dato:datos},function(){
							swal.close()
							limpiarTablas(4)
							llenandoArticulos(datos)
						})
					}else{
						swal({
							type: 'warning',
							title: 'Función disponible solo para familias',
							showConfirmButton: false,
							timer: 2000
						})
					}
				})
			})
		})

		function buscarLista(){
		  	let filtro = $('#buscar').val()
		  	$.each($('input.seg-lista'),function(i,input){
		  		if (input.value.includes(filtro.toUpperCase())) {
		  			input.parentElement.style.display = "flex"
		  		}else {
		  			input.parentElement.style.display = "none"
		  		}
		  	})
		}
	
		function editarDescripcion(id){
			if($('#'+id).is('[readonly]')){
				$('#ie'+id).attr('data-icon','edit')
				$('#'+id).prop('readonly',false)
				$('#'+id).css( 'color','red')
				$('#a'+id).hide()
			}else{
				let param = id+'@'+$('#'+id).val()
				let segmento = $('#segmentos').val()
				$.post('editarSegmento.php',{basedatos:'terranorte',parametros:param,segmento:segmento},function(e){
					if (e == 'error') {
						swal({
							type: 'error',
							title: 'Posible duplicado de registro, revise los datos ingresados',
							showConfirmButton: false,
							timer:2000
						})
					}
				})
				$('#ie'+id).attr('data-icon','pencil-alt')
				$('#'+id).prop('readonly',true)
				$('#'+id).css( 'color','black')
				$('#a'+id).show()
			}
		}

		function anularSegmento(id){
			if ($('#'+id).hasClass('subrayado')) {
				let segmento = $('#segmentos').val()
				$.post('anularHabilitar.php',{basedatos:'terranorte',id:id,segmento:segmento,anular:0},function(e){
					if (e=='error') {
						swal({
							type: 'error',
							title: 'Ocurrio un error al habilitar el segmento',
							showConfirmButton: false,
							timer:2000
						})
					}
				})
				$('#ia'+id).attr('data-icon','trash-alt')
				$('#'+id).removeClass('subrayado')
				$('#'+id).parent().removeClass('anulado-segmento')
				$('#c'+id).removeClass('subrayado')
				$('#e'+id).show()
			}else {
				swal({
					type: 'warning',
					title: 'Anular segmento',
					text: '¿Está seguro de anular el segmento?',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Anular'
				}).then(function(result) {
					if (result.value) {
					    let segmento = $('#segmentos').val()
						$.post('anularHabilitar.php',{basedatos:'terranorte',id:id,segmento:segmento,anular:1},function(e){
							if (e=='error') {
								swal({
									type: 'error',
									title: 'Ocurrio un error al anular el segmento',
									showConfirmButton: false,
									timer:2000
								})
							}
						})
						$('#e'+id).hide()
						$('#ia'+id).attr('data-icon','redo')
						$('#'+id).addClass('subrayado')
						$('#'+id).parent().addClass('anulado-segmento')
						$('#c'+id).addClass('subrayado')
					 }
				})
			}
		}

		function guardarNuevoSegmento(){
			let id = $('#codigoNuevo').val()
			let descripcion = $('#descripNuevo').val()
			let segmento = $('#segmentos').val()
			if (descripcion == '') {
				swal({
					type: 'warning',
					title: 'Debe colocar una descripción para el segmento',
					showConfirmButton: false,
					timer: 2000
				})
			}else if(id == ''){
				swal({
					type: 'warning',
					title: 'Debe colocar un id para el segmento',
					showConfirmButton: false,
					timer: 2000
				})
			}else {
				$.post('crearSegmento.php',{basedatos:'terranorte',segmento:segmento,id:id,descripcion:descripcion},function(e){
					if (e == 'success') {
						swal({
							type: 'success',
							title: 'Segmento creado correctamente',
							showConfirmButton: false,
							timer: 2000
						})
						aparecerDesaparecerFila(1)
						let item = '<div style="display:flex;"><input id="c'+id+'" value="'+id+'" style="width:15%;border:0;" readonly><input id="'+id+'" type="text" style="width:71%;border:0;" value="'+descripcion.toUpperCase()+'" readonly><div id="e'+id+'" style="width:7%;text-align: center;align-self: center;" onclick="editarDescripcion(\''+id+'\')"><i id="ie'+id+'" class="fas fa-pencil-alt"></i></div><div id="a'+id+'" style="width:7%;text-align: center;align-self: center;" onclick="anularSegmento(\''+id+'\')"><i id="ia'+id+'" class="fas fa-trash-alt"></i></div></div>'
						$('#lista').prepend(item)
					}else {
						swal({
							type: 'error',
							title: 'Posible duplicado de registro, revise los datos ingresados',
							showConfirmButton: false
						})
					}
				})
			}
		}

		function aparecerDesaparecerFila(opt){
			$('#codigoNuevo').val('')
			$('#descripNuevo').val('')
			$('#buscar').val('')
			$('#anuladosVisible').prop('checked', false); 
			switch(opt){
				case 0:
					$('#fila').show()
					$('#agregarFila').hide()
					$('#anuladosVisible').attr('disabled',true)
					$('#buscador').hide()
				break
				case 1:
					$('#fila').hide()
					$('#agregarFila').show()
					$('#anuladosVisible').removeAttr('disabled')
					$('#buscador').show()
				break
				case 2:
					$('#fila').hide()
					$('#agregarFila').hide()
					$('#anuladosVisible').attr('disabled',true)
					$('#buscador').hide()
				break
			}
		}

		function soloNumeros(evt,opt){
			let opcion = opt || 0
			let x = evt.which || evt.keyCode
			if ((x >= 43 && x <= 46) || x > 31 && (x < 48 || x > 57)){
	          	return false
	        }else{
	        	if (opcion == 0) {
	        		return true
	        	}else if (opcion == 1) {
	        		if (x == 13) {
	        			if ($('#editPosicion').val() == '') {
	        				swal({
								type: 'error',
								title: 'El campo no puede estar vacio',
								showConfirmButton: false,
								timer: 2000
							})
	        			}else if ($('#familia button').hasClass('active')){
							let familia = $('#familia button.active').val()
							let datos = $('#categoria button.active').val().split('@')[0]+'@'+$('#linea button.active').val().split('@')[0]+'@'+familia.split('@')[2]+'@'+familia.split('@')[0]
							let param = $('#posActual').val()+'@'+$('#editPosicion').val()
							$.post('posicionarProducto.php',{basedatos:'terranorte',opcion:1,familia:familia,parametros:param},function(){
								limpiarTablas(4)
								llenandoArticulos(datos,param.split('@')[0])
							})
						}
					}
	        	}else if (opcion == 2) {
	        		if (x == 13) {
	        			if ($('#editFactor').val() == '') {
	        				swal({
								type: 'error',
								title: 'El campo no puede estar vacio',
								showConfirmButton: false,
								timer: 2000
							})
	        			}else if ($('#familia button').hasClass('active')){
							let datos = $('#categoria button.active').val().split('@')[0]+'@'+$('#linea button.active').val().split('@')[0]+'@'+$('#familia button.active').val().split('@')[2]+'@'+$('#familia button.active').val().split('@')[0]
							let param = $('#facActual').val()+'@'+$('#editFactor').val()
							$.post('asignarFactor.php',{basedatos:'terranorte',parametros: param},function(e){
								if (e == 'error') {
									swal({
										type: 'error',
										title: 'Ocurrio un error al registrar el factor',
										showConfirmButton: false,
										timer: 2000
									})
								}
								limpiarTablas(4)
								llenandoArticulos(datos,param.split('@')[0])
							})
						}
					}
	        	}
	        }
		}

		function checkMaximo(evt,id,opt){
			let x = evt.which || evt.keyCode
			let posicion = parseInt($('#'+id).val())
			if (opt == 0) {
				let maximo = parseInt($('#tabla').DataTable().rows().count())
				if (posicion <= 0) {
					$('#'+id).val(1)
				}else if (posicion > maximo) {
					$('#'+id).val(maximo)
				}
			}else {
				if (posicion <= 0) {
					$('#'+id).val(1)
				}
			}
		}

		function llenandoCategorias(seleccionado){
			let nombre = seleccionado || 'ninguno'
			$.post('obtenerCategoria.php',{basedatos:'terranorte'},function(e){
				let item = ""
				if (e != "[]") {
					const json = JSON.parse(e)
					for (let j = 0; j < json.length; j++) {
						if (nombre != 'ninguno' && json[j].descrip == nombre) {
							item += "<button type='button' class='list-group-item list-group-item-action active' value=\'"+json[j].id+"@"+json[j].descrip+"\'>"+json[j].descrip+"</button>"
						}else {
							item += "<button type='button' class='list-group-item list-group-item-action' value=\'"+json[j].id+"@"+json[j].descrip+"\'>"+json[j].descrip+"</button>"
						}
		            }

		            $('#categoria').html(item)

		            $('#categoria button').on('click', function (i) {
						$('#categoria button').removeClass('active')
						$(this).addClass('active')
						let categoria = $(this).val()
						limpiarTablas()
						llenandoLineas(categoria)
					})
				}else {
					swal({
						type: 'warning',
						title: 'No existen categorias',
						showConfirmButton: false,
						timer: 2000
					})
				}
			})
		}

		function llenandoLineas(categoria,seleccionado){
			let nombre = seleccionado || 'ninguno'
			$.post('obtenerLineas.php',{basedatos:'terranorte',categoria:categoria},function(e){
				let item = ""
				const json = JSON.parse(e)
				for (let j = 0; j < json.length; j++) {
					if (nombre != 'ninguno' && json[j].descrip == nombre) {
						item += "<button type='button' class='list-group-item list-group-item-action active' value=\'"+json[j].id+"@"+json[j].descrip+"@"+json[j].categoria+"\'>"+json[j].descrip+"</button>"
					}else {
						item += "<button type='button' class='list-group-item list-group-item-action' value=\'"+json[j].id+"@"+json[j].descrip+"@"+json[j].categoria+"\'>"+json[j].descrip+"</button>"
					}
		        }

		        $('#linea').html(item)

		        $('#linea button').on('click', function (){
					$('#linea button').removeClass('active')
					$(this).addClass('active')
					let linea = $(this).val()
					limpiarTablas(1)
					llenandoGenericos(linea)
		        })
			})
		}

		function llenandoGenericos(linea,seleccionado){
			let nombre = seleccionado || 'ninguno'
			$.post('obtenerGenericos.php',{basedatos:'terranorte',linea:linea},function(e){
				let item = ""
				const json = JSON.parse(e)
				for (let j = 0; j < json.length; j++) {
					if (nombre != 'ninguno' && json[j].descrip == nombre) {
						item += "<button type='button' class='list-group-item list-group-item-action active' value=\'"+json[j].id+"@"+json[j].descrip+"@"+json[j].linea+"\'>"+json[j].descrip+"</button>"
					}else {
						item += "<button type='button' class='list-group-item list-group-item-action' value=\'"+json[j].id+"@"+json[j].descrip+"@"+json[j].linea+"\'>"+json[j].descrip+"</button>"
					}
		        }

		        $('#generico').html(item)

		        $('#generico button').on('click', function (){
					$('#generico button').removeClass('active')
					$(this).addClass('active')
					let generico = $(this).val()
					$('#accion').val(generico)
					limpiarTablas(2)
					llenandoFamilias(generico)
		        })
			})
		}

		function llenandoFamilias(generico,seleccionado){
			let genericoCompleto = generico+"@"+$('#categoria button.active').val().split('@')[0]
			let nombre = seleccionado || 'ninguno'
			$.post('obtenerFamilias.php',{basedatos:'terranorte',generico:genericoCompleto},function(e){
				let item = ""
				if (e != "[]") {
					const json = JSON.parse(e)
					for (let j = 0; j < json.length; j++) {
						if (nombre != 'ninguno' && json[j].descrip == nombre) {
							item += "<button type='button' class='list-group-item list-group-item-action active' value=\'"+json[j].id+"@"+json[j].descrip+"@"+json[j].generico+"\'>"+json[j].descrip+"</button>"
						}else{
							item += "<button type='button' class='list-group-item list-group-item-action' value=\'"+json[j].id+"@"+json[j].descrip+"@"+json[j].generico+"\'>"+json[j].descrip+"</button>"
						}
				    }

				    $('#familia').html(item)

				    $('#familia button').on('click', function (){
						$('#familia button').removeClass('active')
						$(this).addClass('active')
						let familia = $(this).val()
						let datos = $('#categoria button.active').val().split('@')[0]+'@'+$('#linea button.active').val().split('@')[0]+'@'+familia.split('@')[2]+'@'+familia.split('@')[0]
						limpiarTablas(4)
						llenandoArticulos(datos)
				    })
				}
			})
		}

		function llenandoArticulos(dato,seleccionado){
			const valor = seleccionado || 0
			let indiceOrden = 'P'
			let indiceFactor = 'P'
			let orden = ''
			let factor = ''
			let filaOrden = ''
			let filaFactor = ''
			let tabla = ""
			if (dato == 0) {
				tabla = $('#tabla').DataTable({
					scrollY: "100%",
					scrollX: true,
			        scrollCollapse: true,
			        paging: false,
					searching: false,
					processing: true,
					bInfo : false,
					bLengthChange: false,
					order: [[5,'asc']],
					ajax: {
						url: "articulosLibres.php",
				        type: "POST",
				        data: {
				            basedatos: "terranorte"
				        }
					},
					columnDefs: [
						{
							title: "Falta",
							targets: 5
						},
						{
							targets: 4,
							visible: false
						}
					],
					columns: [
						{data:"articulo"},
						{data:"descrip"},
						{data:"presentacion"},
						{data:"peso"},
						{data:"factor"},
						{data:"falta"}
					],
					fnRowCallback: function( row, data, index ) {
						if (data.articulo == valor) {
							$(row).addClass('selected')
						}
						$(row).find('td:eq(0), td:eq(1), td:eq(2), td:eq(3), td:eq(4), td:eq(5)').on('click',function(){
							$(row).toggleClass('selected')
						})
					},
					initComplete: function(settings, json) {
						$('body').find('.dataTables_scrollBody').addClass("scrollbar-dataTable-danger")
					}
				})
			}else {
				tabla = $('#tabla').DataTable({
					scrollY: "100%",
					scrollX: true,
			        scrollCollapse: true,
			        paging: false,
					searching: false,
					processing: true,
					bInfo : false,
					bLengthChange: false,
					order: [[5,'asc']],
					ajax: {
						url: "obtenerArticulos.php",
				        type: "POST",
				        data: {
				            basedatos: "terranorte",
				            dato: dato
				        }
					},
					columns: [
						{data:"articulo"},
						{data:"descrip"},
						{data:"presentacion"},
						{data:"peso"},
						{data:"factor"},
						{data:"orden"}
					],
					fnRowCallback: function( row, data, index ) {
						if (data.articulo == valor) {
							$(row).addClass('selected')
						}
						if (data.orden == 0) {
							$(row).hide()
						}

						$(row).find('td:eq(0), td:eq(1), td:eq(2), td:eq(3)').on('click',function(){
							if ( $(row).hasClass('selected') ) {
					            $(row).removeClass('selected');
					        }
					        else {
					            $('#tabla tr').removeClass('selected');
					            $(row).addClass('selected');
					        }
							$('#tabla tbody').find('input.edit-position').parent().html(orden)
							$('#tabla tbody').find('input.edit-factor').parent().html(factor)
						})

						$(row).find('td:eq(4)').on('click',function(){
							if ($('#tabla tr').hasClass('selected')) {
								$('#tabla tr').removeClass('selected')
							}
							if (indiceFactor != index) {
								if (indiceFactor != 'P') {
									$(filaFactor).html(factor)
								}
								indiceFactor = index
								factor = data.factor
								filaFactor = $(this)
								$(this).html(editarFactor(data.articulo,data.factor))
							}else {
								if (!$(this).find('input').hasClass('edit-factor')) {
									$(this).html(editarFactor(data.articulo,data.factor))
								}
							}
						})

						$(row).find('td:eq(5)').on('click',function(){
							if ($('#tabla tr').hasClass('selected')) {
								$('#tabla tr').removeClass('selected')
							}
							if (indiceOrden != index) {
								if (indiceOrden != 'P') {
									$(filaOrden).html(orden)
								}
								indiceOrden = index
								orden = data.orden
								filaOrden = $(this)
								$(this).html(editarPosicion(data.articulo,data.orden))
							}else {
								if (!$(this).find('input').hasClass('edit-position')) {
									$(this).html(editarPosicion(data.articulo,data.orden))
								}
							}
						})
					},
					initComplete: function(settings, json) {
						$('body').find('.dataTables_scrollBody').addClass("scrollbar-dataTable-danger")
					}
				})
			}
		}

		function editarPosicion(articulo,orden){
			let max = $('#tabla').DataTable().rows().data().length
			return '<input id="editPosicion" class="edit-position" type="number" size="50" min="1" max='+max+' onkeyup=checkMaximo(event,"editPosicion",0) onkeypress="return soloNumeros(event,1)" style="width:100%" value='+orden+'><input type="hidden" id="posActual" value='+articulo+"@"+orden+'>'
		}

		function editarFactor(articulo,factor){
			return '<input id="editFactor" class="edit-factor" type="number" size="50" min="0" onkeypress="return soloNumeros(event,2)" style="width:100%" value='+factor+'><input type="hidden" id="facActual" value='+articulo+"@"+factor+'>'
		}

		function limpiarTablas(opt){
			let cont = opt || 0
			if (cont == 0) {
				$('#linea').html('')
				$('#generico').html('')
				$('#familia').html('')
				$('#tabla').DataTable().destroy()
				$('#tabla').empty()
				$('#tabla').html(tablaLimpia())
				$('#subir').hide()
				$('#bajar').hide()
				$('#incluir').hide()
				$('#editar').hide()
				$('#ordenar').hide()
			}else if (cont == 1) {
				$('#generico').html('')
				$('#familia').html('')
				$('#tabla').DataTable().destroy()
				$('#tabla').empty()
				$('#tabla').html(tablaLimpia())
				$('#subir').hide()
				$('#bajar').hide()
				$('#incluir').hide()
				$('#editar').hide()
				$('#ordenar').hide()
			}else if (cont == 2) {
				$('#familia').html('')
				$('#tabla').DataTable().destroy()
				$('#tabla').empty()
				$('#tabla').html(tablaLimpia())
				$('#subir').hide()
				$('#bajar').hide()
				$('#incluir').hide()
				$('#editar').hide()
				$('#ordenar').hide()
			}else if (cont == 3) {
				$('#categoria button').removeClass('active')
				$('#linea').html('')
				$('#generico').html('')
				$('#familia').html('')
				$('#tabla').DataTable().destroy()
				$('#tabla').empty()
				$('#tabla').html(tablaLimpia())
			}else if (cont == 4) {
				$('#tabla').DataTable().destroy()
				$('#tabla').empty()
				$('#tabla').html(tablaLimpia())
				$('#subir').show()
				$('#bajar').show()
				$('#incluir').show()
				$('#editar').show()
				$('#ordenar').show()
			}else if (cont == 5) {
				$('#familia').html('')
			}else if (cont == 6) {
				$('#categoria').html('')
				$('#linea').html('')
				$('#generico').html('')
				$('#familia').html('')
				$('#tabla').DataTable().destroy()
				$('#tabla').empty()
				$('#tabla').html(tablaLimpia())
				llenandoCategorias()
				$('#subir').hide()
				$('#bajar').hide()
				$('#incluir').hide()
				$('#editar').hide()
				$('#ordenar').hide()
			}else if (cont == 7) {
				$('#subir').hide()
				$('#bajar').hide()
				$('#incluir').hide()
				$('#editar').hide()
				$('#ordenar').hide()
			}else if (cont == 8) {
				$('#linea').html('')
				$('#generico').html('')
				$('#familia').html('')
				$('#tabla').DataTable().destroy()
				$('#tabla').empty()
				$('#tabla').html(tablaLimpia())
				$('#subir').hide()
				$('#bajar').hide()
				$('#incluir').show()
				$('#editar').hide()
				$('#ordenar').hide()
			}
		}

		function tablaLimpia(){
			return '<table id="tabla" class="display" style="width:100%">'+
						'<thead>'+
						    '<tr>'+
						        '<th style="width: 10%">Codigo</th>'+
						        '<th style="width: 60%">Descripcion</th>'+
						        '<th style="width: 12%">Pres.</th>'+
						        '<th style="width: 8%">Peso</th>'+
						        '<th style="width: 5%">Fac.</th>'+
						        '<th style="width: 5%">Ord.</th>'+
						    '</tr>'+
						'</thead>'+
					'</table>'
		}
	</script>
	<?php }?>
</body>
</html>