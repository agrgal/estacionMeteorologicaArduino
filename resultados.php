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
		
		<div id="titular"><h1>Resultados almacenados en la base de datos</h1></div> 
		<div id="iconos">
			<img id="borrarBD" src="./imagenes/delete.png" width="50px" height="auto" title="Borra la base de datos" alt="Borra la base de datos. Icono por Freepik">
			<a id="csv"><img id="csvImagen" src="./imagenes/csv.png" width="50px" height="auto" title="Genera fichero CSV" alt="Genera fichero CSV. Icono por Freepik"></a>
			<img id="graficaT" src="./imagenes/termometro.png" width="50px" height="auto" title="Gráfica de Temperatura" alt="Gráfica Google. Icono por Freepik">
			<img id="graficaP" src="./imagenes/presion.png" width="50px" height="auto" title="Gráfica de Presión" alt="Gráfica Google. Icono por Freepik">
			<img id="graficaH" src="./imagenes/humedad.png" width="50px" height="auto" title="Gráfica de Humedad" alt="Gráfica Google. Icono por Freepik">
		</div>
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
					<tr class="principal"> <!-- Clase principal, para que después busque solo en CSV esta línea, no las demás -->
						<th class="tg-elaw">Arduino tiempo (ms)<br></th>
						<th class="tg-j0ip">Fecha</th>
						<th class="tg-j0ip">Hora</th>
						<th class="tg-elaw">Temperatura (ºC)</th>
						<th class="tg-elaw">Presión (mb)</th>
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
		<p style="text-align: justify;">Lo sentimos. No hay datos que mostrar con este filtro. </p>
		<p style="text-align: justify;">Prueba a cambiar las fechas (aumenta el intervalo) y vuelve a obtener registros.</p>
    </div>
    
    <div id="notificacionBorrar" title="¿Estás seguro/a que quieres borrar la BD?">
		<p style="text-align: justify;">Pulsa "CONTINUAR" si estas seguro de borrar la base de datos...</p>
    </div>
    
    <div id="notificacionGrafica" title="Gráficas de temperatura, presión y humedad generadas por Google Charts">
		<div id="graficaShow" style="width: 100%; height: 600px;"></div>
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
  
  <!-- google charts -->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
  <script>     
     
     $(document).ready(function() {  		
		
		var cual="temperatura"; // tipo de gráfica. Modificador.
		
		// llamadas a las APIS de google charts
		google.charts.load('current', {'packages':['corechart']});
		// google.charts.load("current", {packages: ["line"]}); // Material Line Charts
        google.charts.setOnLoadCallback(cargargrafico);

 
		var cabeceraTabla = '<tr><th class="tg-elaw">Arduino tiempo (ms)<br></th><th class="tg-j0ip">Fecha</th>' +
							'<th class="tg-j0ip">Hora</th><th class="tg-elaw">Temperatura (ºC)</th>'+
							'<th class="tg-elaw">Presión (mb)</th>' +
							'<th class="tg-elaw">Humedad (%)</th>'+
							'</tr>';
							
		var ahoramasuno = new Date();
		ahoramasuno.setMinutes(ahoramasuno.getMinutes()+60);
		var ahoramenosuno = new Date();
		ahoramenosuno.setMinutes(ahoramenosuno.getMinutes()-60);
		
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
			defaultTime: ahoramenosuno,
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
			$( "#notificacionNoHayDatos, #notificacionBorrar, #notificacionGrafica" ).dialog({
				autoOpen: false, width: '50%', height: '350',
				resizable: false, modal: true,
				show: {	effect: "blind", duration: 1000	},
				hide: {	effect: "drop", duration: 1000 },
			});
			
			$("#notificacionGrafica").dialog({
				width: '80%', height: '1000',
			});
			
			$("#notificacionBorrar").dialog({
				buttons: {
					"CONTINUAR": function() {						
						$.when(borraDatos()).done(function(data){
							// alert(data);
							try {
								if (data=="Fallido") {
									alert("Ha fallado el borrado de datos");									
								} else {
									location.reload();
								}
							} catch(err) { // Captura errores...
							// alert(err.message);
							console.log(err.message);
							} 
						}); // Fin del when						
					}, // Fin del CONTINURA
					"CANCELAR": function() {
						$( this ).dialog( "close" );
					}, // Fin del CANCELAR
				}, // Fin del BUTTONS
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
					// alert(recupera[0].minimo);
					var annadefila;
					numFilas = 0; // empiezo desde cero a contar
					$("#tablaDatos tr:not(:first)").remove(); // Borro las filas que no necesito...
					$.each( recupera, function( key, value ) {
						   // alert( key + ": " + value.temperatura );
						   if (recupera[numFilas].temperatura != undefined) {
							   annadefila = "";
							   annadefila +="<td class='tiempoArduino'>"+(recupera[numFilas].tiempoarduino-recupera[0].minimo)+"</td>"; // normalizado al valor más bajo
							   annadefila +="<td class='fecha'>"+recupera[numFilas].fecha+"</td>";
							   annadefila +="<td class='hora'>"+recupera[numFilas].hora+"</td>";
							   annadefila +="<td class='temperatura'>"+recupera[numFilas].temperatura+"</td>";
							   annadefila +="<td class='presion'>"+recupera[numFilas].presion+"</td>";
							   annadefila +="<td class='humedad'>"+recupera[numFilas].humedad+"</td>";
							   // alert(annadefila);
							   annadefila = '<tr class="tg-cmqq">'+annadefila+'</tr>';
							   if (numFilas%5==0 && numFilas>3) { $("#tablaDatos tr:last").after(cabeceraTabla); } // añade cabecera cada 5 filas, para verlo mejor.
							   $("#tablaDatos tr:last").after(annadefila);
							   numFilas += 1;
						   }
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
		
		// Al hacer click en el icono de Borrar
		$("#borrarBD").click(function(){
			$("#notificacionBorrar").dialog("open");
		});

	    // Al hacer click en el icono de CSV
	    // This must be a hyperlink
		$("#csv").click(function (event) {
			// var outputFile = 'export'
			var outputFile = window.prompt("Nombre del fichero (no funcionará en SAFARI)") || 'export';
			outputFile = outputFile.replace('.csv','') + '.csv'
			 
			// CSV
			exportTableToCSV.apply(this, [$('#tablaDatos'), outputFile]);
			
			// IF CSV, don't do event.preventDefault() or return false
			// We actually need this to be a typical hyperlink
		});
		
		// Al hacer click en el icono de la Grafica
		$("#graficaT, #graficaP, #graficaH").click(function(){	
			// alert($(this).attr("id"));		
			if ($(this).attr("id")=="graficaT") {cual="temperatura";} //Elige el modificador según el botón pulsado
			if ($(this).attr("id")=="graficaP") {cual="presion";}
			if ($(this).attr("id")=="graficaH") {cual="humedad";}
			cargargrafico();
			$("#notificacionGrafica").dialog("open");
		});

		// *********************************************************
		// Función callback que llama a una gráfica. Paso intermedio
		// *********************************************************		
		function cargargrafico() {
			drawChart(cual);
		}
		
		// ******************************
		// Función que dibuja una gráfica 
		// ******************************
		function drawChart(modificador) {

			/* 
			var datos =[];
			datos[0]=['Year', 'Sales', 'Expenses'];
			datos[1]= ['2004',  1230,      400];
			datos[4]= ['2007',  1000,      400]; */
			
			// El valor de los modificadores DEBE SER el nombre de la clase en la tabla que identifica el tipo de datos.
			
			var columnaDatos= $('#tablaDatos td[class="'+modificador+'"]').map(function(){	
				return $(this).text();
			}).get();
			
			var ejeXHora= $('#tablaDatos td[class="hora"]').map(function(){	
				return $(this).text();
			}).get();
			
			var ejeXFecha= $('#tablaDatos td[class="fecha"]').map(function(){	
				return $(this).text();
			}).get();
			
			var datos =[];
			datos[0]=['Fecha-Hora',modificador];
			$.each(ejeXFecha, function( index, value ) {
			  // alert(index+" , "+value);
			  datos[index+1]=[value+" "+ejeXHora[index],parseFloat(columnaDatos[index])];
			});
			
			// alert(datos);
			
			if (modificador=="temperatura") {
			   var titulo = "Temperatura en ºC";
			   var colorDado="red";
			} else if (modificador=="presion") {
			   var titulo = "Presión en mb";
			   var colorDado="blue";
			} else if (modificador=="humedad") {
			   var titulo = "Humedad en %";
			   var colorDado="green";
			}

			var data = google.visualization.arrayToDataTable(datos);

			var options = {
			  title: titulo,
			  curveType: 'function',
			  legend: { position: 'right' },
			  colors: [colorDado],
			  // chartArea: {backgroundColor: '#ff4455'},
			  width: '1800',  height: '800', fontSize: '24', lineWidth: '2',
			  hAxis: { slantedText: true, slantedTextAngle: '30', showTextEvery: '5',  },
			};

			// var chart = new google.charts.Line(document.getElementById('graficaShow')); // Material Line Charts
			var chart = new google.visualization.LineChart(document.getElementById('graficaShow'));
			
			// Wait for the chart to finish drawing before calling the getImageURI() method.
				google.visualization.events.addListener(chart, 'ready', function () {
				graficaShow.innerHTML = '<img src="' + chart.getImageURI() + '">';
				console.log(graficaShow.innerHTML);
			});


			chart.draw(data, options);
        } // Fin de la función que dibuja una gráfica

			
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
		     console.log("****************** Leer datos *******************");
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

		// ***********************************		
		// Funcion que borra la base de datos
		// ***********************************

        function borraDatos(){  	
			 // alert(fechaDesde+" "+horaDesde+" "+fechaHasta+ " "+horaHasta);
		     console.log("****************** Borra BD *******************");
		     return $.ajax({
			      type: 'POST',
			      dataType: 'text',
			      url: "./scripts/borrarBD.php", 
			      data: { // Parece que las llamadas con ajax van mejor que con POST...
				  lee: 1,
				  },					 		 
		          success: function(data, textStatus, jqXHR){
					 // alert(data);
				     return data;
			      },
			      error: function (jqXHR , textStatus, errorThrown) {
					  return "";
				  }
			  });
		}; 
		
    
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
		
		
		// ***********************************************************************
		// Función que exporta a CSV (https://gist.github.com/adilapapaya/9787842)
		// ***********************************************************************
		function exportTableToCSV($table, filename) {
                var $headers = $table.find('tr[class="principal"]:has(th)')
                    ,$rows = $table.find('tr:has(td)')
                    // Temporary delimiter characters unlikely to be typed by keyboard
                    // This is to avoid accidentally splitting the actual contents
                    ,tmpColDelim = String.fromCharCode(11) // vertical tab character
                    ,tmpRowDelim = String.fromCharCode(0) // null character
                    // actual delimiter characters for CSV format
                    ,colDelim = '";"' // Prefiero ; como delimitador
                    ,rowDelim = '"\r\n"';
                    // Grab text from table into CSV formatted string
                    var csv = '"';
                    csv += formatRows($headers.map(grabRow));
                    csv += rowDelim;
                    csv += formatRows($rows.map(grabRow)) + '"';
                    // Data URI
                    var csvData = 'data:application/csv;charset=utf-8,' + encodeURIComponent(csv);
                $(this)
                    .attr({
                    'download': filename
                        ,'href': csvData
                        //,'target' : '_blank' //if you want it to open in a new window
                });
                //------------------------------------------------------------
                // Helper Functions 
                //------------------------------------------------------------
                // Format the output so it has the appropriate delimiters
                function formatRows(rows){
                    return rows.get().join(tmpRowDelim)
                        .split(tmpRowDelim).join(rowDelim)
                        .split(tmpColDelim).join(colDelim);
                }
                // Grab and format a row from the table
                function grabRow(i,row){
                     
                    var $row = $(row);
                    //for some reason $cols = $row.find('td') || $row.find('th') won't work...
                    var $cols = $row.find('td'); 
                    if(!$cols.length) $cols = $row.find('th');  
                    return $cols.map(grabCol)
                                .get().join(tmpColDelim);
                }
                // Grab and format a column from the table 
                function grabCol(j,col){
                    var $col = $(col),
                        $text = $col.text();
                    // alert($text); Si en texto va recorriendo los valores...
                    if ($.isNumeric($text)) { // detecta valores que se leen numéricos
						$text = $text.replace(".",","); // reemplaza el punto decimal con comas, para ser leído por CALC.
						// alert($text);
					}
                    return $text.replace('"', '""'); // escape double quotes
                }
            }
		


	  
 <!-- * =======================================================================================================   * --> 	

  </script>
  
<!-- **************************************************************************************** -->
</body></html>
