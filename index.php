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
  <title>Lectura de datos tarjeta ARDUINO</title>
  <link rel="icon" 
        type="image/png" 
        href="./imagenes/logoA.png">
  <meta content="Aurelio Gallardo Rodríguez" name="author">  
  <meta content="Página en la que se capturan y muestran los datos" name="description">

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
    <?php include_once("./htmlsuelto/barrasuperior.php"); ?>
    
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
		
		<div id="titular"><h1>Lector de datos desde el Servidor Arduino Ethernet</h1></div> 
		<div id="parametrosConexion">
			<div id="conexion">
				<label for="direccionIP">
				<span>1º) Parámetros de conexión</span><input type="text" name="direccionIP" id="direccionIP" value="192.168.1.35" size="15" maxlength="15"/>
				</label>
				<label for="puerto">
				<span>2º) Puerto de comunicación</span><input type="text" name="puerto" id="puerto" value="80" size="4" maxlength="4"/>
				</label>			
			</div>
			<div id="grabacion">
				<label for="puerto">
				<span>3º) Velocidad de grabación. Cada</span><input type="text" name="intervalo" id="intervalo" value="3" size="4" maxlength="4" /><span>segundos</span>
				</label>
			</div>			
			<div style="text-align: center;" id="divempezar">
				<button id="empezar" estado="0" class="btn">Empezar Comunicación</button>
			</div>
			<div style="text-align: center;" id="divcheckboxes">
				<input type="checkbox" class="css-checkbox" name="datCont" id="datCont" checked>
				<label for="datCont" class="css-label">Datos en tabla de forma continua &nbsp;&nbsp;</label>
				<input type="checkbox" class="css-checkbox" name="grabar" id="grabar" checked>
				<label for="grabar" class="css-label">Grabar datos en la base de datos &nbsp;&nbsp;</label>
				<p id="informacion" style="display: text; text-align: center;">Texto de posibles informaciones</p>
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
    
    
</div> <!-- FIN del CONTENEDOR PRINCIPAL -->

<!-- **************************************************************************-->	
<!-- *** Final del BODY, antes los scripts ************************************-->
<!-- **************************************************************************-->	

