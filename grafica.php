<?php
include("dll/config.php");
include("dll/clase.php");
$miconexion = new DB_mysql;
$miconexion->conectar($dbname, $dbhost, $dbuname, $dbpass);
extract($_POST);
extract($_GET);
?>
<!DOCTYPE html>
<html> 
  <head> 
     <title>Evaluar una variable que contiene notación JSON...</title> 
     <meta http-equiv="Content-Type" 
              content="text/html; charset=UTF-8">
     <script src="http://code.jquery.com/jquery-1.8.0.min.js" type="text/javascript"></script> 
     <link rel="stylesheet" type="text/css" href="css/estilos.css">
     <link rel="stylesheet" type="text/css" href="css/style.css">

     <script src="https://code.highcharts.com/highcharts.js"></script>
      <script src="https://code.highcharts.com/modules/exporting.js"></script>

 </head> 
 <body> 
 <header><h1><span class="icon-stats-dots"> </span>SSN | Stadistic Social Nerworks</h1></header>
  <nav class="menu-principal">
    <a href="buscador.php"><span class="icon-home"> </span>Home</a> |
    <a href="buscador.php"><span class="icon-accessibility"> </span>About as</a>
  </nav>
  <section class="contenedor2">
    <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  </section>
  <footer>
    <h6>  
    <section id="contenidoOculto">
      
    </section>
    <span class="icon-users"> </span>Derechos Reservados #kruskaya #rlramirez<br> UTPL 2016<br>
    <span class="icon-google-plus2"> </span><span class="icon-facebook"> </span><span class="icon-instagram"> </span><span class="icon-twitter"> </span><span class="icon-youtube"> </span><span class="icon-flickr"> </span><span class="icon-github"> </span><span class="icon-wordpress"> </span>
    </h6> 
  </footer>
 
  <script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'spline'
        },
        title: {
            text: 'Visualizacion de Datos Twitter'
        },
        subtitle: {
            text: 'Irregular time data  twitter'
        },
        xAxis: {
            type: 'datetime',
            dateTimeLabelFormats: { // don't display the dummy year
                month: '%e. %b',
                year: '%b'
            },
            title: {
                text: 'Date'
            }
        },
        yAxis: {
            title: {
                text: 'Posts'
            },
            min: 0
        },
        tooltip: {
            headerFormat: '<b>{series.name}</b><br>',
            pointFormat: '{point.x:%e. %b}: {point.y:.2f} m'
        },

        plotOptions: {
            spline: {
                marker: {
                    enabled: true
                }
            }
        },

        series: [{
            name: '<?php echo $usuario; ?>',
            // Define the data points. All series have a dummy year
            // of 1970/71 in order to be compared on the same x axis. Note
            // that in JavaScript, months start at 0 for January, 1 for February etc.
            data: [
            <?php
                //$miconexion->consulta("select date(fecha), count(id) from posts group by date(fecha) ");
                $miconexion->consulta("select date(fecha), count(id) from posts where user='$usuario' group by date(fecha) ");
                $miconexion->consultadatascript();

            ?>
            
            ]
        }]
    });
});
    </script>           
    </body> 
</html>