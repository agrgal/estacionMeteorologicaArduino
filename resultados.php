<?php header('Content-type: text/html; charset=UTF-8'); ?>
<?php
// Codigo que se ejecuta al principio de la página
// importante incluir al principio de cada una, lo de las funciones
include_once("./funciones/funciones.php"); // funciones varias de conexión a base de datos, etc.

// Incluyo además las clases que se van a usar
include_once("./clases/class.micalendario.php"); //clase mi calendario que presenta fechas formateadas

// incluyo las variables de esas clases
$calendario = New micalendario(); // variable de calendario. Lo necesito para la cabecera

// Variables de sesión
session_start();

// Las variables de sesión se establecen en los scripts AJAX en 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="es">	
<head profile="http://www.w3.org/2005/10/profile">
  <!-- *** Principio del HEAD *************************************-->	
  <meta content="text/html; charset=iso-8859-15" http-equiv="content-type">
  <title>Resultados almacenados en la base de datos</title>
  <link rel="icon" 
        type="image/png" 
        href="./imagenes/logoA.png">
  <meta content="Aurelio Gallardo Rodríguez" name="author">  
  <meta content="Muestra los datos obtenidos en la base de datos" name="description">

  <!-- ***************************** -->
  <!-- Linkar a hojas de estilo CSS -->
  <!-- ***************************** -->
  <?php include_once("./css/cargarestiloscss.php"); ?>
 
  <!-- *** Final del HEAD, antes los ficheros de enlace a CSS ******-->
</head>

<body>
<!-- **************************************************************************-->	
<!-- *** Principio del BODY ***************************************************-->	
<!-- **************************************************************************-->	

<div id="container"> <!-- CONTENEDOR PRINCIPAL -->  
    
    <!-- HTML suelto: cabecera *******************************  -->
    <?php include_once("./htmlsuelto/cabecera.php"); ?> 
    <!-- ********************************************************** -->
    
    <!-- ******************************************* -->
    <!-- ******** ZONA DE CÁLCULOS PREVIOS ********* -->
    <!-- ******************************************* -->
    <?php // Zona en la que se extraen variables de las distintas clases

    ?>    
    <!-- *********************************************************** -->
     
	<div id="test"> <!-- TESTER -->
	    <p id="testear">
	    </p>
    </div>	<!-- TESTER -->
    
    <!-- ********************************************************** -->
    <!-- Contenido Principal -->
    <!-- ********************************************************** --> 
    
    <div id="contents"> <!-- &&&& -->  
		
		<div id="titular"><h1>Resultados almacenados en la base de datos</h1></div> 
		<div id="desde">
			<label for="fechaDesde"><span>Fecha desde</span><input type="text" id="fechaDesde" size="10" maxlength="10"/></label>
			<label for="horaDesde"><span>Hora desde</span><input type="text" id="horaDesde" size="8" maxlength="8"/></label>			
		</div>
		<div id="hasta">
			<label for="fechaHasta"><span>Fecha hasta</span><input type="text" id="fechaHasta" size="10" maxlength="10"/></label>
			<label for="horaHasta"><span>Hora hasta</span><input type="text" id="horaHasta" size="8" maxlength="8"/></label>
		</div>
		<div style="text-align: center;" id="divempezar">
			<button id="empezar" estado="0" class="btn">Obtener registros de la base de datos</button>
		</div>	
		<div style="text-align: center;" id="divcheckboxes">
				<input type="checkbox" class="css-checkbox" name="limite" id="limite" checked>
				<label for="limite" class="css-label">Limitar a un número de datos. Si no se indica un límite, el número máximo de registros a mostrar será de 10.000 &nbsp;&nbsp;</label>
				<label for="numLimite"><span>Nº Límite (0 sin límites):</span><input type="text" id="numLimite" size="4" maxlength="4" value="100"/></label>
		</div>	
		<div id="datos" style="text-align: center;"> <!-- Empezando el div con los datos-->
			<table class="tg" id="tablaDatos" style="margin: 10px auto;">
					<tr>
						<th class="tg-elaw">Arduino tiempo (ms)<br></th>
						<th class="tg-j0ip">Fecha</th>
						<th class="tg-j0ip">Hora</th>
						<th class="tg-elaw">Temperatura (ºC)</th>
						<th class="tg-elaw">Presión (mb) </th>
						<th class="tg-elaw">Humedad (%)</th>
					</tr>
					<!--<tr>
						<td class="tg-cmqq">1</td>
						<td class="tg-cmqq">2</td>
						<td class="tg-cmqq">3</td>
						<td class="tg-cmqq">4</td>
						<td class="tg-cmqq">5</td>
						<td class="tg-cmqq">6</td>
					</tr> -->
				</table>
			</div> <!-- Fin del DIV con los datos -->
		</div>
			
	</div> <!-- &&&& FIN DEL CONTENEDOR-->	

	<!-- ********************************************************** -->
	<!-- FIN DEL CONTENIDO PRINCIPAL -->
	<!-- ********************************************************** -->
    
    <!-- HTML suelto: pie de página *******************************  -->
    <?php include_once("./htmlsuelto/pie.php"); ?> 
    <!-- ********************************************************** -->
    
    <div id="notificacionNoHayDatos" title="No hay datos que mostrar">
		<p style="text-align: justify;">Lo sentimos. No hay datos que mostrar con este filtro. Prueba a anular las fechas y vuelve a obtener registros.</p>
    </div>
    
    