<!-- *************************** -->
<!-- Scripts JQUERY y Javascript -->
<!-- *************************** -->
  
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  
  <script>     
     
     $(document).ready(function() {  		
		 
		var timeOut; //This variable is responsible for the frequency of data acquisition 
		
		var cabeceraTabla = '<tr><th class="tg-elaw">Arduino tiempo (ms)<br></th><th class="tg-j0ip">Fecha</th>' +
							'<th class="tg-j0ip">Hora</th><th class="tg-elaw">Temperatura (ºC)</th>'+
							'<th class="tg-elaw">Presión (mb) </th>' +
							'<th class="tg-elaw">Humedad (%)</th>'+
							'</tr>';
							
		var numFilas = 0;
		
		var intervalo = 3000;

		$("#informacion").hide();

		// Al hacer click en el botón de empezar
		$("#empezar").click(function(){
			var estado = parseInt($(this).attr("estado")) // lee el estado actual
			if (estado==0) {
				$("#informacion").hide(); // Oculta el texto de informacions
				// Cambia el texto del botón
				$(this).text("Parar comunicación");
				
				// Comienza comunicación
				timeOut = setInterval(function(){
					 $.when(getMyData()).done(function(data){
					   try {
						   // alert(data); Obtiene sólo un dato, con lo que "data" es la cadena totalmente
						   var recupera = jQuery.parseJSON(data); // recupera con data y hacer un PARSE JSON
						   // Como es del formato [{"temperatura":"29.13","tiempo":"9832232"}] es una lista y 
						   // en el indice cero, clave "temperatura" o "tiempo" tengo los datos.
						   // alert(recupera[0].tiempo);
						   var annadefila; 
						   annadefila +="<td>"+recupera[0].tiempo+"</td>";
						   annadefila +="<td>"+obtenerfecha()+"</td>";
						   annadefila +="<td>"+obtenerhora()+"</td>";
						   annadefila +="<td>"+(recupera[0].temperatura == undefined ? "-" : recupera[0].temperatura) +"</td>";
						   annadefila +="<td>"+(recupera[0].presion == undefined ? "-" : recupera[0].presion) +"</td>";
						   annadefila +="<td>"+(recupera[0].humedad == undefined ? "-" : recupera[0].humedad) +"</td>";
						   // alert(annadefila);
						   annadefila = '<tr class="tg-cmqq">'+annadefila+'</tr>';
						   if ($("#datCont").is(':checked')) { // Si datos de forma continua
							   if (numFilas%5==0 && numFilas>3) { $("#tablaDatos tr:last").after(cabeceraTabla); } // añade cabecera cada 5 filas, para verlo mejor.
							   $("#tablaDatos tr:last").after(annadefila);
						   } else { // Si no quiero datos de forma continua...
							   numFilas=0; // No cuento el número de filas
							   $("#tablaDatos tr:not(:first)").remove(); 
							   $("#tablaDatos tr:last").after(annadefila);
						   }						   
						   $("#informacion").html("Dato obtenido: t(ms):"+recupera[0].tiempo+" - T (ºC):"+recupera[0].temperatura+" - P(mb):"+recupera[0].presion+" - H(%):"+recupera[0].humedad); 
						   $("#informacion").show();
						   numFilas += 1;
						   
						   // Llamada a grabar datos
						   if ($("#grabar").is(':checked')) {
							   // alert("grabar");
							   $.when(guardarDatos(recupera[0].tiempo,recupera[0].temperatura,recupera[0].presion,recupera[0].humedad)).done(function(data2){
									// alert(data2);
						       }); 
						   }
						   
						}
					    catch(err) { // Captura errores...
						   // alert(err.message);
						   console.log(err.message);
					    }
					   
					 }); // Fin del when...
					 
					 // Si quiero guardar los datos...
					 
			     }, intervalo ); // Fin de la función periódica set interval

			} else {
				// Parar comunicación
				clearTimeout(timeOut);
				// Cambia el texto del botón
				$(this).text("Reanudar comunicación");
				$("#informacion").html("La obtención de datos está detenida"); 
				$("#informacion").show();
			}
			estado =  (estado + 1) % 2;
			$(this).attr("estado",estado);			
		});
		
		// Al cambiar el intervalo de tiempo
		$("#intervalo").change(function(){
			clearTimeout(timeOut); // parar la recogida de datos
			intervalo = parseInt($(this).val())*1000; // hay que ponerlo en ms. Cambio el intervalo
			$("#informacion").html("Cambio el intervalo a "+intervalo+ " ms"); 
			$("#empezar").attr("estado","0"); // fuerzo a que esté para reanudar
			$("#empezar").trigger("click"); // pulso el botón.
		});
			
	 }); // fin del document ready
	 
	 // ******************************************************
	 // Funciones en la página *******************************
	 // ******************************************************	 

     // Funcion que obtiene los datos de la tarjeta Arduino
     function getMyData(){         
	
		return $.ajax({
			  url: 'http://' + $("#direccionIP").val() + ":"+$("#puerto").val()+"/",              // eg.  http://10.1.1.99:8081/
			  data: { tag: 'GetDataFromArduino'},
			  // dataType : "json",      //We will be requesting data in JSON format... ¡¡No!!, modo texto.
			  dataType : "text",      //We will be requesting data in JSON format... ¡¡No!!, modo texto.
			  timeout : 1000,        //this will cancel the request if it has not received a reply within 10 seconds.
			  success: function(data, textStatus, jqXHR){ 
						  console.log('Success - you are a legend');
						  // alert(data);
						  $("#informacion").hide();
						  return data;
					   }, // Fin de la opcion success
					   
			  error: function (jqXHR , textStatus, errorThrown) {
					  	  $("#informacion").show();
						  $("#informacion").html("No se han podido obtener los datos"); 
						  console.log('Failure'); 
						  console.log("Error: " + errorThrown); 
						  console.log("Status: " + status);
						  console.dir(xhr);
				      }
			  });
		
	     } // Fin de getMyData
		
		// Funcion que graba los datos en la base de datos
        function guardarDatos(tiempoArduino, temperatura, presion, humedad){  	
			 // alert(tiempoArduino+" "+temperatura+" "+presion+ " "+humedad);
		     console.log("****************** Grabar dato *******************");
		     console.log("tiempoArduino: "+tiempoArduino);
		     console.log("temperatura: "+temperatura);
		     console.log("presion: "+presion);
		     console.log("humedad: "+humedad);	
		     // Si el dato no existe, hay que convertirlo a número (0)
			 temperatura = (temperatura == undefined ? "0" : temperatura);
			 presion = (presion == undefined ? "0" : presion);
			 humedad = (humedad == undefined ? "0" : humedad);
			 // Llamada a la grabación
			 return $.ajax({
			      type: 'POST',
			      dataType: 'text',
			      url: "./scripts/insertarBD.php", 
			      data: { // Parece que las llamadas con ajax van mejor que con POST...
				  tiempoArduino: tiempoArduino,
				  temperatura: temperatura,
				  presion: presion,
				  humedad: humedad,
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