</div> <!-- FIN del CONTENEDOR PRINCIPAL -->

<!-- **************************************************************************-->	
<!-- *** Final del BODY, antes los scripts ************************************-->
<!-- **************************************************************************-->	

<!-- *************************** -->
<!-- Scripts JQUERY y Javascript -->
<!-- *************************** -->
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.4/jquery-ui.min.js"></script>
  
  <!-- Timepicker -->
  <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
  <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
  
  
  <script>     
     
     $(document).ready(function() {  		
		 
		var cabeceraTabla = '<tr><th class="tg-elaw">Arduino tiempo (ms)<br></th><th class="tg-j0ip">Fecha</th>' +
							'<th class="tg-j0ip">Hora</th><th class="tg-elaw">Temperatura (ºC)</th>'+
							'<th class="tg-elaw">Presión (mb) </th>' +
							'<th class="tg-elaw">Humedad (%)</th>'+
							'</tr>';
							
		var ahoramasuno = new Date();
		ahoramasuno.setMinutes(ahoramasuno.getMinutes()+60);
		
		var numFilas = 0; // Número de filas en la tabla
							
		// definición de calendarios
		$("#fechaDesde, #fechaHasta").datepicker({
			dateFormat: 'dd-mm-yy',
			changeMonth: true,
			changeYear: true,
			showOn: "button",
			buttonImage: "./imagenes/calendar_mini.png",
			buttonImageOnly: false,
			buttonText: "Seleccionafecha",
		});
		
		$("#fechaDesde, #fechaHasta").datepicker( "setDate" , "now" );			

		$('#horaDesde').timepicker({
			timeFormat: 'HH:mm:ss',
			interval: 10,
			minTime: '0:00am',
			maxTime: '11:50:pm',
			defaultTime: 'now',
			startTime: '00:00',
			dynamic: true,
			dropdown: true,
			scrollbar: true
		});
		
		$('#horaHasta').timepicker({			
			timeFormat: 'HH:mm:ss',
			interval: 10,
			minTime: '0:00am',
			maxTime: '11:50:pm',
			defaultTime:  ahoramasuno,
			startTime: '00:00',
			dynamic: true,
			dropdown: true,
			scrollbar: true
		});
		
		// Definición de diálogo
			$( "#notificacionNoHayDatos" ).dialog({
			autoOpen: false, width: '50%', height: '300',
			resizable: false, modal: true,
			show: {	effect: "blind", duration: 1000	},
			hide: {	effect: "drop", duration: 1000 },
			});
		
		
		// Al hacer click en el botón empezar
		$("#empezar").click(function(){
			var fechaDesde = aFecha($("#fechaDesde").val()); // Función aFecha cambia a formato para MySQL
			var fechaHasta = aFecha($("#fechaHasta").val()); // Función aFecha cambia a formato para MySQL
			var horaDesde = $("#horaDesde").val();
			var horaHasta = $("#horaHasta").val();
			var limite = 0; // por defecto cero...
			if ($("#limite").is(':checked')) {
				limite = parseInt($("#numLimite").val());
		    } 
			$.when(leerDatos(fechaDesde,horaDesde,fechaHasta,horaHasta, limite)).done(function(data){
				// alert(data);
				try {
					var recupera = jQuery.parseJSON(data); // recupera con data y hacer un PARSE JSON
					// alert(recupera[0].temperatura+ " - " + recupera[1].temperatura);
					var annadefila;
					numFilas = 0; // empiezo desde cero a contar
					$("#tablaDatos tr:not(:first)").remove(); // Borro las filas que no necesito...
					$.each( recupera, function( key, value ) {
						   // alert( key + ": " + value.temperatura );
						   annadefila = "";
						   annadefila +="<td>"+recupera[numFilas].tiempoarduino+"</td>";
						   annadefila +="<td>"+recupera[numFilas].fecha+"</td>";
						   annadefila +="<td>"+recupera[numFilas].hora+"</td>";
						   annadefila +="<td>"+recupera[numFilas].temperatura+"</td>";
					       annadefila +="<td>"+recupera[numFilas].presion+"</td>";
						   annadefila +="<td>"+recupera[numFilas].humedad+"</td>";
						   // alert(annadefila);
						   annadefila = '<tr class="tg-cmqq">'+annadefila+'</tr>';
						   if (numFilas%5==0 && numFilas>3) { $("#tablaDatos tr:last").after(cabeceraTabla); } // añade cabecera cada 5 filas, para verlo mejor.
						   $("#tablaDatos tr:last").after(annadefila);
						   numFilas += 1;
					});
					
					if (numFilas==0) {
						// abrir notificacion notificacionNoHayDatos
						$( "#notificacionNoHayDatos" ).dialog( "open" );
					}
					
				} catch(err) { // Captura errores...
				   // alert(err.message);
				   console.log(err.message);
				}
						   
			});
		});
		


			
	 }); // fin del document ready
	 
	 // ******************************************************
	 // Funciones en la página *******************************
	 // ******************************************************	 
  
  		// ****************************
		// Funciones
		// ****************************
		// Funcion que lee los datos desde la base de datos
        function leerDatos(fechaDesde, horaDesde, fechaHasta, horaHasta, limite){  	
			 // alert(fechaDesde+" "+horaDesde+" "+fechaHasta+ " "+horaHasta);
		     console.log("****************** Grabar dato *******************");
		     console.log("fechaDesde: "+fechaDesde);
		     console.log("horaDesde: "+horaDesde);
		     console.log("fechaHasta: "+fechaHasta);
		     console.log("horaHasta: "+horaHasta);	
		     console.log("Límite: "+limite);		     
			 return $.ajax({
			      type: 'POST',
			      dataType: 'text',
			      url: "./scripts/leerBD.php", 
			      data: { // Parece que las llamadas con ajax van mejor que con POST...
				  fechaDesde: fechaDesde,
				  horaDesde: horaDesde,
				  fechaHasta: fechaHasta,
				  horaHasta: horaHasta,
				  limite: limite,
				  },					 		 
		          success: function(data, textStatus, jqXHR){
					 // alert(data);
				     return data;
			      },
			      error: function (jqXHR , textStatus, errorThrown) {
					  return "";
				  }
			  });
		}
    
		// ****************************
		// Función que obtiene la fecha 
		// ****************************
		function obtenerfecha() {
			var d = new Date();

			var month = d.getMonth()+1;
			var day = d.getDate();

			var output = ((''+day).length<2 ? '0' : '') + day + '/' +
				((''+month).length<2 ? '0' : '') + month + '/' +
				d.getFullYear();

			return output;
		}
		
		// ***********************************************
		// Función que cambia la fecha en formato YY-MM-DD
		// ***********************************************
		function aFecha(dateStr) {
			// alert(dateStr);
			var parts = dateStr.split("-");
		 	return parts[2]+"-"+parts[1]+"-"+parts[0];
		 }
		
		// ****************************
		// Función que obtiene la hora 
		// ****************************
		function obtenerhora() {
			var d = new Date();
			
			var hora = ((''+d.getHours()).length<2 ? '0' : '') + d.getHours();
			var minutos = ((''+d.getMinutes()).length<2 ? '0' : '') + d.getMinutes();
			var segundos = ((''+d.getSeconds()).length<2 ? '0' : '') + d.getSeconds();

	     	var output = hora + ":" + minutos + ":" + segundos;

			return output;
		}
		
	  
 <!-- * =======================================================================================================   * --> 	

  </script>
  
<!-- **************************************************************************************** -->
</body></html>
